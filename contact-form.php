<?php
if (isset($_POST['send'])) {

    // EDIT THE FOLLOWING TWO LINES:
    $email_to = "alle.abraham2@gmail.com";
    $email_subject = "Kontaktformulär";

    function problem($error)
    {
        echo "Hoppsan där gick något fel! ";
        echo "Se felen nedan.<br><br>";
        echo $error . "<br><br>";
        echo "Korrigera felen och prova igen.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['contact_name']) ||
        !isset($_POST['contact_emali']) ||
        !isset($_POST['contact_adress']) ||
        !isset($_POST['contact_nbr']) ||
        !isset($_POST['message']) 
    ) {
        problem("Fyll i alla rutor!");
    }

    $name = $_POST['contact_name']; // required
    $email = $_POST['contact_emali']; // required
    $addres = $_POST['contact_adress']; // required
    $nbr = $_POST['contact_nbr']; // required
    $message = $_POST['message']; // required
    

    $error_message = "";
    $email_exp = "/^[A-öa-ö0-9._%-]+@[A-Öa-ö0-9.-]+\.[A-Öa-ö]{2,4}/";

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Ange en giltig E-post<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Ange ett giltigt namn<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Använd endast giltiga tecken.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Formulärdetaljer nedan.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Namn: " . clean_string($name) . "\n";
    $email_message .= "E-post: " . clean_string($email) . "\n";
    $email_message .= "Address: " . clean_string($addres) . "\n";
    $email_message .= "Nummer: " . clean_string($nbr) . "\n";
    $email_message .= "Meddelande: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Från: ' . $email . "\r\n" .
        'PHP version: ' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
}
?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW 

    Tack för ditt meddelande. Vi hör av oss så snabbt som möjligt.
-->
