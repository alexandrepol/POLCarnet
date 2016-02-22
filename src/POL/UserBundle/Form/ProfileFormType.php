<?php
namespace POL\UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType ;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $this->buildUserForm($builder, $options);

      $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
          'label' => 'form.current_password',
          'translation_domain' => 'FOSUserBundle',
          'mapped' => false,
          'constraints' => new UserPassword(),
      ));
  }


  public function getParent(){
    return 'fos_user_profile';
  }

  public function getBlockPrefix(){
    return 'pol_user_profile';
  }

  public function getName(){
    return $this->getBlockPrefix();
  }

  protected function buildUserForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->remove('username')
      ->remove('current_password')
      ->add('adress', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'Adresse :', 'translation_domain' => 'FOSUserBundle'))
      ->add('phone', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'Téléphone :', 'translation_domain' => 'FOSUserBundle'))
      ->add('website', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'Site Web :', 'translation_domain' => 'FOSUserBundle'))
    ;
  }

}




?>
