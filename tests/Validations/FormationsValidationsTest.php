<?php

namespace App\Tests\Validation;
use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormationsValidationsTest extends KernelTestCase{

        public function getFormation(): Formation{
            return(new Formation())->setTitle("Cours n°5555 sur les Test Kernel")->setVideoId("vefvVEv56");
        }

        public function testDateInferieurAAujourdhui(){
            $formation = $this->getFormation()->setPublishedAt(new \DateTime('25/12/2025'));
            $this->assertErrors($formation, 1);
        }

        public function assertErrors(Formation $formation, int $nbErreursAttendues){
            self::bootKernel();
            $validator = self::getContainer()->get(ValidatorInterface::class);
            $error = $validator->validate($formation);
            $this->assertCount($nbErreursAttendues, $error);
        }
}
