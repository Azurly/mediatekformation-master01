<?php

namespace App\Tests\Validations;
use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormationsValidationsTest extends KernelTestCase{

        /**
         * The code snippet is written in PHP and contains test cases for validating the published date
         * of a formation.
         * 
         * Formation The `getFormation()` function returns an instance of the `Formation`
         * class.
         */
        //Instanciation d'une formation pour les tests
        public function getFormation(): Formation{
            return(new Formation())->setTitle("Cours n°5555 sur les Test Kernel")->setVideoId("vefvVEv56");
        }

        //TestDate inferieur à aujourd'hui
        public function testDateInferieurEgalTodayPasOK(){
            $formation = $this->getFormation()->setPublishedAt(new \DateTime("2025-04-04"));
            $this->assertErrors($formation, 1);

        }
        public function testDateInferieurEgalTodayOK(){
            $formation = $this->getFormation()->setPublishedAt(new \DateTime("2023-04-04"));
            $this->assertErrors($formation, 0);
        }

        //Fonction qui sert à gérer les erreurs
        public function assertErrors(Formation $formation, int $nbErreursAttendues, string $message=""){
            self::bootKernel();
            $validator = self::getContainer()->get(ValidatorInterface::class);
            $error = $validator->validate($formation);
            $this->assertCount($nbErreursAttendues, $error, $message);
        }
}
