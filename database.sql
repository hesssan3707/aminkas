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
(3, 'Amin Kasra Energy’s New Community Project', 'Amin Kasra Energy has broken ground on a new 25-megawatt solar farm. Located just outside the city, this project is a significant step towards achieving local energy independence. The farm is expected to be operational by the end of next year and will provide clean, reliable power to over 5,000 homes, reducing carbon emissions by an estimated 30,000 tons annually. This initiative is part of our ongoing commitment to a sustainable future.', 'We are proud to announce our latest project, a solar farm that will power over 5,000 homes.', 'پروژه اجتماعی جدید شرکت انرژی امین کسری', 'شرکت انرژی امین کسری عملیات احداث یک مزرعه خورشیدی جدید ۲۵ مگاواتی را آغاز کرده است. این پروژه که در حومه شهر واقع شده، گام مهمی در جهت دستیابی به استقلال انرژی محلی است. انتظار می‌رود این مزرعه تا پایان سال آینده به بهره‌برداری برسد و برق پاک و قابل اعتمادی را برای بیش از ۵۰۰۰ خانه فراهم کند و سالانه حدود ۳۰٬۰۰۰ تن از انتشار کربن بکاهد. این ابتکار بخشی از تعهد مستمر ما به آینده‌ای پایدار است.', 'ما با افتخار جدیدترین پروژه خود را معرفی می‌کنیم، یک مزرعه خورشیدی که انرژی بیش از ۵۰۰۰ خانه را تأمین خواهد کرد.', 'https://picsum.photos/seed/news3/600/400', '2025-12-07 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
