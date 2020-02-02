<?php


namespace App\Tests\Entity;


use App\Entity\Animal;
use DateTime;
use PHPUnit\Framework\TestCase;

class AnimalTest extends TestCase
{
    public function testValidAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoNameAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoBreedAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoBirthAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoTypeAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setSex("M");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoSexAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setAllergies("no");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoAllergiesAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setWeight("89");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoWeightAnimal(){
        $date = new DateTime('2015-04-03');
        $animal = new Animal();
        $animal->setName("diana");
        $animal->setBreed("Sphynx");
        $animal->setBirthDate($date);
        $animal->setType("cat");
        $animal->setSex("M");
        $animal->setAllergies("no");

        $result = $animal->isValid();
        $this->assertEquals(true, $result);
    }
}