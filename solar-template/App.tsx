
import React, { useState, useEffect } from 'react';
import Header from './components/Header';
import Footer from './components/Footer';
import Home from './views/Home';
import Activities from './views/Activities';
import News from './views/News';
import About from './views/About';
import Contact from './views/Contact';
import { en } from './localization/en';
import { fa } from './localization/fa';
import type { Translations } from './types';

export type View = 'home' | 'activities' | 'news' | 'about' | 'contact';
export type Language = 'en' | 'fa';

declare global {
  interface Window {
    __SOLAR_TRANSLATIONS__?: { en?: Translations; fa?: Translations };
    __SOLAR_POSTS__?: Array<{ title: string; excerpt: string; link: string; imageUrl?: string }>;
    __SOLAR_SITE__?: { title?: string; description?: string; homeUrl?: string; siteUrl?: string; adminEmail?: string; language?: string };
  }
}

const App: React.FC = () => {
  const [view, setView] = useState<View>('home');
  const [language, setLanguage] = useState<Language>('fa');
  const [translations, setTranslations] = useState<Translations>(fa);

  const getTranslations = (lang: Language): Translations => {
    const fromWP = typeof window !== 'undefined' ? window.__SOLAR_TRANSLATIONS__ : undefined;
    if (fromWP && fromWP[lang]) {
      return fromWP[lang]!;
    }
    return lang === 'fa' ? fa : en;
  };

  useEffect(() => {
    if (language === 'fa') {
      setTranslations(getTranslations('fa'));
      document.documentElement.lang = 'fa';
      document.documentElement.dir = 'rtl';
    } else {
      setTranslations(getTranslations('en'));
      document.documentElement.lang = 'en';
      document.documentElement.dir = 'ltr';
    }
  }, [language]);

  const renderView = () => {
    switch (view) {
      case 'home':
        return <Home t={translations} />;
      case 'activities':
        return <Activities t={translations} currentLanguage={language} />;
      case 'news':
        return <News t={translations} currentLanguage={language} />;
      case 'about':
        return <About t={translations} currentLanguage={language} />;
      case 'contact':
        return <Contact t={translations} currentLanguage={language} />;
      default:
        return <Home t={translations} />;
    }
  };

  return (
    <div className={`${language === 'fa' ? 'font-fa' : 'font-en'} bg-gray-50 text-gray-800`}>
      <Header
        currentView={view}
        setView={setView}
        currentLanguage={language}
        setLanguage={setLanguage}
        t={translations}
      />
      <main className="min-h-screen">
        {renderView()}
      </main>
      <Footer t={translations} setView={setView} currentLanguage={language} />
    </div>
  );
};

export default App;
