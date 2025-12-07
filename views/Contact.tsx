
import React from 'react';
import type { Translations } from '../types';
import { MailIcon, PhoneIcon, LocationMarkerIcon } from '../components/IconComponents';

interface ContactProps {
  t: Translations;
  currentLanguage: 'en' | 'fa';
}

const Contact: React.FC<ContactProps> = ({ t, currentLanguage }) => {
  declare global {
    interface Window {
      __SOLAR_CONTACT_INFO__?: { address?: string; phone?: string; email?: string; addressEn?: string; addressFa?: string };
      __SOLAR_SITE__?: { address_en?: string; address_fa?: string; phone?: string; email?: string; adminEmail?: string };
    }
  }
  const overrides = typeof window !== 'undefined' ? window.__SOLAR_CONTACT_INFO__ : undefined;
  const site = typeof window !== 'undefined' ? window.__SOLAR_SITE__ : undefined;
  const address = (() => {
    if (currentLanguage === 'fa') return overrides?.addressFa || site?.address_fa || overrides?.address || t.contact.address;
    return overrides?.addressEn || site?.address_en || overrides?.address || t.contact.address;
  })();
  const phone = overrides?.phone || site?.phone || t.contact.phone;
  const email = overrides?.email || site?.email || site?.adminEmail || t.contact.email;
  return (
    <div className="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
      <div className="container mx-auto px-6">
        <div className="text-center mb-12">
          <h1 className="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4">{t.contact.title}</h1>
          <p className="max-w-3xl mx-auto text-lg text-gray-600">{t.contact.intro}</p>
        </div>

        <div className="grid lg:grid-cols-2 gap-12">
          {/* Contact Form */}
          <div className="bg-white p-8 rounded-lg shadow-lg">
            <form>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-gray-700">{t.contact.formName}</label>
                  <input type="text" id="name" className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                  <label htmlFor="email" className="block text-sm font-medium text-gray-700">{t.contact.formEmail}</label>
                  <input type="email" id="email" className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
              </div>
              <div className="mt-6">
                <label htmlFor="subject" className="block text-sm font-medium text-gray-700">{t.contact.formSubject}</label>
                <input type="text" id="subject" className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <div className="mt-6">
                <label htmlFor="message" className="block text-sm font-medium text-gray-700">{t.contact.formMessage}</label>
                <textarea id="message" rows={5} className="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
              </div>
              <div className="mt-6">
                <button type="submit" className="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition-colors">
                  {t.contact.formSubmit}
                </button>
              </div>
            </form>
          </div>

          {/* Contact Information */}
          <div className="space-y-8">
            <div className="bg-white p-8 rounded-lg shadow-lg">
              <h2 className="text-2xl font-bold text-gray-800 mb-6">{t.contact.infoTitle}</h2>
              <ul className="space-y-6 text-gray-600">
                <li className="flex items-start">
                  <LocationMarkerIcon className="h-7 w-7 text-blue-600 flex-shrink-0 mt-1" />
                  <span className="ms-4 text-lg">{address}</span>
                </li>
                <li className="flex items-center">
                  <PhoneIcon className="h-7 w-7 text-blue-600 flex-shrink-0" />
                  <span className="ms-4 text-lg">{phone}</span>
                </li>
                <li className="flex items-center">
                  <MailIcon className="h-7 w-7 text-blue-600 flex-shrink-0" />
                  <span className="ms-4 text-lg">{email}</span>
                </li>
              </ul>
            </div>
            {/* Placeholder for map */}
            <div className="bg-gray-300 h-64 rounded-lg shadow-lg flex items-center justify-center">
              <p className="text-gray-500">Map Placeholder</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Contact;
