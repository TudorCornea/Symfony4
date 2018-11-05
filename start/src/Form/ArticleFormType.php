<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 11/5/2018
 * Time: 1:57 PM
 */

namespace App\Form;


use App\Entity\Article;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null,[
                'help' => 'Choose something catchy',
                ])
            ->add('content')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
        // ce se intampla aici , cand formit se submita observa the data class si in cazul de fata va creea un obiect nou
        // de tip article si dupa va folosi metodele setari din entitate ca sa populeze baza de date
        // de exemplu formul are doar title si content , si cand facem submit la el va face call la setTitle si setContent
        // se face asta daca vrei si daca ai o entitate care arata ca formul
    }

}
