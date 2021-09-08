<?php

namespace Pyz\Zed\HelloSpryker\Business\Writer;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Pyz\Zed\HelloSpryker\Persistence\HelloSprykerEntityManagerInterface;

class StringWriter implements StringWriterInterface
{
    /**
     * @var \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerEntityManagerInterface
     */
    protected $helloSprykerEntityManager;

    /**
     * @param \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerEntityManagerInterface $helloSprykerEntityManager
     */
    public function __construct(HelloSprykerEntityManagerInterface $helloSprykerEntityManager)
    {
        $this->helloSprykerEntityManager = $helloSprykerEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\HelloSprykerTransfer $helloSprykerTransfer
     *
     * @return \Generated\Shared\Transfer\HelloSprykerTransfer
     */
    public function createHelloSprykerEntity(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        return $this->helloSprykerEntityManager->saveHelloSprykerEntity($helloSprykerTransfer);
    }
}

