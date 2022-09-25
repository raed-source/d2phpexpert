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
        $client_name = htmlspecialchars($booking->getClientName());
        $hotel_name = htmlspecialchars($booking->getHotelName());
        $rooms_number = htmlspecialchars($booking->getRoomsNumber());
        $client_mail = htmlspecialchars($booking->getClientMail());
        $checkin = $booking->getCheckin();
        $checkout = $booking->getCheckin();

        $sql = 'INSERT INTO booking ( client_name, client_mail,hotel_name ,rooms_number,checkin,checkout)VALUES(:client_name,:client_mail,:hotel_name,:rooms_number,:checkin,:checkout) ';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam('client_name', $client_name);
        $stmt->bindParam('client_mail', $client_mail);
        $stmt->bindParam('hotel_name', $hotel_name);
        $stmt->bindParam('rooms_number', $rooms_number);
        $stmt->bindParam('checkin', $checkin);
        $stmt->bindParam('checkout', $checkout);
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
            $stmt->bindParam(':booking_id', $booking_id);
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
            $sql = 'UPDATE booking SET hotel_name=:hotel_name, client_email=:client_email, checkin=:checkin, checkout=:checkout where booking_id=:booking_id';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':booking_id', $booking->getBooking_id());
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
