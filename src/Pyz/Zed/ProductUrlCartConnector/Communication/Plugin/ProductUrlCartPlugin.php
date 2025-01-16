<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductUrlCartConnector\Communication\Plugin;

use Generated\Shared\Transfer\CartChangeTransfer;
use Spryker\Zed\Cart\Dependency\ItemExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\ProductUrlCartConnector\Business\ProductUrlCartConnectorFacadeInterface getFacade()
 * @method \Pyz\Zed\ProductUrlCartConnector\Communication\ProductUrlCartConnectorCommunicationFactory getFactory()
 * @method \Pyz\Zed\ProductUrlCartConnector\ProductUrlCartConnectorConfig getConfig()
 */
class ProductUrlCartPlugin extends AbstractPlugin implements ItemExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer
    {
        $this->getFacade()->expandItems($cartChangeTransfer);

        return $cartChangeTransfer;
    }
}
