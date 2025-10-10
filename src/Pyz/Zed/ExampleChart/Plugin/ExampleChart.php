<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ExampleChart\Plugin;

use Generated\Shared\Transfer\ChartDataTraceTransfer;
use Generated\Shared\Transfer\ChartDataTransfer;
use Spryker\Shared\Chart\Dependency\Plugin\ChartPluginInterface;

class ExampleChart implements ChartPluginInterface
{
    public function getName(): string
    {
        return 'testChart';
    }

    /**
     * @param string|null $dataIdentifier
     */
    public function getChartData($dataIdentifier = null): ChartDataTransfer // phpcs:ignore
    {
        $data = new ChartDataTransfer();
        $data->setTitle('test');
        $data->setKey('test');
        $data->addTrace($this->getTrace());

        return $data;
    }

    protected function getTrace(): ChartDataTraceTransfer
    {
        $trace = new ChartDataTraceTransfer();
        $trace->setValues([11, 23, 31]);
        $trace->setLabels(['one', 'two', 'three']);
        $trace->setType('pie');

        return $trace;
    }
}
