<?php


namespace App\Controller;


use http\Env\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {

        $this->twig = $twig;
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/giris", name="security_login")
     */
    public function giris(AuthenticationUtils $authenticationUtils)
    {
        return new \Symfony\Component\HttpFoundation\Response($this->twig->render(
            'login.html.twig',[
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' =>$authenticationUtils->getLastAuthenticationError()
            ]
        ));
    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/cikis", name="security_logout")
     */
    public function cikis(){

    }

}