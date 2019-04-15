<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdType extends ApplicationType

{
  

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

 

        $builder
            ->add('title', TextType::class, $this-> getConfiguration("Track", "Nom de la nouvelle Track"))
            ->add('price', MoneyType::class, $this-> getConfiguration("Prix", "indiquez le prix de la track")) 

            ->add('genre', ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices'  => [
                    'Hip-Hop' => 'Hip-Hop',
                    'Indie Music' => 'Indie Music',
                    'Techno' => 'Techno',
                    'Minimal' => 'Minimal',
                    'Jazz afro-cubain' => 'Jazz afro-cubain' ,
                    'Electro' => 'Electro',
                    'OST - Original Soundtrack' => 'Original Soundtrack',
                    'Expérimentale' => 'Expérimentale' ,
                ], 
            ])

            ->add('duree')
            ->add('annee', IntegerType::class, $this-> getConfiguration("Année", "Année de sortie"))
            //->add('tduree')
            ->add('image', UrlType::class, $this-> getConfiguration("Image", "Entrez l'URL de l'image"))
            //->add('slug')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
