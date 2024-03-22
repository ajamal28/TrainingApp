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



class HomePageController extends AbstractController
{   
    private $CarRepository;
    private $em;

    public function __construct(CarsRepository $CarRepository, EntityManagerInterface $em){
        $this->CarRepository = $CarRepository;
        $this->em = $em;
      }

      //Render Homepage
    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        return $this->render('carMarkt/index.html.twig', [
            
        ]);
    }


    // Render Product List Page
    #[Route('/Cars', methods:['GET'],  name: 'cars', )]
    public function show(): Response
    {
        $cars = $this->CarRepository->findAll();
        
        return $this->render('carMarkt/ShowCars.html.twig', [
          'cars'=>$cars
        ]); 
    }


    //Display Product Page
    #[Route('/Cars/{id}', methods:['GET'], name: 'CarDetails', )]
    public function Display($id): Response
    {
        $car = $this->CarRepository->find($id);
        
        return $this->render('carMarkt/ShowCarDetails.html.twig', [
          'car'=>$car
        ]); 
    }

    //Render Admin Page
    #[Route('/Admin', methods:['GET'],  name: 'adminPage', )]
    public function Admin(): Response
    {
        $cars = $this->CarRepository->findAll();
        
        return $this->render('carMarkt/Admin.html.twig', [
          'cars'=>$cars
        ]); 
    }


    //Render Create Page
  #[Route('/Admin/Create', name: 'adminCreatePage', )]
  public function Create(Request $request): Response
  {
    $car = new Cars();
    $form = $this->createForm(CarFormType::class, $car);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
      $newCar =$form->getData();
      $this->em->persist($newCar);
      $this->em->flush();

      return $this->redirectToRoute('adminPage');
     
    }
   

    return $this->render('carMarkt/create.html.twig', [
      'form'=>$form->createView()
    ]);
  }

  //Render EDIT
  #[Route('/Admin/edit/{id}', name: 'editPage', )]
  public function edit($id, Request $request): Response 
  {
    $car = $this->CarRepository->find($id);
    $form = $this->createForm(CarFormType::class, $car);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){

      $car->setProductName($form->get('productName')->getData());
      $car->setPrice($form->get('price')->getData());
      $car->setProductDescription($form->get('productDescription')->getData());
      $car->setMainImage($form->get('mainImage')->getData());
      $car->setImage2($form->get('image2')->getData());
      $car->setImage3($form->get('image3')->getData());
      $car->setYear($form->get('year')->getData());
      $car->setMileage($form->get('mileage')->getData());
      
      $this->em->flush();
      return $this->redirectToRoute('adminPage');
     
    }
   
    return $this->render('carMarkt/edit.html.twig',[
      'car'=>$car,
      'form'=>$form->createView()
    ]);
  }

}
