<?php
if (isset($_POST['modify']));
echo 'ok';
if (
    !empty($_POST['client_name'])
    and !empty($_POST['client_mail'])
    and !empty($_POST['checkin'])
    and !empty($_POST['checkout'])
) {
    $client_name = $_POST['client_name'];
    $client_mail = $_POST['client_mail'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    modif
</body>

</html>