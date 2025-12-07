<?php
require_once 'IconComponents.php';

function display_header($currentView, $currentLanguage, $translations) {
    $navLinks = [
        ['view' => 'home', 'label' => $translations['header']['home']],
        ['view' => 'activities', 'label' => $translations['header']['activities']],
        ['view' => 'news', 'label' => $translations['header']['news']],
        ['view' => 'about', 'label' => $translations['header']['about']],
        ['view' => 'contact', 'label' => $translations['header']['contact']],
    ];
?>
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="?view=home" class="flex items-center cursor-pointer">
                <?php SunIcon("h-8 w-8 text-yellow-500"); ?>
                <h1 class="ms-2 text-xl font-bold text-gray-800 <?php echo $currentLanguage === 'fa' ? 'font-fa' : 'font-en'; ?>"><?php echo $translations['header']['companyName']; ?></h1>
            </a>

            <div class="hidden md:flex items-center space-x-4 lg:space-x-8">
                <?php foreach ($navLinks as $link): ?>
                    <a href="?view=<?php echo $link['view']; ?>&lang=<?php echo $currentLanguage; ?>" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <?php echo $link['label']; ?>
                    </a>
                <?php endforeach; ?>
                <a href="?view=<?php echo $currentView; ?>&lang=<?php echo $currentLanguage === 'en' ? 'fa' : 'en'; ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <?php echo $translations['header']['switchLanguage']; ?>
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button">
                    <?php MenuIcon("h-6 w-6"); ?>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden bg-white border-t hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <?php foreach ($navLinks as $link): ?>
                <a href="?view=<?php echo $link['view']; ?>&lang=<?php echo $currentLanguage; ?>" class="text-gray-600 hover:bg-gray-100 hover:text-blue-600 block w-full text-start px-3 py-2 rounded-md text-base font-medium">
                    <?php echo $link['label']; ?>
                </a>
            <?php endforeach; ?>
            <div class="px-3 py-2">
                <a href="?view=<?php echo $currentView; ?>&lang=<?php echo $currentLanguage === 'en' ? 'fa' : 'en'; ?>" class="bg-blue-500 hover:bg-blue-600 text-white w-full block text-center px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <?php echo $translations['header']['switchLanguage']; ?>
                </a>
            </div>
        </div>
    </div>
</header>
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
        this.innerHTML = menu.classList.contains('hidden') ? '<?php MenuIcon("h-6 w-6"); ?>' : '<?php XIcon("h-6 w-6"); ?>';
    });
</script>
<?php
}
?>