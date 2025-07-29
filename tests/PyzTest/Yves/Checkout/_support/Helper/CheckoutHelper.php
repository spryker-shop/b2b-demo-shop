<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Checkout\Helper;

use Codeception\Module;

class CheckoutHelper extends Module
{
    /**
     * @return \Codeception\Module|\Codeception\Module\WebDriver
     */
    protected function getWebDriver()
    {
        return $this->getModule('WebDriver');
    }

    /**
     * @return $this
     */
    public function processCustomerStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Create account');

        $tester->fillField('//*[@id="registerForm_customer_first_name"]', 'first-name-test' . rand(100, 999));
        $tester->fillField('//*[@id="registerForm_customer_last_name"]', 'last-name-test' . rand(100, 999));
        $tester->fillField('//*[@id="registerForm_customer_email"]', 'email-test@domain-' . rand(100, 999) . '.tld');
        $tester->fillField('//*[@id="registerForm_customer_password_pass"]', 'as');
        $tester->fillField('//*[@id="registerForm_customer_password_confirm"]', 'as');
        $tester->click('[data-qa*="registerForm_customer_accept_terms"] [data-qa="label"]');

        return $this;
    }

    /**
     * @return $this
     */
    public function clickRegisterButton()
    {
        $tester = $this->getWebDriver();
        $tester->click('[data-qa*="register-form"] [data-qa="submit-button"]');

        return $this;
    }

    /**
     * @return $this
     */
    public function processAddressStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Delivery Address');

        $tester->fillField('//*[@id="addressesForm_shippingAddress_first_name"]', 'first-name-test' . rand(100, 999));
        $tester->fillField('//*[@id="addressesForm_shippingAddress_last_name"]', 'last-name-test' . rand(100, 999));
        $tester->fillField('//*[@id="addressesForm_shippingAddress_company"]', 'company-test' . rand(100, 999));
        $tester->fillField('//*[@id="addressesForm_shippingAddress_phone"]', '123456789');
        $tester->fillField('//*[@id="addressesForm_shippingAddress_address1"]', 'address1');
        $tester->fillField('//*[@id="addressesForm_shippingAddress_address2"]', '15');
        $tester->fillField('//*[@id="addressesForm_shippingAddress_address3"]', 'address3');
        $tester->fillField('//*[@id="addressesForm_shippingAddress_zip_code"]', '10405');
        $tester->fillField('//*[@id="addressesForm_shippingAddress_city"]', 'city');

        return $this;
    }

    /**
     * @return $this
     */
    public function processShipmentStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Shipment');

        $tester->click('[data-qa*="shipmentForm_idShipmentMethod_1"] [data-qa="label"]');

        return $this;
    }

    /**
     * @return $this
     */
    public function processOverviewStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Summary');

        return $this;
    }

    /**
     * @return $this
     */
    public function processSuccessStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Your order has been placed successfully!');

        return $this;
    }

    /**
     * @return $this
     */
    public function processPaymentStep()
    {
        $tester = $this->getWebDriver();
        $tester->see('Payment');

        $tester->click('[data-qa*="paymentForm_paymentSelection_1"] [data-qa="label"]');
        $tester->executeJS('document.querySelector(".js-payment-method-2-0").classList.remove("is-hidden")');
        $tester->fillField('//*[@id="paymentForm_dummyPaymentInvoice_date_of_birth"]', '01.07.1985');

        return $this;
    }

    /**
     * @return $this
     */
    public function nextStep()
    {
        $tester = $this->getWebDriver();
        $tester->click('//*[contains(@class, "button--success")]');

        return $this;
    }

    /**
     * @return $this
     */
    public function processAllCheckoutSteps()
    {
        $this->processCustomerStep()
            ->clickRegisterButton()
            ->processAddressStep()
            ->nextStep()
            ->processShipmentStep()
            ->nextStep()
            ->processPaymentStep()
            ->nextStep()
            ->processOverviewStep()
            ->nextStep()
            ->processSuccessStep();

        return $this;
    }
}
