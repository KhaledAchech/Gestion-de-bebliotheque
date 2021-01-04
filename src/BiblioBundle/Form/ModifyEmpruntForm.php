<?php


namespace BiblioBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class ModifyEmpruntForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_retour', DateType::class, [
                'widget' => 'choice']);
    }
    public function getName()
    {
        return 'Emprunter';
    }
}