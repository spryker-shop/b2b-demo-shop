<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Tax\PageObject;

class TaxRateCreatePage
{
    public const URL = '/tax/rate/create';

    public const HEADER = 'Create new tax rate';

    public const SELECTOR_HEADER = 'h2';

    public const MESSAGE_SUCCESSFUL_ALERT_CREATION = '/Tax rate [0-9]+ was created successfully\\./';

    public const ERROR_MESSAGE_NAME_SHOULD_NOT_BE_BLANK = 'This value should not be blank.';

    public const ERROR_MESSAGE_COUNTRY_SHOULD_NOT_BE_BLANK = 'Select country.';

    public const ERROR_MESSAGE_PERCENTAGE_SHOULD_BE_VALID_RANGE = 'This value should be between 0 and 100.';

    public const ERROR_MESSAGE_TAX_RATE_ALREADY_EXISTS = 'Tax rate with provided name, percentage and country already exists.';

    public const MESSAGE_SUCCESSFUL_ALERT_UPDATE = 'Tax rate successfully updated.';

    public const SELECTOR_NAME = '#tax_rate_name';

    public const SELECTOR_COUNTRY = '#tax_rate_fkCountry';

    public const SELECTOR_PERCENTAGE = '#tax_rate_rate';

    public const SELECTOR_DELETE_FROM_EDIT = 'i.fa.fa-trash';

    public const SELECTOR_SAVE = 'input.btn.btn-primary';

    public const SELECTOR_LIST_OF_TAX_RATES_BUTTON = '//div[@class="title-action"]/a';

    public const TAX_RATE_VALID = 'validTaxRate';

    public const TAX_RATE_INVALID = 'invalidTaxRate';

    public const TAX_RATE_VALID_NOT_CREATED = 'validTaxRateNotCreated';

    public const TAX_RATE_VALID_EDITED = 'validTaxRateEdited';

    /**
     * @var array<string, array<string, string>>
     */
    public static array $taxRateData = [
        self::TAX_RATE_VALID => [
            'name' => 'Acceptance Standard',
            'country' => 'Germany',
            'percentage' => '5',
        ],
        self::TAX_RATE_INVALID => [
            'name' => '',
            'country' => 'No country',
            'percentage' => '888',
        ],
        self::TAX_RATE_VALID_NOT_CREATED => [
            'name' => 'Acceptance Standard Not Created',
            'country' => 'Germany',
            'percentage' => '5',
        ],
        self::TAX_RATE_VALID_EDITED => [
            'name' => 'Acceptance Standard Edited',
            'country' => 'Germany',
            'percentage' => '10',
        ],
    ];
}
