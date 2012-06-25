<?php

namespace Bonplan\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class BonplanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', 'date', array(
            'input' => 'datetime',
            'widget' => 'single_text'
        ));
        $builder->add('lieu');
        $builder->add('description', 'textarea');
    }

    public function getName()
    {
        return 'bonplan';
    }
}