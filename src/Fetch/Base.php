<?php

namespace Bolt\Extension\Koolserve\Sylius\Fetch;

class Base
{
    protected $client;

    protected $name;

    public function getClient()
    {
        return $this->client;
    }

    protected function setClient($client)
    {
        $this->client = $client;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __construct($client)
    {
        $this->client = $client;
    }
}