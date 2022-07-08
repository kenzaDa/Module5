<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategorieType extends AbstractType
{  
    

private $cat;
 
public function __construct(CategorieRepository $cat){
    $this->cat = $cat;
}
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        $categories = $this->cat->findAll();
        $choices = array();
        foreach ($categories as $categorie) {
         $choices[$categorie->getNom()] = $categorie->getNom();
        }
        


        $builder
            ->add('nom',ChoiceType::class, [
                'choices' => $choices] )
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
