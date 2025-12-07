
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import Header from './components/Header';
import Footer from './components/Footer';
import { en } from './localization/en';
import { fa } from './localization/fa';
import type { Translations } from './types';

const rootElement = document.getElementById('root');
if (rootElement) {
  const root = ReactDOM.createRoot(rootElement);
  root.render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
} else {
  // Fallback: mount header/footer only on templates without the main React root
  const headerEl = document.getElementById('react-header');
  const footerEl = document.getElementById('react-footer');

  if (headerEl || footerEl) {
    const HeaderFooterShell: React.FC = () => {
      type View = 'home' | 'activities' | 'news' | 'about' | 'contact';
      type Language = 'en' | 'fa';
      const [language, setLanguage] = useState<Language>('fa');
      const [view, setView] = useState<View>(() => {
        const m = window.location.hash.match(/view=([a-z]+)/i);
        const v = m && m[1] ? m[1].toLowerCase() : 'home';
        return (['home','activities','news','about','contact'].includes(v) ? (v as View) : 'home');
      });
      const [t, setT] = useState<Translations>(fa);
      useEffect(() => {
        const fromWP = (window as any).__SOLAR_TRANSLATIONS__ as { en?: Translations; fa?: Translations } | undefined;
        const next = language === 'fa' ? (fromWP?.fa || fa) : (fromWP?.en || en);
        setT(next);
        document.documentElement.lang = language;
        document.documentElement.dir = language === 'fa' ? 'rtl' : 'ltr';
      }, [language]);
      useEffect(() => {
        const next = `#view=${view}`;
        if (window.location.hash !== next) {
          window.location.hash = next;
        }
      }, [view]);

      return (
        <div className={`${language === 'fa' ? 'font-fa' : 'font-en'} bg-gray-50 text-gray-800`}>
          {headerEl && (
            <Header currentView={view} setView={setView} currentLanguage={language} setLanguage={setLanguage} t={t} />
          )}
          {footerEl && (
            <Footer t={t} setView={setView} currentLanguage={language} />
          )}
        </div>
      );
    };

    const shell = <HeaderFooterShell />;
    if (headerEl) {
      const headerRoot = ReactDOM.createRoot(headerEl);
      headerRoot.render(<React.StrictMode>{shell}</React.StrictMode>);
    }
    if (footerEl) {
      const footerRoot = ReactDOM.createRoot(footerEl);
      footerRoot.render(<React.StrictMode>{shell}</React.StrictMode>);
    }
  }
}
