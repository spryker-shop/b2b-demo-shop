<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\Console\Helper;

use Codeception\Module;
use Codeception\Module\Cli;
use Codeception\TestInterface;
use Codeception\Util\FileSystem;
use SprykerTest\Shared\Testify\Helper\ModuleHelperConfigTrait;

class ConsoleHelper extends Module
{
    use ModuleHelperConfigTrait;

    public const RUNNER = 'console_runner.php';

    public const SANDBOX_DIR = 'cli_sandbox/';

    public function _after(TestInterface $test): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        foreach ($this->config['cleanup_dirs'] as $dir) {
            $dir = codecept_data_dir() . self::SANDBOX_DIR . $dir;
            $this->debugSection('Cleanup', $dir);
            FileSystem::deleteDir($dir);
        }
    }

    public function runSprykerCommand(string $command): void
    {
        $command = 'php ' . codecept_data_dir() . self::RUNNER . " $command";
        $this->getCli()->runShellCommand($command);
    }

    protected function setDefaultConfig(): void
    {
        $this->config = [
            'cleanup_dirs' => ['data', 'src'],
        ];
    }

    protected function getCli(): Cli|\Codeception\Module
    {
        return $this->getModule('Cli');
    }
}
