<?php
echo ('Bienvenue<br/>');

class BookingManager
{
    private $_db;
    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function setDb(PDO $dbh)
    {
        $this->_db = $dbh;
    }
    // -------------CREATION-----------------------
    public function addBooking(Booking $booking)
    {
       
        $id = $booking->getBooking_id();
        echo $id.'<br>';
        $client_name = htmlspecialchars($booking->getClientName());
        echo $client_name.'<br>';
        $hotel_name = htmlspecialchars($booking->getHotelName());
        $rooms_number = htmlspecialchars($booking->getRoomsNumber());
        $client_mail = htmlspecialchars($booking->getClientMail());
        $checkin = $booking->getCheckin();
        $checkout = $booking->getCheckin();
        $sql = 'INSERT INTO booking (booking_id, hotel_name, client_name, rooms_number, client_mail,checkin,checkout)VALUES(:booking_id,:hotel_name, :client_name,:rooms_number, :client_mail,:checkin,:checkout) ';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue('booking_id', $id,PDO::PARAM_INT);
        $stmt->bindValue('hotel_name', $hotel_name,PDO::PARAM_STR);
        $stmt->bindValue('client_name', $client_name,PDO::PARAM_STR);
        $stmt->bindValue('rooms_number', $rooms_number,PDO::PARAM_STR);
        $stmt->bindValue('client_mail', $client_mail,PDO::PARAM_STR);
        $stmt->bindValue('checkin', $checkin,PDO::PARAM_STR);
        $stmt->bindValue('checkout', $checkout,PDO::PARAM_STR);
        $stmt->execute();
    }
    //--------------------RECUPERER------------------------
    public function getBooking($booking_id)
    {
        if (empty($booking_id)) {
            $sql = 'SELECT * FROM booking';
            $stmt = $this->_db->prepare($sql);
        } elseif (is_numeric($booking_id)) {
            $sql = 'SELECT * FROM booking WHERE booking_id=>:booking_id';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindValue(':booking_id', $booking_id);
        }
        $stmt->execute();
        $res[] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $res[] = $row;
        }
        return $res;
    }
    //--------------------MODIFIER-------------------------
    public function updateBooking(Booking $booking)
    {
        if (!empty($booking)) {
            $sql = 'UPDATE booking SET hotel_name=:hotel_name, client_email=:client_email, checkin=:checkin, checkout=:checkout';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':hotel_name', $booking->getHotelName());
            $stmt->bindParam(':client_email', $booking->getClientMail());
            $stmt->bindParam(':checkin', $booking->getCheckin());
            $stmt->bindParam(':checkout', $booking->getCheckout());
            $stmt->execute();
        }
    }
    //----------------------SUPPRIMER-------------------------
    public function deleteBooking(Booking $booking)
    {
        if (!empty($booking)) {
            $sql = 'DELETE FROM booking WHERE booking_id=:booking_id';
            $stmt = $this->_db->prapare($sql);
            $stmt->bindParam(':booking_id', $booking->getBooking_id());
            $stmt->execute();
            $count = $stmt->rowCount();
            return $count;
        }
    }
}
