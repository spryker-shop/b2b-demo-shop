<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Form;

use Spryker\Zed\Form\Communication\Plugin\Form\CsrfFormPlugin;
use Spryker\Zed\Form\FormDependencyProvider as SprykerFormDependencyProvider;
use Spryker\Zed\Gui\Communication\Plugin\Form\NoValidateFormTypeExtensionFormPlugin;
use Spryker\Zed\Gui\Communication\Plugin\Form\SanitizeXssTypeExtensionFormPlugin;
use Spryker\Zed\Http\Communication\Plugin\Form\HttpFoundationFormPlugin;
use Spryker\Zed\MultiFactorAuth\Communication\Plugin\Form\MultiFactorAuthExtensionFormPlugin;
use Spryker\Zed\Validator\Communication\Plugin\Form\ValidatorFormPlugin;
use Spryker\Zed\WebProfiler\Communication\Plugin\Form\WebProfilerFormPlugin;

class FormDependencyProvider extends SprykerFormDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\FormExtension\Dependency\Plugin\FormPluginInterface>
     */
    protected function getFormPlugins(): array
    {
        $formPlugins = [
            new ValidatorFormPlugin(),
            new HttpFoundationFormPlugin(),
            new CsrfFormPlugin(),
            new NoValidateFormTypeExtensionFormPlugin(),
            new SanitizeXssTypeExtensionFormPlugin(),
            new MultiFactorAuthExtensionFormPlugin(),
        ];

        if (class_exists(WebProfilerFormPlugin::class)) {
            $formPlugins[] = new WebProfilerFormPlugin();
        }

        return $formPlugins;
    }
}
