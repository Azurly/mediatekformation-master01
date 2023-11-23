<?php

namespace App\Tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class FormationsTest extends TestCase{

    public function testGetDateString(){
        $formation = new Formation();
        $formation->setPublishedAt(new \DateTime("2023-01-04"));
        $this->assertEquals("04/01/2023", $formation->getPublishedAtString());
    }
}