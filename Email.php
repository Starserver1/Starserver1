$email = $_GET["email"];
$txt = $_GET["txt"];

$headers = "From:"."info";
$subject = "info";

mail($email, $subject, $txt, $headers);
