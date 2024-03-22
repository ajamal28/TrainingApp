<?php

namespace App\Form;

use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName',TextType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter ProductName..' 
                )
            ] )
            ->add('price',IntegerType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter Price..' 
                )
            ])
            ->add('productDescription',TextareaType::class, [
                'attr'=> array(
                   'placeholder'=>'Enter Description..' 
                )
            ] )
            ->add('mainImage',TextType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter Main Image URL..' 
                )
            ])
            ->add('image2',TextType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter Image 2 URL..' 
                )
            ])
            ->add('image3',TextType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter Image 3 URL' 
                )
            ])
            ->add('mileage' ,IntegerType::class,[
                'attr'=> array(
                   'placeholder'=>'Enter Mileage..' 
                )
            ])
            ->add('year', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
