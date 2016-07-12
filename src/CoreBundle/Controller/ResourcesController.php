<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 08/07/2016
 * Time: 13:07
 */

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ResourcesController
 * @package Controller
 */
class ResourcesController extends Controller
{
    /**
     * @Route("/resource/{module}", name="project_app_render")
     * @param $module
     * @return Response
     */
    public function getResourceAction(Request $request, $module)
    {
        if( !$request->get("file") )
            return new Response('File not Found!' , 400 );

        $langs = $request->getLanguages();

        if($langs[0] == "es" || $langs[0] == "es_419" || $langs[0] == "es_PY")
            $request->setLocale("es_ES");
        else
            $request->setLocale("pt_BR");

        $module = ucfirst($module);

        $rFile = str_replace('../' , '', $request->get("file"));
        $file = __DIR__ . "/../../{$module}Bundle/Resources/public/".$rFile;

        if( file_exists( $file ) ){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $minetype = finfo_file($finfo, $file);
            finfo_close($finfo);

            $fileDuck =  $this->get( 'FileDuck' );

            $config = $fileDuck->getConfig();

            $config['lang'] = $request->getLocale();

            $fileDuck->setConfig($config);
            $fileDuck->add( $file );
            $response = $fileDuck->renderFile($minetype);
        }
        else
            $response = new Response('File not Found!' , 404 );

        return $response;
    }

    /**
     * @Route("/resource/user/me", name="project_app_user_me")
     * @return Response
     */
    public function getUserMeAction()
    {
        $oUser = $this->getUser();

        $user = array();
        $user['me']['data']['username'] = $oUser->getUsername();
        $user['me']['data']['displayName'] = $oUser->getDisplayname();
        $user['me']['data']['givenname'] = $oUser->getGivenname();
        $user['me']['data']['surname'] = $oUser->getSurname();
        $user['me']['data']['roles'] = $oUser->getRoles();
        $user['me']['data']['email'] = $oUser->getEmail();
        $user['me']['data']['salt'] = $oUser->getSalt();
        $user['me']['data']['dn'] = $oUser->getDn();
        $user['me']['data']['cn'] = $oUser->getCn();

        $user['me']['browser'] = $this->getBrowser();

        return new Response(json_encode($user));
    }

    /**
     * @Route("/download/{file}", name="project_app_download")
     * @param $file
     * @return Response
     */
    public function downloadFileAction($file)
    {
        $path = '/tmp/'.$file;
        $handle = fopen($path, 'r');
        header('Content-Type: application/csv');
        header('Content-Disposition:attachment;filename='.$file.'');
        readfile($path);
        fclose($handle);
        unlink($path);
        //exit();
        return new Response();
    }
}