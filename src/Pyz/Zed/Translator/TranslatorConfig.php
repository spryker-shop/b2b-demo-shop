<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Translator;

use Spryker\Zed\Translator\TranslatorConfig as SprykerTranslatorConfig;

class TranslatorConfig extends SprykerTranslatorConfig
{
    /**
     * @return array<string>
     */
    public function getCoreTranslationFilePathPatterns(): array
    {
        $coreTranslationFilePathPatterns = parent::getCoreTranslationFilePathPatterns();
        $coreTranslationFilePathPatterns[] = APPLICATION_VENDOR_DIR . '/spryker-feature/*/data/translation/Zed/[a-z][a-z]_[A-Z][A-Z].csv';

        return $coreTranslationFilePathPatterns;
    }
}
