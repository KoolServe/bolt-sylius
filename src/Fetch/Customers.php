<?php

namespace Bolt\Extension\Koolserve\Sylius\Fetch;

class Customers extends Base implements Fetch
{
    protected $name = 'customers';

    public function fetchNewCustomers()
    {
        $client = $this->getClient();
        return $client->get($this->getName() . '/?limit=5');
    }

    public function fetchCustomers()
    {
        $client = $this->getClient();
        return $client->get($this->getName() . '/?limit=100');
    }
}