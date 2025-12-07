<?php
function display_activities($translations) {
    $activities = [
        [
            'title' => $translations['activities']['activity1Title'],
            'text' => $translations['activities']['activity1Text'],
            'imageUrl' => "https://picsum.photos/seed/farm/600/400"
        ],
        [
            'title' => $translations['activities']['activity2Title'],
            'text' => $translations['activities']['activity2Text'],
            'imageUrl' => "https://picsum.photos/seed/industrial/600/400"
        ],
        [
            'title' => $translations['activities']['activity3Title'],
            'text' => $translations['activities']['activity3Text'],
            'imageUrl' => "https://picsum.photos/seed/residential/600/400"
        ],
        [
            'title' => $translations['activities']['activity4Title'],
            'text' => $translations['activities']['activity4Text'],
            'imageUrl' => "https://picsum.photos/seed/consulting/600/400"
        ],
    ];
?>
<div class="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4"><?php echo $translations['activities']['title']; ?></h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600"><?php echo $translations['activities']['intro']; ?></p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
            <?php foreach ($activities as $activity): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:-translate-y-2">
                    <img src="<?php echo $activity['imageUrl']; ?>" alt="<?php echo $activity['title']; ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <?php SunIcon("h-6 w-6 text-yellow-500"); ?>
                            <h3 class="ms-3 text-xl font-bold text-gray-800"><?php echo $activity['title']; ?></h3>
                        </div>
                        <p class="text-gray-600"><?php echo $activity['text']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
}
?>