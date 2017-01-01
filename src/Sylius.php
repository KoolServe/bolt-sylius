<?php

namespace Bolt\Extension\Koolserve\Sylius;

class Sylius
{
    protected $client;

    public function getClient()
    {
        return $this->client;
    }

    public function __construct($config)
    {
        $client = new Client($config);
        $this->client = $client;
    }

    public function getData(){
        $client = $this->getClient();

        return [
            'orders' => $client->get('orders/'),
            'customers' => $client->get('customers/')
        ];
    }
}