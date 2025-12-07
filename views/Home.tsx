
import React from 'react';
import type { Translations } from '../types';
import { SunIcon } from '../components/IconComponents';

interface HomeProps {
  t: Translations;
  setView?: (view: 'home' | 'activities' | 'news' | 'about' | 'contact') => void;
}

const Home: React.FC<HomeProps> = ({ t, setView }) => {
  return (
    <div className="animate-fadeIn">
      {/* Hero Section */}
      <section className="relative bg-gray-900 text-white">
        <img 
          src="https://picsum.photos/seed/solarhome/1920/1080" 
          alt="Solar Panels at Dawn" 
          className="absolute inset-0 w-full h-full object-cover opacity-40" 
        />
        <div className="relative container mx-auto px-6 py-32 lg:py-48 text-center">
          <h1 className="text-4xl md:text-6xl font-bold leading-tight mb-4">{t.hero.title}</h1>
          <p className="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8">{t.hero.subtitle}</p>
          <button
            className="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-full text-lg transition-transform transform hover:scale-105"
            onClick={() => {
              if (setView) {
                setView('activities');
              }
            }}
          >
            {t.hero.cta}
          </button>
        </div>
      </section>

      {/* Introduction Section */}
      <section className="py-16 lg:py-24 bg-white">
        <div className="container mx-auto px-6 text-center">
          <h2 className="text-3xl lg:text-4xl font-bold text-gray-800 mb-6">{t.home.section1Title}</h2>
          <p className="max-w-3xl mx-auto text-gray-600 leading-relaxed">{t.home.section1Text}</p>
        </div>
      </section>

      {/* Why Choose Us Section */}
      <section className="py-16 lg:py-24 bg-gray-50">
        <div className="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
          <div>
            <img 
              src="https://picsum.photos/seed/engineer/800/600" 
              alt="Engineers working" 
              className="rounded-lg shadow-xl"
            />
          </div>
          <div className="prose lg:prose-lg max-w-none">
            <h2 className="text-3xl lg:text-4xl font-bold text-gray-800">{t.home.section2Title}</h2>
            <p className="text-gray-600 leading-relaxed">{t.home.section2Text}</p>
          </div>
        </div>
      </section>
      
      {/* Core Values Section */}
      <section className="py-16 lg:py-24 bg-blue-600 text-white">
        <div className="container mx-auto px-6 text-center">
          <h2 className="text-3xl lg:text-4xl font-bold mb-12">{t.home.section3Title}</h2>
          <div className="grid md:grid-cols-3 gap-8">
            <div className="flex flex-col items-center">
              <div className="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                <SunIcon className="h-12 w-12 text-yellow-300" />
              </div>
              <h3 className="text-2xl font-semibold mb-2">{t.home.section3Item1}</h3>
            </div>
            <div className="flex flex-col items-center">
              <div className="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                <SunIcon className="h-12 w-12 text-yellow-300" />
              </div>
              <h3 className="text-2xl font-semibold mb-2">{t.home.section3Item2}</h3>
            </div>
            <div className="flex flex-col items-center">
               <div className="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                <SunIcon className="h-12 w-12 text-yellow-300" />
              </div>
              <h3 className="text-2xl font-semibold mb-2">{t.home.section3Item3}</h3>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Home;
