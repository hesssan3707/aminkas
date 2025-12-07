<?php
function display_contact($translations, $currentLanguage) {
    $address = $translations['contact']['address'];
    $phone = $translations['contact']['phone'];
    $email = $translations['contact']['email'];
?>
<div class="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4"><?php echo $translations['contact']['title']; ?></h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600"><?php echo $translations['contact']['intro']; ?></p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <form action="contact-handler.php" method="POST">
                    <input type="hidden" name="lang" value="<?php echo $currentLanguage; ?>">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700"><?php echo $translations['contact']['formName']; ?></label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700"><?php echo $translations['contact']['formEmail']; ?></label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700"><?php echo $translations['contact']['formSubject']; ?></label>
                        <input type="text" id="subject" name="subject" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mt-6">
                        <label for="message" class="block text-sm font-medium text-gray-700"><?php echo $translations['contact']['formMessage']; ?></label>
                        <textarea id="message" name="message" rows="5" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition-colors">
                            <?php echo $translations['contact']['formSubmit']; ?>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6"><?php echo $translations['contact']['infoTitle']; ?></h2>
                    <ul class="space-y-6 text-gray-600">
                        <li class="flex items-start">
                            <?php LocationMarkerIcon("h-7 w-7 text-blue-600 flex-shrink-0 mt-1"); ?>
                            <span class="ms-4 text-lg"><?php echo $address; ?></span>
                        </li>
                        <li class="flex items-center">
                            <?php PhoneIcon("h-7 w-7 text-blue-600 flex-shrink-0"); ?>
                            <span class="ms-4 text-lg"><?php echo $phone; ?></span>
                        </li>
                        <li class="flex items-center">
                            <?php MailIcon("h-7 w-7 text-blue-600 flex-shrink-0"); ?>
                            <span class="ms-4 text-lg"><?php echo $email; ?></span>
                        </li>
                    </ul>
                </div>
                <!-- Placeholder for map -->
                <div class="bg-gray-300 h-64 rounded-lg shadow-lg flex items-center justify-center">
                    <p class="text-gray-500">Map Placeholder</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>