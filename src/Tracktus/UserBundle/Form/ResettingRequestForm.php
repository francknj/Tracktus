<?php
namespace Tracktus\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ResettingRequestForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('email', 'email');
    }

    public function getName()
    {
        return 'ResettingRequestForm';
    }
}