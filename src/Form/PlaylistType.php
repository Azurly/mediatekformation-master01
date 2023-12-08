<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaylistType extends AbstractType
{
    /**
     * The function builds a form with fields for name, description, and a submit button, and
     * configures it to use the Playlist class as its data.
     * 
     *  builder The `` parameter is an instance of the
     * `FormBuilderInterface` class. It is used to define the form fields and their options.
     *  options The `` parameter is an array that can be used to pass additional
     * options to the form builder. These options can be used to customize the behavior of the form,
     * such as setting validation constraints or adding custom form events.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
