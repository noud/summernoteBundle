<?php

namespace Toinou\SummernoteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SummernoteType extends AbstractType
{
    public function getParent()
    {
        return TextareaType::class;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['toinou_summernote_form_options'] = $options['toinou_summernote_form_options'];
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('toinou_summernote_form_options', $options['toinou_summernote_form_options']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'toinou_summernote_form_options' => ''
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'toinou_summernote';
    }
}
