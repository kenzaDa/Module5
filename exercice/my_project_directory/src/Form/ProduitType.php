<?php

namespace App\Form;

use App\Entity\Produit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { $produit =new Produit();
        $builder
            ->add('Label')
            ->add('Prix')
            ->add('Quantite')
            ->add('Categorie' ,CategorieType::class
                 
               )
            ->add('save', SubmitType::class, ['label' => 'Ajouter un produit']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
