
import React from 'react';
import type { Translations } from '../types';
import { ChevronRightIcon } from '../components/IconComponents';

interface NewsProps {
  t: Translations;
  currentLanguage: 'en' | 'fa';
}

declare global {
  interface Window {
    __SOLAR_POSTS__?: Array<{ title: string; excerpt: string; link: string; imageUrl?: string }>;
    __SOLAR_POSTS_EN__?: Array<{ title: string; excerpt: string; link: string; imageUrl?: string }>;
    __SOLAR_POSTS_FA__?: Array<{ title: string; excerpt: string; link: string; imageUrl?: string }>;
  }
}

const ArticleCard: React.FC<{ title: string; text: string; imageUrl: string; readMore: string; link?: string }> = ({ title, text, imageUrl, readMore, link }) => (
  <div className="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
    <img src={imageUrl} alt={title} className="w-full h-56 object-cover" />
    <div className="p-6 flex flex-col flex-grow">
      <h3 className="text-xl font-bold text-gray-800 mb-3">{title}</h3>
      <p className="text-gray-600 flex-grow">{text}</p>
      {link ? (
        <a href={link} className="mt-4 text-blue-600 hover:text-blue-800 font-semibold flex items-center self-start">
          {readMore}
          <ChevronRightIcon className="w-5 h-5 ms-1" />
        </a>
      ) : (
        <span className="mt-4 text-gray-400 flex items-center self-start">
          {readMore}
          <ChevronRightIcon className="w-5 h-5 ms-1" />
        </span>
      )}
    </div>
  </div>
);

const News: React.FC<NewsProps> = ({ t, currentLanguage }) => {
  const wpPostsAll = typeof window !== 'undefined' ? window.__SOLAR_POSTS__ : undefined;
  const wpPostsEn = typeof window !== 'undefined' ? window.__SOLAR_POSTS_EN__ : undefined;
  const wpPostsFa = typeof window !== 'undefined' ? window.__SOLAR_POSTS_FA__ : undefined;

  const source = currentLanguage === 'fa' ? (wpPostsFa && wpPostsFa.length ? wpPostsFa : wpPostsAll) : (wpPostsEn && wpPostsEn.length ? wpPostsEn : wpPostsAll);
  const articles = source && source.length > 0
    ? source.map(p => ({ title: p.title, text: p.excerpt, imageUrl: p.imageUrl || "https://picsum.photos/seed/newsfallback/600/400", link: p.link }))
    : [
        { title: t.news.article1Title, text: t.news.article1Text, imageUrl: "https://picsum.photos/seed/news1/600/400" },
        { title: t.news.article2Title, text: t.news.article2Text, imageUrl: "https://picsum.photos/seed/news2/600/400" },
        { title: t.news.article3Title, text: t.news.article3Text, imageUrl: "https://picsum.photos/seed/news3/600/400" },
      ];

  return (
    <div className="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
      <div className="container mx-auto px-6">
        <div className="text-center mb-12">
          <h1 className="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4">{t.news.title}</h1>
          <p className="max-w-3xl mx-auto text-lg text-gray-600">{t.news.intro}</p>
        </div>
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {articles.map((article, index) => (
            <ArticleCard key={index} {...article} readMore={t.news.readMore} />
          ))}
        </div>
      </div>
    </div>
  );
};

export default News;
