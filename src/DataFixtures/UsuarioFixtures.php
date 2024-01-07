<?php
    namespace App\DataFixtures;

    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use App\Entity\Administrador;

    class UsuarioFixtures extends Fixture{
        public function load(ObjectManager $manager): void{
            for ($i = 1; $i < 6; $i++) {
                $administrador = new Administrador();
                $administrador->setNombre('administrador'.$i);
                $administrador->setEmail('administrador'.$i.'@gmail.com');
                $administrador->setPassword('$2y$13$EzjTOY54tt/XbYTrnBGgs.Wz2ve71DIc/HNOwH4TABF84Z4UUyhFu');
                $manager->persist($administrador);
            }
            $manager->flush();
        }
    }
?>
