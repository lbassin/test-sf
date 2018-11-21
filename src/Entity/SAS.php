<?php declare(strict_types=1);

namespace App\Entity;

class SAS implements Taxable
{
    /** @var string */
    private $siret;

    /** @var string */
    private $name;

    /** @var string */
    private $address;

    /** @var float */
    private $taxPercentage;

    public function getTaxPercentage(): float
    {
        return $this->taxPercentage;
    }
}
