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

// Get post ID from URL
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$post_id) {
    // Redirect to news page or show a 404
    header('Location: index.php?view=news');
    exit;
}

// Fetch the single post
$post = get_post_by_id($conn, $post_id, $currentLanguage);

if (!$post) {
    // Redirect to news page or show a 404
    header('Location: index.php?view=news');
    exit;
}

// Include components
require_once 'components/Header.php';
require_once 'components/Footer.php';
require_once 'components/IconComponents.php';

// Include the single post view
require_once 'views/Single.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $currentLanguage; ?>" dir="<?php echo $currentLanguage === 'fa' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> - <?php echo $translations['header']['companyName']; ?></title>
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
        .prose {
            /* Add styles for prose content if needed */
        }
    </style>
</head>
<body class="<?php echo $currentLanguage === 'fa' ? 'font-fa' : 'font-en'; ?> bg-gray-50 text-gray-800">
    <?php display_header('news', $currentLanguage, $translations); ?>

    <main class="min-h-screen">
        <?php display_single_post($post); ?>
    </main>

    <?php display_footer($currentLanguage, $translations); ?>
</body>
</html>
