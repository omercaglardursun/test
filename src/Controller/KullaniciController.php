<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Compiler\ResolveBindingsPass;
use Symfony\Component\HttpFoundation\Response;


class KullaniciController extends AbstractController
{
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/")
     */
    public function homepage()
    {
        return $this->render('admin/admin.html.twig');
    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/hareketler/{fonk}")
     */
    public function show($fonk){
       $comments = [
           'infomedya',
           'dijital ajans',
           '--------------',
       ];
            return $this->render('kullanici/show.html.twig',[
                'title' => ucwords(str_replace('-','',$fonk)),
                'comments' => $comments,
                'adsoy' => 'ÖMER ÇAĞLAR DURSUN',
            ]);
    }
}