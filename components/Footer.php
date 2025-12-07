<?php
function display_footer($currentLanguage, $translations) {
    $address = $translations['contact']['address'];
    $phone = $translations['contact']['phone'];
    $email = $translations['contact']['email'];

    $navLinks = [
        ['view' => 'home', 'label' => $translations['header']['home']],
        ['view' => 'activities', 'label' => $translations['header']['activities']],
        ['view' => 'news', 'label' => $translations['header']['news']],
        ['view' => 'about', 'label' => $translations['header']['about']],
        ['view' => 'contact', 'label' => $translations['header']['contact']],
    ];
?>
<footer class="bg-gray-800 text-white">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-4">
                <div class="flex items-center">
                    <?php SunIcon("h-8 w-8 text-yellow-400"); ?>
                    <span class="ms-3 text-xl font-bold"><?php echo $translations['header']['companyName']; ?></span>
                </div>
                <p class="text-gray-400"><?php echo $translations['footer']['companyQuote']; ?></p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold uppercase tracking-wider"><?php echo $translations['footer']['quickLinks']; ?></h3>
                <ul class="mt-4 space-y-2">
                    <?php foreach ($navLinks as $link): ?>
                        <li>
                            <a href="?view=<?php echo $link['view']; ?>&lang=<?php echo $currentLanguage; ?>" class="text-gray-400 hover:text-white transition-colors"><?php echo $link['label']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold uppercase tracking-wider"><?php echo $translations['footer']['contactInfo']; ?></h3>
                <ul class="mt-4 space-y-3">
                    <li class="flex items-start">
                        <?php LocationMarkerIcon("h-6 w-6 text-yellow-400 flex-shrink-0 mt-1"); ?>
                        <span class="ms-3 text-gray-400"><?php echo $address; ?></span>
                    </li>
                    <li class="flex items-center">
                        <?php PhoneIcon("h-6 w-6 text-yellow-400 flex-shrink-0"); ?>
                        <span class="ms-3 text-gray-400"><?php echo $phone; ?></span>
                    </li>
                    <li class="flex items-center">
                        <?php MailIcon("h-6 w-6 text-yellow-400 flex-shrink-0"); ?>
                        <span class="ms-3 text-gray-400"><?php echo $email; ?></span>
                    </li>
                </ul>
            </div>

            <!-- Placeholder for a map or newsletter -->
            <div class="bg-gray-700 rounded-lg p-4 text-center flex items-center justify-center">
                <p class="text-gray-400">Future Section: Newsletter Signup</p>
            </div>
        </div>

        <div class="mt-12 border-t border-gray-700 pt-8 text-center text-gray-400">
            <p>
                <?php
                $year = date("Y");
                if ($currentLanguage === 'fa') {
                    echo "© $year {$translations['header']['companyName']}. تمامی حقوق محفوظ است.";
                } else {
                    echo "© $year {$translations['header']['companyName']}. All rights reserved.";
                }
                ?>
            </p>
        </div>
    </div>
</footer>
<?php
}
?>