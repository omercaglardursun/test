<?php


namespace App\Controller;
use Symfony\Component\DependencyInjection\Compiler\ResolveBindingsPass;
use Symfony\Component\HttpFoundation\Response;


class KullaniciController
{
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/")
     */

    public function homepage()
    {
        return new Response('Kullanıcı Ekranı');
    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/hareketler/{fonk}")
     */
    public function show($fonk){
            return new Response(sprintf(
               'Hareket yoktur %s',
                $fonk
            ));
    }
}