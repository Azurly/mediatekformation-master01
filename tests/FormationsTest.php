<?php

namespace App\Tests;

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

class FormationsTest extends TestCase{

        /**
         * The function `testDateFormatString` tests the `getPublishedAtString` method of the
         * `Formation` class to ensure that it returns the correct date format as a string.
         */
        // 1 : Date au format string
        public function testDateFormatString(){
            $formation = new Formation();
            $formation->setPublishedAt(new \DateTime("2022-04-14"));
            $this->assertEquals("14/04/2022", $formation->getPublishedAtString());
        }
}