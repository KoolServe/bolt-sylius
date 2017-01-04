<?php

namespace Bolt\Extension\Koolserve\Sylius\Fetch;

class Orders extends Base implements Fetch
{
    protected $name = 'orders';

    public function fetchLast5Orders()
    {
        $client = $this->getClient();
        return $client->get($this->getName() . '/?limit=5');
    }

    public function fetchOrders()
    {
        $client = $this->getClient();
        return $client->get($this->getName() . '/?limit=100');
    }
}