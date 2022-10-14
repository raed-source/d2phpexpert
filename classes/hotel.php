<?php

class Hotel
{
    private $_hotel_id;
    private $_hotel_name;
    private $_hotel_address;
    public function __construct(array $data)
    {
        $this->setHotelId($data['hotel_id']);
        $this->setHotelName($data['hotel_name']);
        $this->setHotelAddress($data['hotel_address']);
    }

    // ----------SETTERS-------------------
    public function setHotelId($hotel_id)
    {
        if (is_int($hotel_id))
            $this->_booking_id = $hotel_id;
    }
    public function setHotelName($hotel_name)
    {
        if (is_string($hotel_name))
            $this->_hotel_name = $hotel_name;
    }
    public function setHotelAddress($hotel_address)
    {
        if (is_string($hotel_address))
            $this->_hotel_address = $hotel_address;
    }
    public function getHotelId()
    {
        return $this->_hotel_id;
    }
    public function getHotelName()
    {
        return $this->_hotel_name;
    }
    public function getHotelAddress()
    {
        return $this->_hotel_address;
    }
    public function display_hotel()
    {
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <?php
    echo 'Page de liste des hotels disponibles sur notre site ';
    $dbh = new PDO('mysql:host=localhost;dbname=booking_db', 'root', '');
    $sql = 'SELECT * FROM hotel';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    // var_dump($stmt->debugDumpParams());
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $row;
    }
    ?>
    <?php foreach ($res as $obj) : ?>
        <?php $hotel = new Hotel($obj); ?>
        <ul>
            <li><a href="../pages/reservation.php?id=<?php echo $hotel->getHotelName() ?>"><?php echo $hotel->getHotelName() ?> </a> - <?php echo $hotel->getHotelAddress() ?></li>
        <?php endforeach; ?>
        </ul>
</body>

</html>