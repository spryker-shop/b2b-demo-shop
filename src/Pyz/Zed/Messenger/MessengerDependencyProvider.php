<?php



declare(strict_types = 1);

namespace Pyz\Zed\Messenger;

use Spryker\Zed\Glossary\Communication\Plugin\TranslationPlugin as GlossaryTranslationPlugin;
use Spryker\Zed\Messenger\MessengerDependencyProvider as SprykerMessengerDependencyProvider;
use Spryker\Zed\Translator\Communication\Plugin\Messenger\TranslationPlugin;

class MessengerDependencyProvider extends SprykerMessengerDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\MessengerExtension\Dependency\Plugin\TranslationPluginInterface>
     */
    protected function getTranslationPlugins(): array
    {
        return [
            new GlossaryTranslationPlugin(),

            /*
             * TranslationPlugin needs to be after other translator plugins.
             */
            new TranslationPlugin(),
        ];
    }
}
