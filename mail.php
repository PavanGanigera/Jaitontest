<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// ================= REDIRECT VARIABLES (HERE) =================
$redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/JaitonLive/';
$separator   = (parse_url($redirectUrl, PHP_URL_QUERY)) ? '&' : '?';

/* ================= REQUEST CHECK ================= */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

/* ================= AJAX CHECK ================= */
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

/* ================= SMTP CONFIG ================= */
function smtpConfig(PHPMailer $mail)
{
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
}

/* ================= FORM TYPE ================= */
$form_type = $_POST['form_type'] ?? 'contact';

/* ================= COMMON INPUTS ================= */
$full_name  = trim($_POST['full_name'] ?? 'Subscriber');
$email      = trim($_POST['email'] ?? '');
$full_phone = trim($_POST['full_phone'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = ['status' => 'error', 'message' => 'Invalid email'];
    echo $isAjax ? json_encode($response) : 'Invalid email';
    exit;
}

/* ================= SUBSCRIBE FORM ================= */
if ($form_type === 'subscribe') {

    try {
        /* -------- ADMIN MAIL -------- */
        $adminMail = new PHPMailer(true);
        smtpConfig($adminMail);

        $adminMail->setFrom($_ENV['MAIL_USERNAME'], 'Jaiton Website');
        $adminMail->addAddress('swd.jaiton@gmail.com');
        $adminMail->isHTML(true);
        $adminMail->Subject = 'New Newsletter Subscription';
        $adminMail->Body    = "<p><b>Email:</b> {$email}</p>";
        $adminMail->send();

        /* -------- AUTO REPLY -------- */
        $userMail = new PHPMailer(true);
        smtpConfig($userMail);

        $userMail->setFrom($_ENV['MAIL_USERNAME'], 'Jaiton Technologies');
        $userMail->addAddress($email);
        $userMail->isHTML(true);
        $userMail->Subject = 'Thanks for Subscribing – Jaiton Technologies';
        $userMail->Body = "
            <p>Hi,</p>
            <p>Thank you for subscribing to <b>Jaiton Technologies</b>.</p>
            <p>You’ll now receive updates, insights, and offers from us.</p>
            <br>
            <p>Best Regards,<br>
            <b>Jaiton Technologies Team</b></p>
        ";
        $userMail->send();

        echo json_encode(['status' => 'success']);
        exit;
    } catch (Exception $e) {
        echo json_encode(['status' => 'error']);
        exit;
    }
}

/* ================= CONTACT / CTA FORMS ================= */
if ($full_name === '' || $full_phone === '') {
    exit('Required fields missing');
}

$full_phone = preg_replace('/[\s\-()]/', '', $full_phone);
if ($full_phone[0] !== '+') {
    $full_phone = '+' . $full_phone;
}

$location    = trim($_POST['location'] ?? '');
$requirement = trim($_POST['requirement'] ?? '');
$message     = nl2br(htmlspecialchars(trim($_POST['message'] ?? '')));

/* ================= ADMIN MAIL CONTENT ================= */
if ($form_type === 'footer') {
    $adminSubject = 'Footer CTA Enquiry';
    $adminBody = "
        <p><b>Name:</b> {$full_name}</p>
        <p><b>Email:</b> {$email}</p>
        <p><b>Phone:</b> {$full_phone}</p>
    ";
} else {
    $adminSubject = 'New Contact Form Enquiry';
    $adminBody = "
        <h3>{$adminSubject}</h3>
        <table border='1' cellpadding='8' cellspacing='0' width='100%'>
            <tr><td><b>Name</b></td><td>{$full_name}</td></tr>
            <tr><td><b>Email</b></td><td>{$email}</td></tr>
            <tr><td><b>Phone</b></td><td>{$full_phone}</td></tr>
            <tr><td><b>Location</b></td><td>{$location}</td></tr>
            <tr><td><b>Requirement</b></td><td>{$requirement}</td></tr>
            <tr><td><b>Message</b></td><td>{$message}</td></tr>
        </table>
    ";
}

try {
    /* -------- ADMIN MAIL -------- */
    $adminMail = new PHPMailer(true);
    smtpConfig($adminMail);

    $adminMail->setFrom('pavanganigera27753@gmail.com', 'Jaiton Website');
    $adminMail->addAddress('swd.jaiton@gmail.com');
    $adminMail->addReplyTo($email, $full_name);
    $adminMail->isHTML(true);
    $adminMail->Subject = $adminSubject;
    $adminMail->Body    = $adminBody;
    $adminMail->send();

    /* -------- AUTO REPLY -------- */
    $userMail = new PHPMailer(true);
    smtpConfig($userMail);

    $userMail->setFrom($_ENV['MAIL_USERNAME'], 'Jaiton Technologies');
    $userMail->addAddress($email, $full_name);
    $userMail->isHTML(true);
    $userMail->Subject = 'We Received Your Enquiry – Jaiton Technologies';
    $userMail->Body = "
        <p>Hi <b>{$full_name}</b>,</p>
        <p>Thank you for contacting <b>Jaiton Technologies</b>.</p>
        <p>Our team will get back to you within <b>24 hours</b>.</p>
        <br>
        <p>Best Regards,<br>
        <b>Jaiton Technologies Team</b></p>
    ";
    $userMail->send();

    // ✅ SUCCESS REDIRECT
    header("Location: {$redirectUrl}{$separator}status=success");
    exit;
} catch (Exception $e) {
    // ❌ ERROR REDIRECT
    header("Location: {$redirectUrl}{$separator}status=error");
    exit;
}
