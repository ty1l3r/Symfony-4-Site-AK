<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class AdType extends AbstractType

{
    /**
     * Permet d'avoir la configuration de base d'un champs
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder)
    {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

 

        $builder
            ->add('title', TextType::class, $this-> getConfiguration("Track", "Nom de la nouvelle Track"))
            ->add('price', MoneyType::class, $this-> getConfiguration("Prix", "indiquez le prix de la track")) 
            ->add('genre', TextType::class, $this-> getConfiguration("Genre", "Indie, Electro, Hip-Hop ..."))
            ->add('duree')
            ->add('annee', TextType::class, $this-> getConfiguration("Année", "Année de sortie"))
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
