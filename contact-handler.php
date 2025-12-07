<?php
// db.php
require_once 'db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email address
        // For simplicity, we'll just redirect back to the contact page with an error
        header("Location: index.php?view=contact&status=error");
        exit;
    }

    // Save the message to the database
    if (save_message($conn, $name, $email, $subject, $message)) {
        // Get language from form
        $lang = isset($_POST['lang']) && $_POST['lang'] === 'en' ? 'en' : 'fa';
        // Redirect to a thank you page
        header("Location: thank-you.php?lang=" . $lang);
        exit;
    } else {
        // Handle database error
        header("Location: index.php?view=contact&status=dberror");
        exit;
    }
} else {
    // If the form was not submitted, redirect to the contact page
    header("Location: index.php?view=contact");
    exit;
}
?>
