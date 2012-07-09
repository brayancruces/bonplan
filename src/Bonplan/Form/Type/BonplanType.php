<?php

namespace Bonplan\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Locale\Stub\StubIntlDateFormatter;

class BonplanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', 'date', array(
            'widget' => 'single_text',
            'input'  => 'string',
            'format' => 'yyyy-MM-dd'
        ));
        $builder->add('lieu');
        $builder->add('description', 'textarea');
    }

    public function getName()
    {
        return 'bonplan';
    }
}