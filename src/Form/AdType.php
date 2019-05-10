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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class AdType extends ApplicationType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    

        $builder
            ->add('title', TextType::class, $this-> getConfiguration("Track", "Nom de la nouvelle Track"))
            ->add('price', MoneyType::class, array('attr' => array('class' =>'formPrice')),$this-> getConfiguration("Prix", "indiquez le prix de la track")) 
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
            ->add('soundcloud', TextareaType::class, $this->getConfiguration("Lien Soundcloud", "enter l'url soundcloud de votre track"))
            ->add('duree')
            ->add('annee', IntegerType::class, array('attr' => array('class' =>'formAnnee')), $this-> getConfiguration("Année", "Année de sortie"))
            //->add('tduree')
            ->add('image', UrlType::class,array('attr' => array('class' =>'formImage')), $this-> getConfiguration("Image", "Entrez l'URL de l'image"))
            //->add('slug')
            ->add('about', TextareaType::class, array('attr' => array('class' =>'formAbout')),$this->getConfiguration("About", "Merci de décrire votre track !"))
        
           
            
        ;

    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
