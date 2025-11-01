    </main>
    <footer class="bg-gray-800 text-white">
      <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div class="space-y-4">
            <div class="flex items-center">
              <svg class="h-8 w-8 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-6.364-.386 1.591-1.591M3 12h2.25m.386-6.364 1.591 1.591M12 12a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" /></svg>
              <span class="ms-3 text-xl font-bold">شرکت گذار انرژی خورشیدی</span>
            </div>
            <p class="text-gray-400">آینده‌ای پایدار با انرژی پاک خورشیدی.</p>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-semibold uppercase tracking-wider">لینک‌های سریع</h3>
            <ul class="mt-4 space-y-2">
                 <li><a href="<?php echo home_url(); ?>" class="text-gray-400 hover:text-white transition-colors">خانه</a></li>
                 <li><a href="#" class="text-gray-400 hover:text-white transition-colors">فعالیت ها</a></li>
                 <li><a href="#" class="text-gray-400 hover:text-white transition-colors">اخبار</a></li>
                 <li><a href="#" class="text-gray-400 hover:text-white transition-colors">درباره ما</a></li>
                 <li><a href="#" class="text-gray-400 hover:text-white transition-colors">تماس با ما</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div>
            <h3 class="text-lg font-semibold uppercase tracking-wider">اطلاعات تماس</h3>
            <ul class="mt-4 space-y-3">
              <li class="flex items-start">
                <svg class="h-6 w-6 text-yellow-400 flex-shrink-0 mt-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                <span class="ms-3 text-gray-400">ایران، تهران، خیابان آزادی، پلاک ۱۲۳</span>
              </li>
              <li class="flex items-center">
                <svg class="h-6 w-6 text-yellow-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                <span class="ms-3 text-gray-400">۰۲۱-۱۲۳۴۵۶۷۸</span>
              </li>
              <li class="flex items-center">
                <svg class="h-6 w-6 text-yellow-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                <span class="ms-3 text-gray-400">info@solartransition.co</span>
              </li>
            </ul>
          </div>

          <!-- Placeholder -->
          <div class="bg-gray-700 rounded-lg p-4 text-center flex items-center justify-center">
            <p class="text-gray-400">بخش آینده: ثبت‌نام در خبرنامه</p>
          </div>
        </div>

        <div class="mt-12 border-t border-gray-700 pt-8 text-center text-gray-400">
          <p>&copy; <?php echo date('Y'); ?> شرکت گذار انرژی خورشیدی. تمامی حقوق محفوظ است.</p>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
