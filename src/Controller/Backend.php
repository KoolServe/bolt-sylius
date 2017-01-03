<?php
namespace Bolt\Extension\Koolserve\Sylius\Controller;

use Bolt\Controller\Zone;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bolt\Extension\Koolserve\Sylius\Sylius;

class Backend implements ControllerProviderInterface
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param Application $app
     */
    public function connect(Application $app)
    {
        /** @var $ctr ControllerCollection */
        $ctr = $app['controllers_factory'];
        $ctr->value(Zone::KEY, Zone::BACKEND);

        $baseUrl = '/extend/sylius';
        $ctr->match($baseUrl, [$this, 'dashboard'])
            ->bind('sylius_dashboard')
            ->method(Request::METHOD_GET);

        $ctr->match($baseUrl . '/customers', [$this, 'customers'])
            ->bind('sylius_customers')
            ->method(Request::METHOD_GET);

        $ctr->match($baseUrl . '/orders', [$this, 'orders'])
            ->bind('sylius_orders')
            ->method(Request::METHOD_GET);

        $ctr->match($baseUrl . '/products', [$this, 'products'])
            ->bind('sylius_products')
            ->method(Request::METHOD_GET);

        return $ctr;
    }

    /**
     * @param Application $app
     */
    public function dashboard(Application $app)
    {
        $sylius = new Sylius($this->config);
        $data = [
            'sylius' => $sylius->getDashboardData()
        ];
        $html = $app['twig']->render('@SyliusBackend/dashboard.twig', (array) $data);

        return new Response(new \Twig_Markup($html, 'UTF-8'));
    }

    /**
     * @param Application $app
     */
    public function customers(Application $app)
    {
        $sylius = new Sylius($this->config);
        $data = [];
        $html = $app['twig']->render('@SyliusBackend/customers.twig', (array) $data);

        return new Response(new \Twig_Markup($html, 'UTF-8'));
    }

    /**
     * @param Application $app
     */
    public function orders(Application $app)
    {
        $sylius = new Sylius($this->config);
        $data = [];
        $html = $app['twig']->render('@SyliusBackend/orders.twig', (array) $data);

        return new Response(new \Twig_Markup($html, 'UTF-8'));
    }

    /**
     * @param Application $app
     */
    public function products(Application $app)
    {
        $sylius = new Sylius($this->config);
        $data = [];
        $html = $app['twig']->render('@SyliusBackend/products.twig', (array) $data);

        return new Response(new \Twig_Markup($html, 'UTF-8'));
    }
}