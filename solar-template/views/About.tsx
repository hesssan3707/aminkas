
import React from 'react';
import type { Translations } from '../types';

interface AboutProps {
  t: Translations;
}

const About: React.FC<AboutProps> = ({ t }) => {
  return (
    <div className="py-16 lg:py-24 bg-white animate-fadeIn">
      <div className="container mx-auto px-6">
        <div className="text-center mb-16">
          <h1 className="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4">{t.about.title}</h1>
        </div>

        <div className="grid lg:grid-cols-5 gap-12 items-center">
          <div className="lg:col-span-3 prose lg:prose-xl max-w-none text-gray-600">
            <p>{t.about.p1}</p>
            <p>{t.about.p2}</p>
            <p>{t.about.p3}</p>
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
