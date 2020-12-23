<?php


namespace BiblioBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class DocumentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextareaType::class)
            ->add('date',DateType::class, [
                'widget' => 'choice'])
            ->add('auteur',TextareaType::class)
            ->add('type',TextareaType::class);
    }
    public function getName()
    {
        return 'Document';
    }
}