<?php

namespace Bolt\Extension\Koolserve\Sylius\Fetch;

class Products extends Base implements Fetch
{
    protected $name = 'products';

    public function fetchProducts()
    {
        $client = $this->getClient();
        return $client->get($this->getName() . '/?limit=100');
    }
}