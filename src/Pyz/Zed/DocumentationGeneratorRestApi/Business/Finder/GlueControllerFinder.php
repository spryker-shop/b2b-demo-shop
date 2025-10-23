<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DocumentationGeneratorRestApi\Business\Finder;

use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Zed\DocumentationGeneratorRestApi\Business\Finder\GlueControllerFinder as SprykerGlueControllerFinder;

class GlueControllerFinder extends SprykerGlueControllerFinder
{
    /**
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface $plugin
     *
     * @return array<\SplFileInfo>
     */
    public function getGlueControllerFilesFromPlugin(ResourceRoutePluginInterface $plugin): array
    {
        $controllerNamespace = $this->getPluginControllerClass($plugin);
        $controllerNamespaceExploded = explode('\\', $controllerNamespace);

        $controllerIndex = array_search('Controller', $controllerNamespaceExploded, true);
        $moduleName = ($controllerIndex !== false && $controllerIndex > 0) ? $controllerNamespaceExploded[$controllerIndex - 1] : array_slice($controllerNamespaceExploded, -3)[0];

        $existingDirectories = $this->getMonoRepositoryControllerSourceDirectories($moduleName, $moduleName);
        if (!$existingDirectories) {
            $existingDirectories = $this->getMonoRepositoryControllerSourceDirectories(
                $this->toSingular($this->removeRestApiSuffix($moduleName)),
                $moduleName,
            );
        }

        if (!$existingDirectories) {
            return [];
        }

        $finder = clone $this->finder;
        $finder->in($existingDirectories)->name(sprintf(static::PATTERN_CONTROLLER_FILENAME, end($controllerNamespaceExploded)));

        return iterator_to_array($finder);
    }

    /**
     * @param string $moduleDirectory
     * @param string $moduleName
     *
     * @return array<string>
     */
    protected function getMonoRepositoryControllerSourceDirectories(string $moduleDirectory, string $moduleName): array
    {
        $directories = array_map(function ($directory) use ($moduleDirectory, $moduleName) {
            return sprintf($directory, $moduleDirectory, $moduleName);
        }, $this->sourceDirectories);

        return $this->getExistingSourceDirectories($directories);
    }

    protected function removeRestApiSuffix(string $moduleName): string
    {
        return str_replace('RestApi', '', $moduleName);
    }

    protected function toSingular(string $moduleName): string
    {
        $rules = [
            '/(s|x|z|ch|sh)es$/i' => '$1',
            '/ies$/i' => 'y',
            '/ves$/i' => 'f',
            '/s$/i' => '',
        ];

        foreach ($rules as $pattern => $replacement) {
            if (preg_match($pattern, $moduleName)) {
                return preg_replace($pattern, $replacement, $moduleName);
            }
        }

        return $moduleName;
    }
}
