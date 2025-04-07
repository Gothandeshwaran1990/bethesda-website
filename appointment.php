
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bethesdaclinic777@gmail.com'; // Your Gmail
        $mail->Password   = 'veei nljm pqeq utdl';   // Use App Password for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Email Settings
        $mail->setFrom('bethesdaclinic777@gmail.com', 'Name');
        $mail->addAddress('bethesdaclinic777@gmail.com'); // Receiver Email
        $mail->isHTML(true);
        $mail->Subject = "New Appointment Request";
         $mail->Body = "<p><strong>Name:</strong> $name</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Phone:</strong> $phone</p>
                       <p><strong>Address:</strong> $address</p>";

        if ($mail->send()) {
            echo json_encode(["status" => "success", "message" => "✅ Appointment request sent successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Failed to send appointment request."]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "❌ Error: {$mail->ErrorInfo}"]);
    }
}
?>


