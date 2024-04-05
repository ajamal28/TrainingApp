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
    #[Route('/Cars',   name: 'cars', )]
    public function show(Request $request): Response
    {
      
      if($request->isXmlHttpRequest()){
        $priceFilter = $request->query->get('priceFilter');
        $categoryFilter = $request->query->get('categoryFilter');
      
      if ($priceFilter === 'high_to_low') {
        $sort = ['price' => 'DESC'];
      } elseif ($priceFilter === 'low_to_high') {
        $sort = ['price' => 'ASC'];
      }
      
      
        switch ($categoryFilter) {
          case 'all':
            $cars = array_merge(
              $this->planesRepository->findAll(),
              $this->CarRepository->findAll(),
              $this->bikesRepository->findAll()
          );
          break;  
          case 'planes':
            $cars = $this->planesRepository->findBy([], $sort);
            break;
          case 'cars':
            $cars = $this->CarRepository->findBy([], $sort);
            break;
          case 'bikes':
            $cars = $this->bikesRepository->findBy([], $sort);
            break;
          default:
            $cars = $this->CarRepository->findBy([], $sort);
        }
      
      
      
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