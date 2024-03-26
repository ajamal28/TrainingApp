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
                   'placeholder'=>'Enter ProductName..' ,
                   'label' => false,
                   'required' => false
                )
            ] )
            ->add('price',IntegerType::class,[
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Price..' ,
                   'required' => false
                )
            ])
            ->add('productDescription',TextareaType::class, [
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Description..',
                   'required' => false 
                )
            ] )
            ->add('mainImage',TextType::class,[
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Main Image URL..' ,
                   'required' => false
                )
            ])
            ->add('image2',TextType::class,[
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Image 2 URL..' ,
                   'required' => false
                )
            ])
            ->add('image3',TextType::class,[
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Image 3 URL' ,
                   'required' => false
                )
            ])
            ->add('mileage' ,IntegerType::class,[
                'attr'=> array(
                    'label' => false,
                   'placeholder'=>'Enter Mileage..' ,
                   'required' => false
                )
            ])
            ->add('year', null, [
                'widget' => 'single_text',
                'attr'=> array(
                    'label' => false,
                    'required' => false,
                    'placeholder'=>'Enter Year..'
                )
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
