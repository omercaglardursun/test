<?php


namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('username', TextType::class,[
         'label' => 'Kullanıcı Adı :'
       ])
           ->add('email', EmailType::class,[
               'label' => 'E-mail'
           ])
           ->add('plainPassword', RepeatedType::class,[
               'type' => PasswordType::class,
               'first_options' => ['label' => 'Şifre :'],
               'second_options' => ['label' => 'Doğrulama Şifresi :']
           ])
           ->add('fullName', TextType::class,[
               'label' => 'Ad ve Soyad :'
           ])
           ->add('termsAgreed',CheckboxType::class,[
             'mapped' => false,
               'constraints' => new IsTrue(),
               'label' => 'Kullanım Haklarını Kabul Ediyorum.'
           ])
           ->add('Register', SubmitType::class,[
               'label' => 'Kaydet'
           ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> User::class
        ]);
    }

}