-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2025 at 12:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solarenergy`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES
(1, 'company_name_fa', 'انرژی امین کسری'),
(2, 'company_name_en', 'Amin Kasra Energy'),
(3, 'company_quote_fa', 'پیشرو در حرکت به سوی آینده‌ای روشن‌تر و پاک‌تر.'),
(4, 'company_quote_en', 'Leading the charge towards a brighter, cleaner future.'),
(5, 'contact_address_fa', 'تهران، خیابان خورشیدی، پلاک ۱۲۳'),
(6, 'contact_address_en', '123 Solar Avenue, Tehran, Iran'),
(7, 'contact_phone', '+98 21 1234 5678'),
(8, 'contact_email', 'info@aminkasraenergy.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `content_en` text NOT NULL,
  `excerpt_en` text NOT NULL,
  `title_fa` varchar(255) NOT NULL,
  `content_fa` text NOT NULL,
  `excerpt_fa` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title_en`, `content_en`, `excerpt_en`, `title_fa`, `content_fa`, `excerpt_fa`, `image_url`, `created_at`) VALUES
(1, 'Breakthrough in Solar Panel Efficiency', 'In a landmark study published today, researchers have unveiled a new perovskite-based material that promises to revolutionize the solar industry. This material can be applied as a thin film over existing silicon panels, increasing their energy conversion efficiency by up to 30%. This breakthrough could make solar power significantly more cost-effective and accelerate the global transition to renewable energy.', 'Scientists have developed a new material that could significantly boost the efficiency of solar panels.', 'پیشرفتی چشمگیر در بازدهی پنل‌های خورشیدی', 'در یک مطالعه برجسته که امروز منتشر شد، پژوهشگران از یک ماده جدید مبتنی بر پروسکایت رونمایی کرده‌اند که وعده تحول در صنعت خورشیدی را می‌دهد. این ماده می‌تواند به صورت یک لایه نازک روی پنل‌های سیلیکونی موجود اعمال شود و بازدهی تبدیل انرژی آن‌ها را تا ۳۰ درصد افزایش دهد. این پیشرفت می‌تواند انرژی خورشیدی را به طور قابل توجهی مقرون‌به‌صرفه‌تر کرده و گذار جهانی به انرژی‌های تجدیدپذیر را تسریع بخشد.', 'دانشمندان ماده جدیدی را توسعه داده‌اند که می‌تواند بازدهی پنل‌های خورشیدی را به طور قابل توجهی افزایش دهد.', 'https://picsum.photos/seed/news1/600/400', '2025-12-07 00:00:00'),
(2, 'Global Shift to Renewable Energy', 'The International Energy Agency (IEA) has released its annual report, showing a record increase in renewable energy capacity worldwide. Solar power accounted for over two-thirds of this growth. The report emphasizes that government policies and falling technology costs are the primary drivers of this rapid shift. Experts believe we are at a critical tipping point in the fight against climate change.', 'A new report highlights the accelerating trend of countries moving away from fossil fuels towards renewables.', 'تغییر جهانی به سمت انرژی‌های تجدیدپذیر', 'آژانس بین‌المللی انرژی (IEA) گزارش سالانه خود را منتشر کرده است که نشان‌دهنده افزایش بی‌سابقه ظرفیت انرژی‌های تجدیدپذیر در سراسر جهان است. انرژی خورشیدی بیش از دو سوم این رشد را به خود اختصاص داده است. این گزارش تأکید می‌کند که سیاست‌های دولتی و کاهش هزینه‌های فناوری، محرک‌های اصلی این تغییر سریع هستند. کارشناسان معتقدند ما در یک نقطه عطف حیاتی در مبارزه با تغییرات اقلیمی قرار داریم.', 'گزارش جدیدی بر روند شتابان کشورها در حرکت از سوخت‌های فسیلی به سمت انرژی‌های تجدیدپذیر تأکید دارد.', 'https://picsum.photos/seed/news2/600/400', '2025-12-07 00:00:00'),
(3, 'Amin Kasra Energy’s New Community Project', 'Amin Kasra Energy has broken ground on a new 25-megawatt solar farm. Located just outside the city, this project is a significant step towards achieving local energy independence. The farm is expected to be operational by the end of next year and will provide clean, reliable power to over 5,000 homes, reducing carbon emissions by an estimated 30,000 tons annually. This initiative is part of our ongoing commitment to a sustainable future.', 'We are proud to announce our latest project, a solar farm that will power over 5,000 homes.', 'پروژه اجتماعی جدید شرکت انرژی امین کسری', 'شرکت انرژی امین کسری عملیات احداث یک مزرعه خورشیدی جدید ۲۵ مگاواتی را آغاز کرده است. این پروژه که در حومه شهر واقع شده، گام مهمی در جهت دستیابی به استقلال انرژی محلی است. انتظار می‌رود این مزرعه تا پایان سال آینده به بهره‌برداری برسد و برق پاک و قابل اعتمادی را برای بیش از ۵۰۰۰ خانه فراهم کند و سالانه حدود ۳۰٬۰۰۰ تن از انتشار کربن بکاهد. این ابتکار بخشی از تعهد مستمر ما به آینده‌ای پایدار است.', 'ما با افتخار جدیدترین پروژه خود را معرفی می‌کنیم، یک مزرعه خورشیدی که انرژی بیش از ۵۰۰۰ خانه را تأمین خواهد کرد.', 'https://picsum.photos/seed/news3/600/400', '2025-12-07 00:00:00'),
(4, 'How Do Solar Panels Work?', 'Solar panels are composed of photovoltaic (PV) cells, which are made from silicon. When sunlight strikes these cells, it creates an electric field. This field forces electrons to move, generating a direct current (DC). This DC electricity is then converted into alternating current (AC) by an inverter, making it usable for powering homes and businesses. This clean, silent process harnesses the most abundant energy source on our planet.', 'A brief explanation of the photovoltaic process that powers our world.', 'پنل‌های خورشیدی چگونه کار می‌کنند؟', 'پنل‌های خورشیدی از سلول‌های فتوولتائیک (PV) تشکیل شده‌اند که از سیلیکون ساخته شده‌اند. هنگامی که نور خورشید به این سلول‌ها برخورد می‌کند، یک میدان الکتریکی ایجاد می‌شود. این میدان الکترون‌ها را وادار به حرکت کرده و جریان مستقیم (DC) تولید می‌کند. سپس این برق DC توسط یک اینورتر به جریان متناوب (AC) تبدیل می‌شود و برای تأمین برق خانه‌ها و کسب‌وکارها قابل استفاده می‌گردد. این فرآیند پاک و بی‌صدا، فراوان‌ترین منبع انرژی روی سیاره ما را مهار می‌کند.', 'توضیحی مختصر درباره فرآیند فتوولتائیک که به دنیای ما نیرو می‌بخشد.', 'https://picsum.photos/seed/post4/600/400', '2025-12-07 00:00:00'),
(5, 'The Environmental Benefits of Solar Energy', 'Switching to solar power offers significant environmental advantages. It produces no greenhouse gas emissions, reducing our collective carbon footprint and combating climate change. Unlike fossil fuels, it doesn’t pollute our air or water resources. By relying on the sun, we decrease our dependence on finite resources, promoting a more sustainable and healthier planet for future generations. Every panel installed is a step towards a cleaner world.', 'Discover how solar power helps protect our planet.', 'مزایای زیست‌محیطی انرژی خورشیدی', 'روی آوردن به انرژی خورشیدی مزایای زیست‌محیطی قابل توجهی را به همراه دارد. این انرژی هیچ‌گونه گاز گلخانه‌ای تولید نمی‌کند و با کاهش ردپای کربنی جمعی ما، به مبارزه با تغییرات اقلیمی کمک می‌کند. برخلاف سوخت‌های فسیلی، انرژی خورشیدی منابع آب و هوای ما را آلوده نمی‌کند. با تکیه بر خورشید، ما وابستگی خود به منابع محدود را کاهش داده و سیاره‌ای پایدارتر و سالم‌تر برای نسل‌های آینده ترویج می‌دهیم. هر پنلی که نصب می‌شود، گامی به سوی دنیایی پاک‌تر است.', 'کشف کنید که چگونه انرژی خورشیدی به حفاظت از سیاره ما کمک می‌کند.', 'https://picsum.photos/seed/post5/600/400', '2025-12-07 00:00:00'),
(6, 'Economic Advantages of Going Solar', 'Investing in solar panels is not just good for the environment; it’s also a smart financial decision. Solar energy can drastically reduce or even eliminate your electricity bills, saving you money for decades. Additionally, many governments offer tax credits and rebates for solar installations. By generating your own clean power, you gain energy independence and are protected from rising utility costs, ensuring predictable energy expenses for years to come.', 'Learn how solar panels can save you money and increase your energy independence.', 'مزایای اقتصادی روی آوردن به انرژی خورشیدی', 'سرمایه‌گذاری در پنل‌های خورشیدی تنها برای محیط زیست مفید نیست؛ بلکه یک تصمیم مالی هوشمندانه نیز محسوب می‌شود. انرژی خورشیدی می‌تواند به شدت قبض‌های برق شما را کاهش داده یا حتی حذف کند و برای دهه‌ها در پول شما صرفه‌جویی کند. علاوه بر این، بسیاری از دولت‌ها برای نصب پنل‌های خورشیدی اعتبارات مالیاتی و تخفیف‌هایی ارائه می‌دهند. با تولید برق پاک خود، شما به استقلال انرژی دست یافته و از افزایش هزینه‌های شرکت‌های برق در امان می‌مانید و هزینه‌های انرژی قابل پیش‌بینی را برای سال‌های آینده تضمین می‌کنید.', 'بیاموزید که چگونه پنل‌های خورشیدی می‌توانند در پول شما صرفه‌جویی کرده و استقلال انرژی شما را افزایش دهند.', 'https://picsum.photos/seed/post6/600/400', '2025-12-07 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
