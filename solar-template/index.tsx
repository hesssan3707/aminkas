
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import { createPortal } from 'react-dom';
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
  // Fallback: mount header/footer on templates without the main React root
  const headerEl = document.getElementById('react-header');
  const footerEl = document.getElementById('react-footer');

  const mountTarget = headerEl || footerEl;
  if (mountTarget) {
    const mountOnHeader = Boolean(headerEl);
    const shellRoot = ReactDOM.createRoot(mountTarget);

    const HeaderFooterShell: React.FC = () => {
      type View = 'home' | 'activities' | 'news' | 'about' | 'contact';
      type Language = 'en' | 'fa';
      const [language, setLanguage] = useState<Language>(() => {
        try {
          const saved = localStorage.getItem('solar_language');
          return saved === 'en' ? 'en' : 'fa';
        } catch {
          return 'fa';
        }
      });
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
        try { localStorage.setItem('solar_language', language); } catch {}
      }, [language]);

      useEffect(() => {
        const next = `#view=${view}`;
        if (window.location.hash !== next) {
          window.location.hash = next;
        }
      }, [view]);

      const homeUrl = (window as any).__SOLAR_SITE__?.homeUrl || '/';
      const setViewProxy = (v: View) => {
        const spaRoot = document.getElementById('root');
        if (spaRoot) {
          setView(v);
        } else {
          window.location.href = `${homeUrl}#view=${v}`;
        }
      };

      const headerComp = (
        <Header currentView={view} setView={setViewProxy} currentLanguage={language} setLanguage={setLanguage} t={t} />
      );
      const footerComp = (
        <Footer t={t} setView={setViewProxy} currentLanguage={language} />
      );

      return (
        <div className={`${language === 'fa' ? 'font-fa' : 'font-en'} bg-gray-50 text-gray-800`}>
          {mountOnHeader && headerEl ? headerComp : null}
          {!mountOnHeader && footerEl ? footerComp : null}
          {mountOnHeader && footerEl ? createPortal(footerComp, footerEl) : null}
          {!mountOnHeader && headerEl ? createPortal(headerComp, headerEl) : null}
        </div>
      );
    };

    shellRoot.render(
      <React.StrictMode>
        <HeaderFooterShell />
      </React.StrictMode>
    );
  }
}
