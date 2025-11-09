
import React from 'react';
import type { Translations } from '../types';
import type { View } from '../App';
import { SunIcon, MailIcon, PhoneIcon, LocationMarkerIcon } from './IconComponents';

interface FooterProps {
  t: Translations;
  setView: (view: View) => void;
  currentLanguage: 'en' | 'fa';
}

const Footer: React.FC<FooterProps> = ({ t, setView, currentLanguage }) => {
  declare global {
    interface Window {
      __SOLAR_CONTACT_INFO__?: { companyName?: string; address?: string; phone?: string; email?: string; companyNameEn?: string; companyNameFa?: string; addressEn?: string; addressFa?: string };
      __SOLAR_SITE__?: { title?: string; adminEmail?: string; title_en?: string; title_fa?: string; address_en?: string; address_fa?: string; phone?: string; email?: string };
    }
  }

  const contactOverrides = typeof window !== 'undefined' ? window.__SOLAR_CONTACT_INFO__ : undefined;
  const companyName = (() => {
    if (typeof window !== 'undefined') {
      const site = window.__SOLAR_SITE__;
      const contact = contactOverrides;
      if (currentLanguage === 'fa') return site?.title_fa || contact?.companyNameFa || site?.title || contact?.companyName || t.header.companyName;
      return site?.title_en || contact?.companyNameEn || site?.title || contact?.companyName || t.header.companyName;
    }
    return t.header.companyName;
  })();
  const address = (() => {
    if (typeof window !== 'undefined') {
      const site = window.__SOLAR_SITE__;
      const contact = contactOverrides;
      if (currentLanguage === 'fa') return contact?.addressFa || site?.address_fa || contact?.address || t.contact.address;
      return contact?.addressEn || site?.address_en || contact?.address || t.contact.address;
    }
    return t.contact.address;
  })();
  const phone = (contactOverrides?.phone || (typeof window !== 'undefined' ? window.__SOLAR_SITE__?.phone : undefined) || t.contact.phone);
  const email = (contactOverrides?.email || (typeof window !== 'undefined' ? (window.__SOLAR_SITE__?.email || window.__SOLAR_SITE__?.adminEmail) : undefined) || t.contact.email);
  const navLinks: { view: View; label: string }[] = [
    { view: 'home', label: t.header.home },
    { view: 'activities', label: t.header.activities },
    { view: 'news', label: t.header.news },
    { view: 'about', label: t.header.about },
    { view: 'contact', label: t.header.contact },
  ];

  return (
    <footer className="bg-gray-800 text-white">
      <div className="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="space-y-4">
            <div className="flex items-center">
              <SunIcon className="h-8 w-8 text-yellow-400" />
              <span className="ms-3 text-xl font-bold">{companyName}</span>
            </div>
            <p className="text-gray-400">{t.footer.companyQuote}</p>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-lg font-semibold uppercase tracking-wider">{t.footer.quickLinks}</h3>
            <ul className="mt-4 space-y-2">
              {navLinks.map(link => (
                 <li key={link.view}>
                    <button onClick={() => setView(link.view)} className="text-gray-400 hover:text-white transition-colors">{link.label}</button>
                 </li>
              ))}
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h3 className="text-lg font-semibold uppercase tracking-wider">{t.footer.contactInfo}</h3>
            <ul className="mt-4 space-y-3">
              <li className="flex items-start">
                <LocationMarkerIcon className="h-6 w-6 text-yellow-400 flex-shrink-0 mt-1" />
                <span className="ms-3 text-gray-400">{address}</span>
              </li>
              <li className="flex items-center">
                <PhoneIcon className="h-6 w-6 text-yellow-400 flex-shrink-0" />
                <span className="ms-3 text-gray-400">{phone}</span>
              </li>
              <li className="flex items-center">
                <MailIcon className="h-6 w-6 text-yellow-400 flex-shrink-0" />
                <span className="ms-3 text-gray-400">{email}</span>
              </li>
            </ul>
          </div>

          {/* Placeholder for a map or newsletter */}
          <div className="bg-gray-700 rounded-lg p-4 text-center flex items-center justify-center">
            <p className="text-gray-400">Future Section: Newsletter Signup</p>
          </div>
        </div>

        <div className="mt-12 border-t border-gray-700 pt-8 text-center text-gray-400">
          {(() => {
            const year = new Date().getFullYear();
            const text = currentLanguage === 'fa'
              ? `© ${year} ${companyName}. تمامی حقوق محفوظ است.`
              : `© ${year} ${companyName}. All rights reserved.`;
            return <p>{text}</p>;
          })()}
        </div>
      </div>
    </footer>
  );
};

export default Footer;
