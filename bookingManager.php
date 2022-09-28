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
        $room_number = htmlspecialchars($booking->getRoomNumber());
        $client_mail = htmlspecialchars($booking->getClientMail());
        $checkin = $booking->getCheckin();
        $checkout = $booking->getCheckin();

        $sql = 'INSERT INTO booking_manager (client_name, client_mail, hotel_name, room_number, checkin, checkout)
                             VALUES (:client_name, :client_mail, :hotel_name, :room_number, :checkin, :checkout) ';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam('client_name', $client_name);
        $stmt->bindParam('client_mail', $client_mail);
        $stmt->bindParam('hotel_name', $hotel_name);
        $stmt->bindParam('room_number', $room_number);
        $stmt->bindParam('checkin', $checkin);
        $stmt->bindParam('checkout', $checkout);
        $stmt->execute();
        // var_dump($stmt->debugDumpParams());
        $stmt = null;
    }
    //--------------------RECUPERER------------------------
    public function getBooking($id = '')
    {
        if (empty($id)) {
            $sql = 'SELECT * FROM booking_manager';
            $stmt = $this->_db->prepare($sql);
        } elseif (is_numeric($id)) {
            $sql = 'SELECT * FROM booking_manager WHERE booking_id=:id';
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':id', $id);
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
            $sql = 'UPDATE booking_manager SET hotel_name=:hotel_name, client_email=:client_email, checkin=:checkin, checkout=:checkout where booking_id=:booking_id';
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
    public function deleteBooking($id)
    {
        // if (!empty($booking_id)) {
        $sql = 'DELETE FROM booking_manager WHERE booking_id=:id';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
        // }
    }
    public function addClient(Booking $booking)
    {
        $id = $booking->getBooking_id();
        $client_name = htmlspecialchars($booking->getClientName());
        // $hotel_name = htmlspecialchars($booking->getHotelName());
        // $room_number = htmlspecialchars($booking->getRoomNumber());
        $client_mail = htmlspecialchars($booking->getClientMail());
        // $checkin = $booking->getCheckin();
        // $checkout = $booking->getCheckin();
        $sql = 'INSERT INTO client (client_name, client_mail)
                             VALUES (:client_name, :client_mail) ';
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam('client_name', $client_name);
        $stmt->bindParam('client_mail', $client_mail);
        $stmt->execute();
        // var_dump($stmt->debugDumpParams());
        $stmt = null;
    }
}
