<?php
class Booking
{
    private $_booking_id;
    private $_hotel_name;
    private $_rooms_number;
    private $_client_name;
    private $_client_mail;
    private $_checkin;
    private $_checkout;

    public function __construct(array $data)
    {
        $this->setBooking_id($data['booking_id']);
        $this->setHotelName($data['hotel_name']);
        $this->setRoomsNumber($data['rooms_number']);
        $this->setClientName($data['client_name']);
        $this->setClientMail($data['client_mail']);
        $this->setCheckin($data['checkin']);
        $this->setCheckout($data['checkout']);
    }
    public function setBooking_id($booking_id)
    {
        if (is_int($booking_id))
            $this->_booking_id = $booking_id;
    }
    public function setHotelName($hotel_name)
    {
        if (is_string($hotel_name))
            $this->_hotel_name = $hotel_name;
    }
    public function setRoomsNumber($rooms_number)
    {
        $this->_rooms_number = $rooms_number;
    }
    public function setClientName($client_name)
    {
        $this->_client_name = $client_name;
    }
    public function setClientMail($client_mail)
    {
        $this->_client_mail = $client_mail;
    }
    public function setCheckin($checkin)
    {
        $this->_checkin = $checkin;
    }
    public function setCheckout($checkout)
    {
        $this->_checkout = $checkout;
    }
    public function getCheckin()
    {
        $date = str_replace('/', '-',  $this->_checkin);
        return date('Y-m-d', strtotime($date));
    }
    public function getCheckout()
    {
        $date = str_replace('/', '-',  $this->_checkout);
        return date('Y-m-d', strtotime($date));
    }
    public function getBooking_id()
    {
        return $this->_booking_id;
    }
    public function getClientName()
    {
        return $this->_client_name;
    }
    public function getHotelName()
    {
        return $this->_hotel_name;
    }
    public function getRoomsNumber()
    {
        return $this->_rooms_number;
    }
    public function getClientMail()
    {
        return $this->_client_mail;
    }
}
