<?php
class Booking
{
    private $_booking_id;
    private $_hotel_name;
    private $_client_email;
    private $_checkin;
    private $_checkout;

    public function __construct(array $data)
    {
        $this->setBooking_id($data['booking_id']);
        $this->setBooking_id($data['hotel_name']);
        $this->setBooking_id($data['client_email']);
        $this->setBooking_id($data['checkin']);
        $this->setBooking_id($data['checkout']);
    }
    public function setBooking_id($booking_id)
    {
        $this->_booking_id = $booking_id;
    }
    public function getCheckin()
    {
        return $this->_checkin;
    }
    public function getCheckout()
    {
        return $this->_checkout;
    }
    public function getBooking_id()
    {
        return $this->_booking_id;
    }
    public function getHotelName()
    {
        return $this->_hotel_name;
    }
    public function getClientEmail()
    {
        return $this->_client_email;
    }
}
