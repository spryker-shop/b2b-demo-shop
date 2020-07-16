<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Communication\Plugin\CombinedProduct\ProductAbstract;

use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\DataImportExtension\Dependency\Plugin\DataSetWriterPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * There is a faster way to import data. You can use it instead of this class if you use PostgreSQL
 *
 * @see \Pyz\Zed\DataImport\Communication\Plugin\CombinedProduct\ProductAbstract\CombinedProductAbstractBulkPdoWriterPlugin
 *
 * @method \Pyz\Zed\DataImport\Business\DataImportFacadeInterface getFacade()
 * @method \Pyz\Zed\DataImport\DataImportConfig getConfig()
 */
class CombinedProductAbstractPropelWriterPlugin extends AbstractPlugin implements DataSetWriterPluginInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function write(DataSetInterface $dataSet): void
    {
        $this->getFacade()->writeCombinedProductAbstractDataSet($dataSet);
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        $this->getFacade()->flushCombinedProductAbstractDataImporter();
    }
}
