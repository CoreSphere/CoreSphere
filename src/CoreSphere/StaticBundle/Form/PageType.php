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
            ->add('publishedAt')
            ->add('slug')
        ;
    }
	public function getName()
    {
        return 'staticbundle_static';
    }
}