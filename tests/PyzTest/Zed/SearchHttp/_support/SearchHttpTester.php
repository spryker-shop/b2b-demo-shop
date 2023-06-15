<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\SearchHttp;

use Codeception\Actor;
use Generated\Shared\DataBuilder\SearchEndpointAvailableBuilder;
use Generated\Shared\DataBuilder\SearchEndpointRemovedBuilder;
use Generated\Shared\Transfer\SearchEndpointAvailableTransfer;
use Generated\Shared\Transfer\SearchEndpointRemovedTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\SearchHttp\Persistence\SpySearchHttpConfig;
use Orm\Zed\SearchHttp\Persistence\SpySearchHttpConfigQuery;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class SearchHttpTester extends Actor
{
    use _generated\SearchHttpTesterActions;

    /**
     * @return bool
     */
    public function seeThatDynamicStoreEnabled(): bool
    {
        return $this->getLocator()->store()->facade()->isDynamicStoreEnabled();
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return void
     */
    public function assertSearchHttpConfigExistsForStore(StoreTransfer $storeTransfer): void
    {
        $searchHttpConfigEntity = $this->getSearchHttpConfigEntity($storeTransfer);

        $this->assertNotNull($searchHttpConfigEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return void
     */
    public function assertSearchHttpConfigIsRemovedForStore(StoreTransfer $storeTransfer): void
    {
        $searchHttpConfigEntity = $this->getSearchHttpConfigEntity($storeTransfer);

        $this->assertSame(
            ['search_http_configs' => []],
            $searchHttpConfigEntity->getData(),
        );
    }

    /**
     * @param array $messageAttributeSeedData
     *
     * @return \Generated\Shared\Transfer\SearchEndpointAvailableTransfer
     */
    public function buildSearchEndpointAvailableTransfer(array $messageAttributeSeedData = []): SearchEndpointAvailableTransfer
    {
        return (new SearchEndpointAvailableBuilder())
            ->withMessageAttributes($messageAttributeSeedData)
            ->build();
    }

    /**
     * @param array $messageAttributeSeedData
     *
     * @return \Generated\Shared\Transfer\SearchEndpointRemovedTransfer
     */
    public function buildSearchEndpointRemovedTransfer(array $messageAttributeSeedData = []): SearchEndpointRemovedTransfer
    {
        return (new SearchEndpointRemovedBuilder())
            ->withMessageAttributes($messageAttributeSeedData)
            ->build();
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return void
     */
    public function removeHttpConfigForStore(StoreTransfer $storeTransfer): void
    {
        (new SpySearchHttpConfigQuery())
            ->filterByStoreName($storeTransfer->getName())
            ->delete();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $searchMessageTransfer
     *
     * @return void
     */
    public function handleSearchMessage(TransferInterface $searchMessageTransfer): void
    {
        $messageBrokerFacade = $this->getLocator()->messageBroker()->facade();
        $messageBrokerFacade->sendMessage($searchMessageTransfer);
        $messageBrokerFacade->startWorker(
            $this->buildMessageBrokerWorkerConfigTransfer(['search'], 1),
        );
        $this->resetInMemoryMessages();
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Orm\Zed\SearchHttp\Persistence\SpySearchHttpConfig|null
     */
    protected function getSearchHttpConfigEntity(StoreTransfer $storeTransfer): ?SpySearchHttpConfig
    {
        return (new SpySearchHttpConfigQuery())
            ->filterByStoreName($storeTransfer->getName())
            ->findOne();
    }
}
