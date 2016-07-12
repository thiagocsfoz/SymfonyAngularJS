<?php

namespace CoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;


class LoginHandler implements AuthenticationSuccessHandlerInterface {

    private $router;
    private $container;
    private static $key;

    public function __construct(RouterInterface $router, EntityManager $em, $container) {

        self::$key = '_security.secured_area.target_path';

        $this->router = $router;
        $this->em = $em;
        $this->session = $container->get('session');

    }

    public function onAuthenticationSuccess( Request $request, TokenInterface $token )
    {
        $redirectUrl = $request->getSession()->get('_security.restricted_area_app.target_path');
        return new RedirectResponse($redirectUrl);

    }
}