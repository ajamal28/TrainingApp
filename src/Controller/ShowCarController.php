<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Form\CarFormType;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\PlanesRepository;
use App\Repository\BikesRepository;

class ShowCarController extends AbstractController
{
    private $CarRepository;
    private $planesRepository;
    private $bikesRepository;
    private $em;

    public function __construct(
      CarsRepository $CarRepository,
      PlanesRepository $planesRepository,
      BikesRepository $bikesRepository, 
      EntityManagerInterface $em
      ){
        $this->CarRepository = $CarRepository;
        $this->planesRepository = $planesRepository;
        $this->bikesRepository = $bikesRepository;
        $this->em = $em;
      }

      // Render Product List Page
    #[Route('/Cars/{category?}',   name: 'cars', )]
    public function show(Request $request, $category = null): Response
    {
      
      if($request->isXmlHttpRequest()){
        $filter = $request->query->get('filter');
      
      if ($filter === 'high_to_low') {
        $value = ['price' => 'DESC'];
      } elseif ($filter === 'low_to_high') {
        $value = ['price' => 'ASC'];
      }else {
        $value = []; 
      }
      
      $cars = $this->CarRepository->findBy([], $value);
      
      $template = $this->render('carMarkt/ShowcarsView.html.twig', [
        'cars' => $cars
      ])->getContent();
      $response = new JsonResponse();
      $response->setStatusCode(200);
      return $response->setData(['template' => $template ]); 
      }
    
      $cars = $this->CarRepository->findAll();
      return $this->render('carMarkt/ShowCars.html.twig', [
          'cars' => $cars
      ]);
       
    }

}