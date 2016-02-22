<?php
namespace POL\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationType extends AbstractType{
  public function buildForm(FormBuilderInterface $builder, array $options){
    $builder->add('adress');
    $builder->add('phone');
    $builder->add('website');
  }

  public function getParent(){
    return 'fos_user_registration';
  }

  public function getBlockPrefix(){
    return 'pol_user_registration';
  }

  public function getName(){
    return $this->getBlockPrefix();
  }

}





 ?>
