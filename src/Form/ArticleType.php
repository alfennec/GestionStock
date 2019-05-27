<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = $options['abbrChoices'];

        $builder
            ->add('idCat',ChoiceType::class,[
                'choices'=> $choices,
            ])
            ->add('desArt',null, ['label'=>'Description'])
            ->add('etatArt')
            ->add('qteArt')
            ->add('qteSeilMin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'abbrChoices' => array(),
        ]);
    }
}
