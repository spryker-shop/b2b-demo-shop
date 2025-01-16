<?php



declare(strict_types = 1);

namespace Pyz\Zed\DynamicEntity;

use Spryker\Zed\DynamicEntity\DynamicEntityConfig as SprykerDynamicEntityConfig;

class DynamicEntityConfig extends SprykerDynamicEntityConfig
{
    /**
     * @var string
     */
    protected const CONFIGURATION_FILE_PATH = '%s/src/Pyz/Zed/DynamicEntity/data/installer/configuration.json';

    /**
     * @return string
     */
    public function getInstallerConfigurationDataFilePath(): string
    {
        return sprintf(static::CONFIGURATION_FILE_PATH, APPLICATION_ROOT_DIR);
    }
}
