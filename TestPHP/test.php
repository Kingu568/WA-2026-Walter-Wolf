<?php
$name = "";
$message = "";
$age = 0;

if($_SERVER['REQUEST_METHOD'] == "POST") {
 $name = $_POST["user_name"];
 $age = $_POST["age"];
 if($age == 4) {
    $message = $message = "hiiiiiiii " . $name . " you are the youngest person EVER";
 }
 else if ($name == "Waltuh") {
    $message = "We need to cook waltuh";
 }
 else {
    $message = "hiiiiiiii " . $name . " youre " .  $age . " years old";
 }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>omg hiii</title>
</head>
<body>
    <img src="https://media1.tenor.com/m/XtFU2XB5-kIAAAAC/but-the-lord-laughs-at-the-wicked.gif" alt="ihateyou">

    <form method="post">
        <input type="text" name="user_name" placeholder="zadej jmeno">
        <input type="number" name="age" placeholder="věk">
        <button type="submit" >send</button>
        >
    </form>
    <p><?php echo $message; ?>
</p>
</body>
</html>