<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Customer\PageObject;

use Generated\Shared\Transfer\AddressTransfer;

class CustomerAddressesPage
{
    /**
     * @var string
     */
    public const URL = '/en/customer/address';

    /**
     * @var string
     */
    public const BUTTON_ADD_NEW_ADDRESS = '//nav//a[contains(@class, \'button\') and contains(text(), \'Add new address\')]';

    /**
     * @var string
     */
    public const ADDRESS_A = 'address a';

    /**
     * @var string
     */
    public const ADDRESS_B = 'address b';

    /**
     * @var array
     */
    protected static $addresses = [
        self::ADDRESS_A => [
            'salutation' => 'Mr',
            'firstName' => 'Cat',
            'lastName' => 'Face',
            'company' => 'Spryker',
            'phone' => '123456789',
            'address1' => self::ADDRESS_A,
            'address2' => '1',
            'address3' => 'left side',
            'zipCode' => '12345',
            'city' => 'Berlin',
            'iso2Code' => 'DE',
        ],
        self::ADDRESS_B => [
            'salutation' => 'Mrs',
            'firstName' => 'Face',
            'lastName' => 'Cat',
            'company' => 'Spryker',
            'phone' => '123456789',
            'address1' => self::ADDRESS_B,
            'address2' => '1',
            'address3' => 'right side',
            'zipCode' => '12345',
            'city' => 'Berlin',
            'iso2Code' => 'DE',
        ],
    ];

    /**
     * @param string $address
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public static function getAddressData(string $address): AddressTransfer
    {
        $addressTransfer = new AddressTransfer();
        $addressTransfer->fromArray(self::$addresses[$address]);

        return $addressTransfer;
    }
}
