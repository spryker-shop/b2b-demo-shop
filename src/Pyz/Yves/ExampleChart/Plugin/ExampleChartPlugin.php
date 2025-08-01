<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ExampleChart\Plugin;

use Generated\Shared\Transfer\ChartDataTraceTransfer;
use Generated\Shared\Transfer\ChartDataTransfer;
use Generated\Shared\Transfer\ChartLayoutTransfer;
use Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

class ExampleChartPlugin extends AbstractPlugin implements ChartPluginInterface
{
    /**
     * @var string
     */
    public const NAME = 'testChart';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param string|null $dataIdentifier
     *
     * @return \Generated\Shared\Transfer\ChartDataTransfer
     */
    public function getChartData($dataIdentifier = null): ChartDataTransfer // phpcs:ignore
    {
        $data = new ChartDataTransfer();

        $data->setTitle('test');
        $data->setKey('test');
        $data->addTrace($this->getTrace());

        return $data;
    }

    /**
     * @return \Generated\Shared\Transfer\ChartLayoutTransfer
     */
    public function getChartLayout(): ChartLayoutTransfer
    {
        return new ChartLayoutTransfer();
    }

    /**
     * @return \Generated\Shared\Transfer\ChartDataTraceTransfer
     */
    protected function getTrace(): ChartDataTraceTransfer
    {
        $trace = new ChartDataTraceTransfer();
        $trace->setValues([11, 23, 31]);
        $trace->setLabels(['one', 'two', 'three']);
        $trace->setType('bar');

        return $trace;
    }
}
