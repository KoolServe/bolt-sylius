<?php

namespace Bolt\Extension\Koolserve\Sylius;

use Bolt\Application;
use Bolt\Extension\SimpleExtension;
use Bolt\Menu\MenuEntry;

class SyliusExtension extends SimpleExtension
{
    protected function registerBackendControllers()
    {
        $config = $this->getConfig();
        return [
            '/' => new Controller\Backend($config)
        ];
    }

    protected function registerTwigPaths()
    {
        return [
            'templates/backend' => [
                'position' => 'append',
                'namespace' => 'SyliusBackend'
            ],
        ];
    }

    protected function registerMenuEntries()
    {
        $menu = new MenuEntry('sylius-menu', 'sylius');
        $menu->setLabel('Sylius');
        $menu->setIcon('fa:shopping-basket');

        return [
            $menu,
        ];
    }
}