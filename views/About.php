<?php
function display_about($currentLanguage, $translations) {
    $companyName = "انرژی امین کسری";
    $aboutTitle = $currentLanguage === 'fa' ? "درباره " . $companyName : "About " . $companyName;
?>
<div class="py-16 lg:py-24 bg-white animate-fadeIn">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4"><?php echo $aboutTitle; ?></h1>
        </div>

        <div class="grid lg:grid-cols-5 gap-12 items-center">
            <div class="lg:col-span-3 prose lg:prose-xl max-w-none text-gray-600">
                <p><?php echo str_replace("Solar Transition Co.", $companyName, $translations['about']['p1']); ?></p>
                <p><?php echo str_replace("Solar Transition Co.", $companyName, $translations['about']['p2']); ?></p>
                <p><?php echo str_replace("Solar Transition Co.", $companyName, $translations['about']['p3']); ?></p>
            </div>
            <div class="lg:col-span-2">
                <img src="https://picsum.photos/seed/team/600/700" alt="Company Team" class="rounded-lg shadow-2xl w-full h-auto object-cover">
            </div>
        </div>

        <div class="mt-20 grid md:grid-cols-2 gap-10">
            <div class="bg-gray-50 p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $translations['about']['visionTitle']; ?></h2>
                <p class="text-gray-600"><?php echo $translations['about']['visionText']; ?></p>
            </div>
            <div class="bg-blue-50 p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-gray-800 mb-4"><?php echo $translations['about']['missionTitle']; ?></h2>
                <p class="text-gray-600"><?php echo $translations['about']['missionText']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php
}
?>