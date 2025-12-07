<?php
function display_home($translations, $currentLanguage) {
?>
<div class="animate-fadeIn">
    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white">
        <img src="https://picsum.photos/seed/solarhome/1920/1080" alt="Solar Panels at Dawn" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative container mx-auto px-6 py-32 lg:py-48 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4"><?php echo $translations['hero']['title']; ?></h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8"><?php echo $translations['hero']['subtitle']; ?></p>
            <a href="?view=activities&lang=<?php echo $currentLanguage; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-full text-lg transition-transform transform hover:scale-105">
                <?php echo $translations['hero']['cta']; ?>
            </a>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-6"><?php echo $translations['home']['section1Title']; ?></h2>
            <p class="max-w-3xl mx-auto text-gray-600 leading-relaxed"><?php echo $translations['home']['section1Text']; ?></p>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <img src="https://picsum.photos/seed/engineer/800/600" alt="Engineers working" class="rounded-lg shadow-xl">
            </div>
            <div class="prose lg:prose-lg max-w-none">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800"><?php echo $translations['home']['section2Title']; ?></h2>
                <p class="text-gray-600 leading-relaxed"><?php echo $translations['home']['section2Text']; ?></p>
            </div>
        </div>
    </section>

    <!-- Core Values Section -->
    <section class="py-16 lg:py-24 bg-blue-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-12"><?php echo $translations['home']['section3Title']; ?></h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center">
                    <div class="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                        <?php SunIcon("h-12 w-12 text-yellow-300"); ?>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2"><?php echo $translations['home']['section3Item1']; ?></h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                        <?php SunIcon("h-12 w-12 text-yellow-300"); ?>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2"><?php echo $translations['home']['section3Item2']; ?></h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-white bg-opacity-20 p-6 rounded-full mb-4">
                        <?php SunIcon("h-12 w-12 text-yellow-300"); ?>
                    </div>
                    <h3 class="text-2xl font-semibold mb-2"><?php echo $translations['home']['section3Item3']; ?></h3>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
}
?>