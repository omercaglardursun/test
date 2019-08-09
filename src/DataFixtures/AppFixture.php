<?php


namespace App\DataFixtures;


use App\Entity\Micropost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadMicroPosts($manager);
        $this->loadUsers($manager);
    }
    private function loadMicroPosts(ObjectManager $manager){
        for ($i = 1; $i < 10; $i++){
            $micropost= new Micropost();
            $micropost->setText('admin  ' . $i . ' giriş yapıldı');
            $micropost ->setTime(new \DateTime('2018-03-15'));
            $manager->persist($micropost);
        }
        $manager->flush();
    }
    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('omercaglar');
        $user->setFullName('omercaglardursun');
        $user->setEmail('omercaglardursun@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'12345678'));
        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @return mixed
     */
    public function getPasswordEncoder()
    {
        return $this->passwordEncoder;
    }

    /**
     * @param mixed $passwordEncoder
     */
    public function setPasswordEncoder($passwordEncoder): void
    {
        $this->passwordEncoder = $passwordEncoder;
    }

}