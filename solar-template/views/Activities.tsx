
import React from 'react';
import type { Translations } from '../types';
import { SunIcon } from '../components/IconComponents';

interface ActivitiesProps {
  t: Translations;
  currentLanguage: 'en' | 'fa';
}

const ActivityCard: React.FC<{ title: string; text: string; imageUrl: string }> = ({ title, text, imageUrl }) => (
  <div className="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:-translate-y-2">
    <img src={imageUrl} alt={title} className="w-full h-48 object-cover" />
    <div className="p-6">
      <div className="flex items-center mb-3">
        <SunIcon className="h-6 w-6 text-yellow-500" />
        <h3 className="ms-3 text-xl font-bold text-gray-800">{title}</h3>
      </div>
      <p className="text-gray-600">{text}</p>
    </div>
  </div>
);

const Activities: React.FC<ActivitiesProps> = ({ t, currentLanguage }) => {
  declare global {
    interface Window {
      __SOLAR_ACTIVITIES__?: Array<{ title: string; text: string; imageUrl?: string }>;
      __SOLAR_ACTIVITIES_EN__?: Array<{ title: string; text: string; imageUrl?: string }>;
      __SOLAR_ACTIVITIES_FA__?: Array<{ title: string; text: string; imageUrl?: string }>;
    }
  }

  const fromWPAll = typeof window !== 'undefined' ? window.__SOLAR_ACTIVITIES__ : undefined;
  const fromWPEn = typeof window !== 'undefined' ? window.__SOLAR_ACTIVITIES_EN__ : undefined;
  const fromWPFa = typeof window !== 'undefined' ? window.__SOLAR_ACTIVITIES_FA__ : undefined;
  const source = currentLanguage === 'fa' ? (fromWPFa && fromWPFa.length ? fromWPFa : fromWPAll) : (fromWPEn && fromWPEn.length ? fromWPEn : fromWPAll);
  const activities = (source && source.length > 0)
    ? source.map(a => ({
        title: a.title,
        text: a.text,
        imageUrl: a.imageUrl || 'https://picsum.photos/seed/activityfallback/600/400'
      }))
    : [
        { title: t.activities.activity1Title, text: t.activities.activity1Text, imageUrl: "https://picsum.photos/seed/farm/600/400" },
        { title: t.activities.activity2Title, text: t.activities.activity2Text, imageUrl: "https://picsum.photos/seed/industrial/600/400" },
        { title: t.activities.activity3Title, text: t.activities.activity3Text, imageUrl: "https://picsum.photos/seed/residential/600/400" },
        { title: t.activities.activity4Title, text: t.activities.activity4Text, imageUrl: "https://picsum.photos/seed/consulting/600/400" },
      ];

  return (
    <div className="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
      <div className="container mx-auto px-6">
        <div className="text-center mb-12">
          <h1 className="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4">{t.activities.title}</h1>
          <p className="max-w-3xl mx-auto text-lg text-gray-600">{t.activities.intro}</p>
        </div>
        <div className="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
          {activities.map((activity, index) => (
            <ActivityCard key={index} {...activity} />
          ))}
        </div>
      </div>
    </div>
  );
};

export default Activities;
