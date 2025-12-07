<?php
// db.php
require_once 'db.php';

// Fetch all options from the database
$options = get_options($conn);

// Include translations
require_once 'localization.php';

// I'm hardcoding the language to 'fa' for the thank you page for simplicity
// A more robust solution would detect the language from the session or a cookie
$currentLanguage = 'fa';
$translations = $fa_translations;


// Include components
require_once 'components/Header.php';
require_once 'components/Footer.php';
require_once 'components/IconComponents.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLanguage; ?>" dir="<?php echo $currentLanguage === 'fa' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['thank_you']['title']; ?> - <?php echo $translations['header']['companyName']; ?></title>
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
    </style>
</head>
<body class="<?php echo $currentLanguage === 'fa' ? 'font-fa' : 'font-en'; ?> bg-gray-50 text-gray-800">
    <?php display_header('contact', $currentLanguage, $translations); ?>

    <main class="min-h-screen flex items-center justify-center">
        <div class="text-center p-12 bg-white rounded-lg shadow-xl">
            <h1 class="text-4xl font-extrabold text-green-500 mb-4"><?php echo $translations['thank_you']['title']; ?></h1>
            <p class="text-lg text-gray-600 mb-8"><?php echo $translations['thank_you']['message']; ?></p>
            <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-md transition-colors">
                <?php echo $translations['thank_you']['back_home']; ?>
            </a>
        </div>
    </main>

    <?php display_footer($currentLanguage, $translations); ?>
</body>
</html>
