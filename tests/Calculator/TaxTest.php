<?php

namespace App\Tests\Calculator;

use App\Calculator\Tax as TaxCalculator;
use App\Entity\Taxable;
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

    public function correctTaxes()
    {
        return [
            [100, 33],
            [27363, 9029.79],
            [7, 2.31],
        ];
    }

    /**
     * @dataProvider correctTaxes
     */
    public function testCorrectCase($earning, $taxExpected)
    {
        /** @var Taxable|MockObject $company */
        $company = $this->createMock(Taxable::class);
        $company->expects($this->once())->method('getTaxPercentage')->willReturn('33');

        $tax = $this->calculator->calcul($company, $earning);

        $this->assertEquals($taxExpected, $tax);
    }

    public function testEarningLessThanZero()
    {
        /** @var Taxable|MockObject $company */
        $company = $this->createMock(Taxable::class);
        $company->expects($this->never())->method('getTaxPercentage');

        $this->expectException(\LogicException::class);

        $this->calculator->calcul($company, -1);
    }

    public function tearDown()
    {
        $this->calculator = null;
    }
}