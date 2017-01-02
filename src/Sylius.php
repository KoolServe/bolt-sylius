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
        $customers = new Fetch\Customers($this->getClient());
        return $customers->fetchNewCustomers();
    }

    protected function getLatestOrders()
    {
        $orders = new Fetch\Orders($this->getClient());
        return $orders->fetchLast5Orders();
    }

    public function getDashboardData()
    {
        return [
            'orders' => $this->getLatestOrders(),
            'customers' => $this->getLatestCustomers()
        ];
    }
}