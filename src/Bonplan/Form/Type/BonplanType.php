<?php

namespace Bonplan\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Locale\Stub\StubIntlDateFormatter;

class BonplanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre');
        $builder->add('date', 'date', array(
            'widget'   => 'single_text',
            'input'    => 'string',
            'format'   => 'yyyy-MM-dd',
            'required' => false
        ));
        $builder->add('lieu');
        $builder->add('description', 'textarea');
        $builder->add('prix', 'text', array('required' => false));
        $builder->add('auteur', 'text', array('required' => false, 'max_length' => 20));
    }

    public function getName()
    {
        return 'bonplan';
    }
}