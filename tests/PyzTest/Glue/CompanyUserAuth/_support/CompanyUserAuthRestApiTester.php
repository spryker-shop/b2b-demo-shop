<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\CompanyUserAuth;

use SprykerTest\Glue\Testify\Tester\ApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(\PyzTest\Glue\CompanyUserAuth\PHPMD)
 */
class CompanyUserAuthRestApiTester extends ApiEndToEndTester
{
    use _generated\CompanyUserAuthRestApiTesterActions;

    /**
     * @var string
     */
    protected const ACCESS_TOKEN_JSON_PATH = '$.data.attributes.accessToken';

    /**
     * @var string
     */
    protected const REFRESH_TOKEN_JSON_PATH = '$.data.attributes.refreshToken';

    /**
     * @return void
     */
    public function seeResponseHasAccessToken(): void
    {
        $this->assertNotEmpty($this->getDataFromResponseByJsonPath(self::ACCESS_TOKEN_JSON_PATH));
    }

    /**
     * @return void
     */
    public function seeResponseHasRefreshToken(): void
    {
        $this->assertNotEmpty($this->getDataFromResponseByJsonPath(self::REFRESH_TOKEN_JSON_PATH));
    }

    /**
     * @return void
     */
    public function dontSeeResponseHasAccessToken(): void
    {
        $this->assertFalse($this->getDataFromResponseByJsonPath(self::ACCESS_TOKEN_JSON_PATH));
    }

    /**
     * @return void
     */
    public function dontSeeResponseHasRefreshToken(): void
    {
        $this->assertFalse($this->getDataFromResponseByJsonPath(self::REFRESH_TOKEN_JSON_PATH));
    }

    /**
     * @return string|null
     */
    public function grabAccessTokenFromResponse(): ?string
    {
        return $this->getDataFromResponseByJsonPath(self::ACCESS_TOKEN_JSON_PATH);
    }
}
