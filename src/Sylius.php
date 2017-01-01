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

    protected function getLatestCustomers()
    {
        $client = $this->getClient();
        $customers = $client->get('customers/?limit=5');

        return $customers;
    }

    protected function getLatestOrders()
    {
        $client = $this->getClient();
        $orders = $client->get('orders/?limit=5');

        return $orders;
    }

    public function getData(){
        return [
            'orders' => $this->getLatestOrders(),
            'customers' => $this->getLatestCustomers()
        ];
    }
}