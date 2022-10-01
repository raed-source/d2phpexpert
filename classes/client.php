<?php

 class Client{
    private $_client_id;
    private $_client_name;
    private $_client_mail;
    public function __construct(array $data)
    {
        $this->setClientName($data['client_name']);
        $this->setClientMail($data['client_mail']);
    }

    public function setClientName($client_name)
    {
        $this->_client_name = $client_name;
    }
    public function setClientMail($client_mail)
    {
        $this->_client_mail = $client_mail;
    }
    public function getClientName()
    {
        return $this->_client_name;
    }
    public function getClientMail()
    {
        return $this->_client_mail;
    }

}
