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
        $ctr->match($baseUrl, [$this, 'index'])
            ->bind('sylius')
            ->method(Request::METHOD_GET)
        ;
       return $ctr;
    }

    /**
     * @param Application $app
     */
    public function index(Application $app)
    {
        $sylius = new Sylius($this->config);
        $data = [
            'sylius' => $sylius->getData()
        ];
        $html = $app['twig']->render('@SyliusBackend/index.twig', (array) $data);

        return new Response(new \Twig_Markup($html, 'UTF-8'));
    }
}