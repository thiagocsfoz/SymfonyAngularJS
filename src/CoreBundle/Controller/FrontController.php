<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    /**
     * @Route("/broker", name="app_core_broker")
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $config = new \Amfphp_Core_Config();
        //--Search Path das Entidades
        $voFolders = array();
        $dir = dirname(__FILE__) . '/../../';
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(strpos($file, ".") === false)
                    $voFolders[] = array(dirname(__FILE__) . '\\..\\..\\'.$file.'\\Entity\\', $file.'\\Entity');
            }
            closedir($dh);
        }
        $config->pluginsConfig["AmfphpVoConverter"] = array('voFolders' => $voFolders, 'enforceConversion' => true);
        //--Error
        $voFolders[] = array(dirname(__FILE__) . '/../Entity/Error/', 'CoreBundle/Entity/Error');
        //--Paging
        $voFolders[] = array(dirname(__FILE__) . '/../Entity/Paging/', 'CoreBundle/Entity/Paging');
        $config->pluginsConfig["AmfphpVoConverter"] = array('voFolders' => $voFolders);

        //--Search Path dos Serviços
        foreach(glob(dirname(__FILE__) . '/../../*', GLOB_ONLYDIR) as $dir) {
            $bundle = explode("/", $dir);
            $bundle = $bundle[count($bundle)-1];
            $config->serviceFolders[] = array($dir.'\\Service\\', $bundle.'\\Service');
        }

        //var_dump($config); exit;
        $gateway = \Amfphp_Core_HttpRequestGatewayFactory::createGateway($config);
        $gateway->service();

        return new JsonResponse( $gateway->output() );
    }
}
