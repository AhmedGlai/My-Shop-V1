<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @var  Environment
     */

    private $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $repository): Response
    {
        $property=$repository->findLatest();
        return $this->render('pages/home.html.twig',[
            'property'=>$property
        ]);
    }
}