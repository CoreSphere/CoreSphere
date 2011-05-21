<?php

namespace CoreSphere\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('username');
		$builder->add('email');
		$builder->add('plainPassword', 'repeated', array(
		    'type' => 'password'
		));
		$builder->add('enabled');

		$builder->add('expires');
		$builder->add('expiresAt');

		$builder->add('description');
    }
}