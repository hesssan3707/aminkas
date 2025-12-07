
import React, { useState } from 'react';
import type { View, Language } from '../App';
import type { Translations } from '../types';
import { SunIcon, MenuIcon, XIcon } from './IconComponents';

interface HeaderProps {
  currentView: View;
  setView: (view: View) => void;
  currentLanguage: Language;
  setLanguage: (lang: Language) => void;
  t: Translations;
}

const Header: React.FC<HeaderProps> = ({ setView, currentLanguage, setLanguage, t }) => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  declare global {
    interface Window {
      __SOLAR_CONTACT_INFO__?: { companyName?: string; companyNameEn?: string; companyNameFa?: string };
      __SOLAR_SITE__?: { title?: string; title_en?: string; title_fa?: string };
    }
  }
  const siteTitle = (() => {
    if (typeof window !== 'undefined') {
      const site = window.__SOLAR_SITE__;
      const contact = window.__SOLAR_CONTACT_INFO__;
      if (currentLanguage === 'fa') {
        return site?.title_fa || contact?.companyNameFa || site?.title || contact?.companyName || t.header.companyName;
      }
      return site?.title_en || contact?.companyNameEn || site?.title || contact?.companyName || t.header.companyName;
    }
    return t.header.companyName;
  })();

  const navLinks: { view: View; label: string }[] = [
    { view: 'home', label: t.header.home },
    { view: 'activities', label: t.header.activities },
    { view: 'news', label: t.header.news },
    { view: 'about', label: t.header.about },
    { view: 'contact', label: t.header.contact },
  ];

  const handleLanguageSwitch = () => {
    setLanguage(currentLanguage === 'en' ? 'fa' : 'en');
  };
  
  const handleSetView = (view: View) => {
    setView(view);
    setIsMenuOpen(false);
  }

  return (
    <header className="bg-white shadow-md sticky top-0 z-50">
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-20">
          <div className="flex items-center cursor-pointer" onClick={() => handleSetView('home')}>
            <SunIcon className="h-8 w-8 text-yellow-500" />
            <h1 className={`ms-2 text-xl font-bold text-gray-800 ${currentLanguage === 'fa' ? 'font-fa' : 'font-en'}`}>{siteTitle}</h1>
          </div>
          
          <div className="hidden md:flex items-center space-x-4 lg:space-x-8">
            {navLinks.map((link) => (
              <button
                key={link.view}
                onClick={() => handleSetView(link.view)}
                className="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors"
              >
                {link.label}
              </button>
            ))}
            <button
              onClick={handleLanguageSwitch}
              className="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
            >
              {t.header.switchLanguage}
            </button>
          </div>

          <div className="md:hidden flex items-center">
            <button onClick={() => setIsMenuOpen(!isMenuOpen)}>
              {isMenuOpen ? <XIcon className="h-6 w-6" /> : <MenuIcon className="h-6 w-6" />}
            </button>
          </div>
        </div>
      </div>

      {isMenuOpen && (
        <div className="md:hidden bg-white border-t">
          <div className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            {navLinks.map((link) => (
              <button
                key={link.view}
                onClick={() => handleSetView(link.view)}
                className="text-gray-600 hover:bg-gray-100 hover:text-blue-600 block w-full text-start px-3 py-2 rounded-md text-base font-medium"
              >
                {link.label}
              </button>
            ))}
            <div className="px-3 py-2">
              <button
                onClick={handleLanguageSwitch}
                className="bg-blue-500 hover:bg-blue-600 text-white w-full px-4 py-2 rounded-md text-sm font-medium transition-colors"
              >
                {t.header.switchLanguage}
              </button>
            </div>
          </div>
        </div>
      )}
    </header>
  );
};

export default Header;
