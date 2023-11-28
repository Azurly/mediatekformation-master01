<?php

namespace App\Tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class FormationsTest extends TestCase{

        // 1 : Date au format string
        public function testDateFormatString(){
            $formation = new Formation();
            $formation->setPublishedAt(new \DateTime("2022-04-14"));
            $this->assertEquals("14/04/2022", $formation->getPublishedAtString());
        }
}