<?php

namespace Bonplan\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BonplanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date');
        $builder->add('lieu');
        $builder->add('description');
    }

    public function getName()
    {
        return 'bonplan';
    }
}