<?php declare(strict_types=1);

namespace App\Entity;

class SelfEmployed implements Taxable
{
    /** @var string */
    private $siret;

    /** @var string */
    private $name;

    /** @var float */
    private $taxPercentage = 33;

    public function getTaxPercentage(): float
    {
        return $this->taxPercentage;
    }
}
