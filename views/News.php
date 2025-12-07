<?php
function display_news($translations, $posts) {
?>
<div class="py-16 lg:py-24 bg-gray-50 animate-fadeIn">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600 mb-4"><?php echo $translations['news']['title']; ?></h1>
            <p class="max-w-3xl mx-auto text-lg text-gray-600"><?php echo $translations['news']['intro']; ?></p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                    <img src="<?php echo $post['image_url']; ?>" alt="<?php echo $post['title']; ?>" class="w-full h-56 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-3"><?php echo $post['title']; ?></h3>
                        <p class="text-gray-600 flex-grow"><?php echo mb_substr(strip_tags($post['content']), 0, 100) . '...'; ?></p>
                        <a href="single.php?id=<?php echo $post['id']; ?>" class="mt-4 text-blue-600 hover:text-blue-800 font-semibold flex items-center self-start">
                            <?php echo $translations['news']['readMore']; ?>
                            <?php ChevronRightIcon("w-5 h-5 ms-1"); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
}
?>