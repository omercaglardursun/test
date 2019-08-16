<?php


namespace App\Controller;
use App\Entity\Micropost;
use App\Form\MicroPostType;
use App\Repository\MicropostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use  Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;

//use http\Env\Response;

 /**
 * @\Symfony\Component\Routing\Annotation\Route("/micro-post")
 */
class MicroPostController
{
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var MicropostRepository
     */
    private $microPostRespository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;


    /**
     * MicroPostController constructor.
     * @param \Twig_Environment $twig
     * @param MicropostRepository $micropostRepository
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     * @param FlashBagInterface $flashBag
     */
    public function __construct(\Twig_Environment $twig, MicropostRepository $micropostRepository, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, RouterInterface $router, FlashBagInterface $flashBag)
    {
        $this ->twig =  $twig;
        $this ->microPostRespository = $micropostRepository;
        $this ->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->flashBag = $flashBag;
    }

    /**
     * @return MicropostRepository
     */
    public function getMicroPostRespository(): MicropostRepository
    {
        return $this->microPostRespository;
    }

    /**
     * @param MicropostRepository $microPostRespository
     */
    public function setMicroPostRespository(MicropostRepository $microPostRespository): void
    {
        $this->microPostRespository = $microPostRespository;
    }

    /**
     * @return FormFactoryInterface
     */
    public function getFormFactory(): FormFactoryInterface
    {
        return $this->formFactory;
    }

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function setFormFactory(FormFactoryInterface $formFactory): void
    {
        $this->formFactory = $formFactory;
    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/", name="micro_post_index")
     */
    public function index(){ //Anasayfam localhost/micro_post_index
        $html = $this->twig->render('micro-post/index.html.twig',[
           'posts' => $this->microPostRespository->findBy([],['time' => 'DESC']),
        ]);
        return new Response($html);
    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/düzenle/{id}", name="micro_post_edit")
     */
    public function düzenle(MicroPost $microPost, Request $request)
    {
        $form = $this-> formFactory->create(microPostType::class,$microPost);
        $form ->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $this->entityManager->persist($microPost);//kaydetme işlemi -- Entity Manager kullanıyoruz
            $this->entityManager->flush(); //kaydetme işlemi ilan etme uygulama --- --- --- -

            return new RedirectResponse(
                $this->router->generate('micro_post_index') // kaydettikten sonra geri Dönüşü tanımlıyor -- ilk route kurup sonra
            );
        }
        return new Response(
            $this->twig->render('micro-post/ekleme.html.twig',['form' => $form->createView()])
        );

    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/silme/{id}", name="micro_post_delete")
     */
    public function silme(MicroPost $microPost)
    {
        $this->entityManager->remove($microPost);
        $this->entityManager->flush();

        $this->flashBag->add('alert', 'Micro post was deleted');


        return new RedirectResponse(
            $this->router->generate('micro_post_index')
        );
    }

    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/ekle", name="micro_post_add")
     */
    public function ekle(Request $request)
    {
        $microPost= new Micropost();
        $microPost->setTime(new\DateTime());

        $form = $this-> formFactory->create(MicroPostType::class,$microPost);
        $form ->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $this->entityManager->persist($microPost);//kaydetme işlemi -- Entity Manager kullanıyoruz
            $this->entityManager->flush(); //kaydetme işlemi --- --- --- -

            return new RedirectResponse(
                $this->router->generate('micro_post_index') // kaydettikten sonra geri Dönüşü tanımlıyor -- ilk route kurup sonra
            );
        }
        return new Response(
           $this->twig->render('micro-post/ekleme.html.twig',['form' => $form->createView()])
        );

    }
    /**
     *  @\Symfony\Component\Routing\Annotation\Route("/{id}", name="micro_post_post")
     */
    public function post($id) //gosterme yayınlama komutumuz
    {
        $post = $this->microPostRespository->find($id);

        return new Response(
            $this->twig->render(
                'micro-post/goster2.html.twig',
                [
                    'post' =>$post
                ]
            )
        );

    }






}