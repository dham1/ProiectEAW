<?php


namespace App\Tests\Entity;
use App\Entity\UserDetails;
use DateTime;
use PHPUnit\Framework\TestCase;

class UserDetailsTest extends TestCase
{
    public function testValidDetails(){
        $date = new DateTime('2015-04-03');
        $detail = new UserDetails();
        $detail->setFirstName("diana");
        $detail->setLastName("aaa");
        $detail->setBirthDate($date);
        $detail->setAddress("No 1");
        $detail->setPhone("11111122222");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoPhoneDetails()
    {
        $date = new DateTime('2015-04-03');
        $detail = new UserDetails();
        $detail->setFirstName("diana");
        $detail->setLastName("aaa");
        $detail->setBirthDate($date);
        $detail->setAddress("No 1");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoFirstNameDetails()
    {
        $date = new DateTime('2015-04-03');
        $detail = new UserDetails();
        $detail->setLastName("aaa");
        $detail->setBirthDate($date);
        $detail->setAddress("No 1");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoLastNameDetails()
    {
        $date = new DateTime('2015-04-03');
        $detail = new UserDetails();
        $detail->setFirstName("diana");
        $detail->setBirthDate($date);
        $detail->setAddress("No 1");
        $detail->setPhone("11111122222");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoAddressDetails()
    {
        $date = new DateTime('2015-04-03');
        $detail = new UserDetails();
        $detail->setFirstName("diana");
        $detail->setLastName("aaa");
        $detail->setBirthDate($date);
        $detail->setPhone("11111122222");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
    public function testNoBirthDateDetails(){
        $detail = new UserDetails();
        $detail->setFirstName("diana");
        $detail->setLastName("aaa");
        $detail->setAddress("No 1");
        $detail->setPhone("11111122222");

        $result = $detail->isValid();
        $this->assertEquals(true, $result);
    }
}