<?php declare(strict_types=1);

namespace App\Calculator;

use App\Entity\Taxable;

class Tax
{
    public function calcul(Taxable $taxable, float $annualEarnings): float
    {
        if ($annualEarnings < 0) {
            throw new \LogicException('Annual earning has to be greater than 0');
        }

        return $annualEarnings * ($taxable->getTaxPercentage() / 100);
    }
}
