<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Country\Repository;

interface CountryRepositoryInterface
{
    /**
     * @param string $countryName
     *
     * @return bool
     */
    public function hasCountryByName(string $countryName): bool;

    /**
     * @param string $countryName
     *
     * @return int
     */
    public function getIdCountryByName(string $countryName): int;
}
