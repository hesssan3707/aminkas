<?php
// db.php
$servername = "127.0.0.1";
$username = "root"; // Default username for XAMPP/WAMP
$password = ""; // Default password for XAMPP/WAMP is empty
$dbname = "solarenergy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8mb4 for full Unicode support
$conn->set_charset("utf8mb4");

// Function to fetch all options from the database
function get_options($conn) {
    $options = [];
    $sql = "SELECT option_name, option_value FROM options";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[$row['option_name']] = $row['option_value'];
        }
    }
    return $options;
}

function get_all_posts($conn, $lang = 'fa') {
    $posts = [];
    $sql = "SELECT id, title_$lang as title, content_$lang as content, image_url FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    return $posts;
}

function get_post_by_id($conn, $id, $lang = 'fa') {
    $sql = "SELECT id, title_$lang as title, content_$lang as content, image_url, created_at FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

function save_message($conn, $name, $email, $subject, $message) {
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    return $stmt->execute();
}
?>