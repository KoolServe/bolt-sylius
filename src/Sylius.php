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

    protected function getProducts()
    {
        $orders = new Fetch\Products($this->getClient());
        return $orders->fetchProducts();
    }

    protected function getOrders()
    {
        $orders = new Fetch\Orders($this->getClient());
        return $orders->fetchOrders();
    }

    public function getDashboardData()
    {
        return [
            'orders' => $this->getLatestOrders(),
            'customers' => $this->getLatestCustomers()
        ];
    }

    public function getProductsData()
    {
        return [
            'products' => $this->getProducts()
        ];
    }

    public function getOrdersData()
    {
        return [
            'orders' => $this->getOrders()
        ];
    }
}