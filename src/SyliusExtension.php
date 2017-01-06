<?php

namespace Bolt\Extension\Koolserve\Sylius;

use Bolt\Extension\SimpleExtension;
use Bolt\Menu\MenuEntry;
use Silex\Application;
use Symfony\Component\HttpFoundation\ParameterBag;

class SyliusExtension extends SimpleExtension
{
    protected function registerServices(Application $app)
    {
        $app['sylius.config'] = $app->share(
            function () {
                return new ParameterBag($this->getConfig());
            }
        );
    }
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