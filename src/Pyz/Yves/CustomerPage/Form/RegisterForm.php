<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Form;

use SprykerShop\Yves\CustomerPage\Form\RegisterForm as SprykerRegisterForm;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterForm extends SprykerRegisterForm
{
    /**
     * @todo REMOVE THIS when fix will be merged, this is temporary fix for https://spryker.atlassian.net/browse/PS-5957
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault(static::OPTION_MIN_LENGTH_CUSTOMER_PASSWORD, 1);
    }
}
