<?php
function display_single_post($post) {
?>
<div class="py-16 lg:py-24 bg-white animate-fadeIn">
    <div class="container mx-auto px-6">
        <article class="max-w-4xl mx-auto">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4"><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="text-gray-500 mb-8">
                <span>Published on <?php echo date('F j, Y', strtotime($post['created_at'])); ?></span>
            </div>
            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" class="w-full h-auto object-cover rounded-lg shadow-lg mb-8">
            <div class="prose lg:prose-xl max-w-none text-gray-800">
                <?php echo $post['content']; ?>
            </div>
        </article>
    </div>
</div>
<?php
}
?>