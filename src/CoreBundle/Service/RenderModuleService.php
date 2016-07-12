<?php
namespace CoreBundle\Service;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Response;

class RenderModuleService
{
    public $container;
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function render( $content, $parameters = array(), $user = null, Response $response = null ) {
        return $this->container->get('templating')->renderResponse('CoreBundle:Default:index.html.twig', array('content'=> $content, 'parameters'=> $parameters), $response);
    }
}