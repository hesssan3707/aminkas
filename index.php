<?php
// db.php
require_once 'db.php';

// Fetch all options from the database
$options = get_options($conn);

// Include translations
require_once 'localization.php';

// Determine current language
$currentLanguage = isset($_GET['lang']) && $_GET['lang'] === 'en' ? 'en' : 'fa';
$translations = $currentLanguage === 'en' ? $en_translations : $fa_translations;

// Determine current view
$currentView = isset($_GET['view']) ? $_GET['view'] : 'home';

// Fetch posts for the news page
$posts = [];
if ($currentView === 'news') {
    $posts = get_all_posts($conn, $currentLanguage);
}

// Include components
require_once 'components/Header.php';
require_once 'components/Footer.php';
require_once 'components/IconComponents.php';

// Include views
require_once 'views/Home.php';
require_once 'views/Activities.php';
require_once 'views/News.php';
require_once 'views/About.php';
require_once 'views/Contact.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $currentLanguage; ?>" dir="<?php echo $currentLanguage === 'fa' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['header']['companyName']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', 'Vazirmatn', sans-serif;
        }
        .font-fa {
            font-family: 'Vazirmatn', sans-serif;
        }
        .font-en {
            font-family: 'Poppins', sans-serif;
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="<?php echo $currentLanguage === 'fa' ? 'font-fa' : 'font-en'; ?> bg-gray-50 text-gray-800">
    <?php display_header($currentView, $currentLanguage, $translations); ?>

    <main class="min-h-screen">
        <?php
        switch ($currentView) {
            case 'activities':
                display_activities($translations);
                break;
            case 'news':
                display_news($translations, $posts);
                break;
            case 'about':
                display_about($currentLanguage, $translations);
                break;
            case 'contact':
                display_contact($translations);
                break;
            default:
                display_home($translations);
                break;
        }
        ?>
    </main>

    <?php display_footer($currentLanguage, $translations); ?>
</body>
</html>