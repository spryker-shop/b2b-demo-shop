<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oms\Communication;

use Pyz\Zed\Oms\OmsDependencyProvider;
use Spryker\Zed\Oms\Communication\OmsCommunicationFactory as SprykerOmsCommunicationFactory;
use Spryker\Zed\Translator\Business\TranslatorFacadeInterface;

/**
 * @method \Pyz\Zed\Oms\Business\OmsFacadeInterface getFacade()
 */
class OmsCommunicationFactory extends SprykerOmsCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Translator\Business\TranslatorFacadeInterface
     */
    public function getTranslatorFacade(): TranslatorFacadeInterface
    {
        return $this->getProvidedDependency(OmsDependencyProvider::FACADE_TRANSLATOR);
    }
}
