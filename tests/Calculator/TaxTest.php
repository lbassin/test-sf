<?php

namespace App\Tests\Calculator;

use App\Calculator\Tax as TaxCalculator;
use App\Entity\SAS;
use App\Entity\SelfEmployed;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class TaxTest extends TestCase
{
    /** @var TaxCalculator */
    private $calculator;

    public function setUp()
    {
        $this->calculator = new TaxCalculator();
    }

    private function getSAS()
    {
        /** @var SAS|MockObject $company */
        $company = $this->createMock(SAS::class);
        $company->method('getTaxPercentage')->willReturn(33);

        return $company;
    }

    private function getSelfEmployed()
    {
        /** @var SAS|MockObject $company */
        $company = $this->createMock(SelfEmployed::class);
        $company->method('getTaxPercentage')->willReturn(25);

        return $company;
    }

    public function SASCorrectTaxes()
    {
        return [
            [100, 33],
            [27363, 9029.79],
            [7, 2.31],
        ];
    }

    public function SelfEmployedCorrectTaxes()
    {
        return [
            [100, 25],
            [74623, 18655.75],
            [6, 1.5],
        ];
    }

    /**
     * @dataProvider SASCorrectTaxes
     */
    public function testSASCorrectCase($earning, $taxExpected)
    {
        $company = $this->getSAS();

        $tax = $this->calculator->calcul($company, $earning);

        $this->assertEquals($taxExpected, $tax);
    }

    public function testSASEarningLessThanZero()
    {
        $company = $this->getSAS();

        $this->expectException(\LogicException::class);

        $this->calculator->calcul($company, -1);
    }

    /**
     * @dataProvider SelfEmployedCorrectTaxes
     */
    public function testSelfEmployedCorrectCase($earning, $taxExpected)
    {
        $company = $this->getSelfEmployed();

        $tax = $this->calculator->calcul($company, $earning);

        $this->assertEquals($taxExpected, $tax);
    }

    public function testSelfEmployedEarningLessThanZero()
    {
        $company = $this->getSelfEmployed();

        $this->expectException(\LogicException::class);

        $this->calculator->calcul($company, -1);
    }

    public function tearDown()
    {
        $this->calculator = null;
    }
}