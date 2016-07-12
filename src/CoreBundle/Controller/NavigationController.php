<?php
namespace CoreBundle\Controller;

use CoreBundle\Service\RenderModuleService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NavigationController extends Controller
{
    /**
     * @Route("/{module}", defaults={"module" = "app"}, name="app_pages")
     * @param $module
     * @return mixed
     */
    public function indexAction($module)
    {
        $render = new RenderModuleService($this->container);
        return $render->render(ucfirst($module).'Bundle:Default:', array());
    }
}