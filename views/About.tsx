
import React from 'react';
import type { Translations } from '../types';

interface AboutProps {
  t: Translations;
  currentLanguage: 'en' | 'fa';
}

const About: React.FC<AboutProps> = ({ t, currentLanguage }) => {
  declare global {
    interface Window {
      __SOLAR_CONTACT_INFO__?: { companyName?: string; companyNameEn?: string; companyNameFa?: string };
      __SOLAR_SITE__?: { title?: string; title_en?: string; title_fa?: string };
    }
  }
  const site = typeof window !== 'undefined' ? window.__SOLAR_SITE__ : undefined;
  const contact = typeof window !== 'undefined' ? window.__SOLAR_CONTACT_INFO__ : undefined;
  const companyName = currentLanguage === 'fa'
    ? (site?.title_fa || contact?.companyNameFa || site?.title || contact?.companyName || '')
    : (site?.title_en || contact?.companyNameEn || site?.title || contact?.companyName || '');
  const aboutTitle = currentLanguage === 'fa' ? `درباره ${companyName || 'شرکت'}` : `About ${companyName || 'Our Company'}`;
  const replaceCompany = (text: string) => {
    if (!text || !companyName) return text;
    let out = text;
    // English legacy name
    out = out.replace(/Solar\s+Transition\s+Co\.?/gi, companyName);
    // Persian legacy name variants: optional "شرکت" and optional ZWNJ between words
    const ws = "[\u200C\s]*"; // space or ZWNJ
    const faPattern = new RegExp(`(?:شرکت${ws})?گذار${ws}به${ws}خورشید`, 'gu');
    out = out.replace(faPattern, companyName);
    return out;
  };
  const p1 = replaceCompany(t.about.p1);
  const p2 = replaceCompany(t.about.p2);
  const p3 = replaceCompany(t.about.p3);
  return (
    <div className="py-16 lg:py-24 bg-white animate-fadeIn">
      <div className="container mx-auto px-6">
        <div className="text-center mb-16">
          <h1 className="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4">{aboutTitle}</h1>
        </div>

        <div className="grid lg:grid-cols-5 gap-12 items-center">
          <div className="lg:col-span-3 prose lg:prose-xl max-w-none text-gray-600">
            <p>{p1}</p>
            <p>{p2}</p>
            <p>{p3}</p>
          </div>
          <div className="lg:col-span-2">
            <img 
              src="https://picsum.photos/seed/team/600/700" 
              alt="Company Team" 
              className="rounded-lg shadow-2xl w-full h-auto object-cover"
            />
          </div>
        </div>
        
        <div className="mt-20 grid md:grid-cols-2 gap-10">
            <div className="bg-gray-50 p-8 rounded-lg shadow-md">
                <h2 className="text-3xl font-bold text-gray-800 mb-4">{t.about.visionTitle}</h2>
                <p className="text-gray-600">{t.about.visionText}</p>
            </div>
             <div className="bg-blue-50 p-8 rounded-lg shadow-md">
                <h2 className="text-3xl font-bold text-gray-800 mb-4">{t.about.missionTitle}</h2>
                <p className="text-gray-600">{t.about.missionText}</p>
            </div>
        </div>
      </div>
    </div>
  );
};

export default About;
