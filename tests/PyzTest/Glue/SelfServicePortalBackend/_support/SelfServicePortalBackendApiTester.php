<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortalBackend;

use SprykerTest\Glue\Testify\Tester\BackendApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class SelfServicePortalBackendApiTester extends BackendApiEndToEndTester
{
    use _generated\SelfServicePortalBackendApiTesterActions;

    protected const RESOURCE_SSP_ASSETS = 'ssp-assets';

    /**
     * @param list<string> $includes
     */
    public function getGetCollectionSspAssetsUrl(array $includes = []): string
    {
        return $this->formatUrl(static::RESOURCE_SSP_ASSETS . $this->formatQueryInclude($includes));
    }

    public function getGetSspAssetUrl(string $assetUuid): string
    {
        return $this->formatUrl(static::RESOURCE_SSP_ASSETS . '/' . $assetUuid);
    }

    public function getCreateSspAssetUrl(): string
    {
        return $this->formatUrl(static::RESOURCE_SSP_ASSETS);
    }

    public function getUpdateSspAssetUrl(string $assetUuid): string
    {
        return $this->formatUrl(static::RESOURCE_SSP_ASSETS . '/' . $assetUuid);
    }

    /**
     * @param string $name
     * @param string $serialNumber
     * @param string $status
     * @param string $note
     * @param string $externalImageUrl
     * @param string $companyBusinessUnitOwnerUuid
     *
     * @return array<string, mixed>
     */
    public function buildAssetCreateRequestData(
        string $name,
        string $serialNumber,
        string $status,
        string $note,
        string $externalImageUrl,
        string $companyBusinessUnitOwnerUuid,
    ): array {
        return [
            'data' => [
                'type' => static::RESOURCE_SSP_ASSETS,
                'attributes' => [
                    'name' => $name,
                    'serialNumber' => $serialNumber,
                    'status' => $status,
                    'note' => $note,
                    'externalImageUrl' => $externalImageUrl,
                    'companyBusinessUnitOwnerUuid' => $companyBusinessUnitOwnerUuid,
                ],
            ],
        ];
    }

    /**
     * @param string $serialNumber
     * @param string $note
     * @param string $externalImageUrl
     * @param string $name
     *
     * @return array<string, mixed>
     */
    public function buildAssetUpdateRequestData(
        string $serialNumber,
        string $note,
        string $externalImageUrl,
        string $name = '',
    ): array {
         $data = [
            'data' => [
                'type' => static::RESOURCE_SSP_ASSETS,
                'attributes' => [
                    'name' => $name,
                    'serialNumber' => $serialNumber,
                    'note' => $note,
                    'externalImageUrl' => $externalImageUrl,
                ],
            ],
         ];

         if ($name) {
             $data['data']['attributes']['name'] = $name;
         }

         return $data;
    }

    /**
     * @param list<string> $includes
     */
    protected function formatQueryInclude(array $includes): string
    {
        if ($includes === []) {
            return '';
        }

        return '?include=' . implode(',', $includes);
    }
}
