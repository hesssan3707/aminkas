
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

const App: React.FC = () => {
  const [view, setView] = useState<View>('home');
  const [language, setLanguage] = useState<Language>('fa');
  const [translations, setTranslations] = useState<Translations>(fa);

  useEffect(() => {
    if (language === 'fa') {
      setTranslations(fa);
      document.documentElement.lang = 'fa';
      document.documentElement.dir = 'rtl';
    } else {
      setTranslations(en);
      document.documentElement.lang = 'en';
      document.documentElement.dir = 'ltr';
    }
  }, [language]);

  const renderView = () => {
    switch (view) {
      case 'home':
        return <Home t={translations} />;
      case 'activities':
        return <Activities t={translations} />;
      case 'news':
        return <News t={translations} />;
      case 'about':
        return <About t={translations} />;
      case 'contact':
        return <Contact t={translations} />;
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
      <Footer t={translations} setView={setView} />
    </div>
  );
};

export default App;
