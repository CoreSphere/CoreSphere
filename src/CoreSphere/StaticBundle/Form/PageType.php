<?php

namespace CoreSphere\StaticBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('published_at')
            ->add('permalink')
        ;
    }
	public function getName()
    {
        return 'staticbundle_static';
    }
}