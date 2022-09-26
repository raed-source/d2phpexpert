<?php
class Booking
{
    private $_hotel_id;
    private $_hotel_name;
    private $_rooms_number;
    private $_rooms_disponibles;

    
    public function __construct(array $data)
    {
        // $this->setHotel_id($data['hotel_id']);
        $this->setHotelName($data['hotel_name']);
        $this->setRoomsNumber($data['rooms_number']);
        $this->setRoomsDisponibles($data['rooms_disponibles']);
   
    }
    public function setHotelName($hotel_name)
    {
        if (is_string($hotel_name))
            $this->_hotel_name = $hotel_name;
    }
    
}
?>