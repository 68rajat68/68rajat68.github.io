<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check if data is valid
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid form data. Please fill all fields correctly.";
        exit;
    }

    // Set email parameters
    $to = "68rajat68@gmail.com";
    $email_subject = "New message from $name: $subject";
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";
    
    $headers = "From: $email";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        echo "Failed to send your message.";
    }
}
?>
