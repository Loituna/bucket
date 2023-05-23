<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Wish;
use App\Repository\CategorieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class )
            ->add('description', TextareaType::class,['label'=> 'Describe your wish maaaaan'])
            ->add('author', TextType::class)
            ->add('categorie',EntityType::class,['class'=>Categorie::class,
            'choice_label'=>'name',
                'query_builder'=>function(CategorieRepository $categorieRepository){
                $qb=$categorieRepository->createQueryBuilder('c');
                $qb->addOrderBy('c.name','ASC');
                return $qb;
                }
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
