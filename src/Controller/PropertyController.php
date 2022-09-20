<?php

namespace App\Controller;


use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $manager)
    {

        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/store" , name="product_index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator,Request $request): Response
    {
        $search = new PropertySearch();
        $form=$this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        $property = $paginator->paginate($this->repository->findAllVisibleQuery($search),
        $request->query->getInt('page',1),12);

        return $this->render('property/index.html.twig',[
            'current_menu'=>'property',
            'property'=>$property,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/store/{slug}-{id}", name="property.show", requirements={"slug": "[a-z..0-9\-]*"})
     * @param $slug
     * @param $id
     * @return Response
     */
    public function show(Property $property,string $slug):Response
    {
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show',[
               'id'=>$property->getId(),
               'slug'=>$property->getSlug()
            ],301);
        }
        return $this->render('property/show.html.twig',[
           'property'=>$property
        ]);

    }
}
