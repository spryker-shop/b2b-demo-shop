<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\DiscountVoucher;

use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucher;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\Discount\DiscountConfig;

/**
 * @SuppressWarnings(PHPMD.CountInLoopExpression)
 */
class DiscountVoucherWriterStep implements DataImportStepInterface
{
    /**
     * @var int
     */
    public const BULK_SIZE = 100;

    /**
     * @var string
     */
    public const KEY_DISCOUNT_KEY = 'discount_key';

    /**
     * @var string
     */
    public const KEY_RANDOM_GENERATED_CODE_LENGTH = 'random_generated_code_length';

    /**
     * @var string
     */
    public const KEY_QUANTITY = 'quantity';

    /**
     * @var string
     */
    public const KEY_CUSTOM_CODE = 'custom_code';

    /**
     * @var string
     */
    public const KEY_VOUCHER_BATCH = 'voucher_batch';

    /**
     * @var string
     */
    public const KEY_IS_ACTIVE = 'is_active';

    /**
     * @var string
     */
    public const KEY_MAX_NUMBER_OF_USES = 'max_number_of_uses';

    /**
     * @var \Spryker\Zed\Discount\DiscountConfig
     */
    protected $discountConfig;

    /**
     * @param \Spryker\Zed\Discount\DiscountConfig $discountConfig
     */
    public function __construct(DiscountConfig $discountConfig)
    {
        $this->discountConfig = $discountConfig;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $discountEntity = SpyDiscountQuery::create()
            ->findOneByDiscountKey($dataSet[static::KEY_DISCOUNT_KEY]);

        $voucherBatch = $dataSet[static::KEY_VOUCHER_BATCH];

        if ($this->voucherBatchExists($discountEntity, (int)$voucherBatch)) {
            return;
        }

        $codes = $this->generateCodes((int)$dataSet[static::KEY_RANDOM_GENERATED_CODE_LENGTH], (int)$dataSet[static::KEY_QUANTITY], $dataSet[static::KEY_CUSTOM_CODE]);

        $voucherCodeCollection = new ObjectCollection();
        $voucherCodeCollection->setModel(SpyDiscountVoucher::class);

        foreach ($codes as $code) {
            $discountVoucherEntity = new SpyDiscountVoucher();
            $discountVoucherEntity
                ->setIsActive($dataSet[static::KEY_IS_ACTIVE])
                ->setVoucherBatch($voucherBatch)
                ->setCode($code)
                ->setMaxNumberOfUses($dataSet[static::KEY_MAX_NUMBER_OF_USES])
                ->setFkDiscountVoucherPool($discountEntity->getFkDiscountVoucherPool());

            $voucherCodeCollection->append($discountVoucherEntity);
        }

        $voucherCodeCollection->save();
    }

    /**
     * @param \Orm\Zed\Discount\Persistence\SpyDiscount $discountEntity
     * @param int $voucherBatch
     *
     * @return bool
     */
    protected function voucherBatchExists(SpyDiscount $discountEntity, int $voucherBatch): bool
    {
        $query = SpyDiscountVoucherQuery::create()
            ->filterByFkDiscountVoucherPool($discountEntity->getFkDiscountVoucherPool())
            ->filterByVoucherBatch($voucherBatch);

        return ($query->count() > 0);
    }

    /**
     * @param int $length
     * @param int $quantity
     * @param string|null $customCode
     *
     * @return array<string>
     */
    protected function generateCodes(int $length, int $quantity, ?string $customCode = null): array
    {
        $codesToGenerate = [];

        do {
            $code = $this->getRandomVoucherCode($length);

            if ($customCode) {
                $code = $this->addCustomCodeToGenerated($customCode, $code);
            }

            if ($this->voucherCodeExists($code) === true || in_array($code, $codesToGenerate, true)) {
                continue;
            }

            $codesToGenerate[] = $code;
        } while ($quantity !== count($codesToGenerate));

        return $codesToGenerate;
    }

    /**
     * @param string $customCode
     * @param string $code
     *
     * @return string
     */
    protected function addCustomCodeToGenerated(string $customCode, string $code): string
    {
        $replacementString = $this->discountConfig->getVoucherPoolTemplateReplacementString();

        if ($customCode === '') {
            return $code;
        }

        if (!strstr($customCode, $replacementString)) {
            return $customCode . $code;
        }

        return str_replace($replacementString, $code, $customCode);
    }

    /**
     * @param string $code
     *
     * @return bool
     */
    protected function voucherCodeExists(string $code): bool
    {
        return (SpyDiscountVoucherQuery::create()->filterByCode($code)->count() > 0);
    }

    /**
     * @param int $length
     *
     * @return string
     */
    protected function getRandomVoucherCode(int $length): string
    {
        $allowedCharacters = $this->discountConfig->getVoucherCodeCharacters();

        $consonants = $allowedCharacters[DiscountConfig::KEY_VOUCHER_CODE_CONSONANTS];
        $vowels = $allowedCharacters[DiscountConfig::KEY_VOUCHER_CODE_VOWELS];
        $numbers = $allowedCharacters[DiscountConfig::KEY_VOUCHER_CODE_NUMBERS];

        $code = '';

        while (strlen($code) < $length) {
            if (count($consonants)) {
                $code .= $consonants[random_int(0, count($consonants) - 1)];
            }

            if (count($vowels)) {
                $code .= $vowels[random_int(0, count($vowels) - 1)];
            }

            if (!count($numbers)) {
                continue;
            }

            $code .= $numbers[random_int(0, count($numbers) - 1)];
        }

        return substr($code, 0, $length);
    }
}
