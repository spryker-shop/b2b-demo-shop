<?php

namespace Pyz\Zed\HelloSpryker\Business\Reader;

use Generated\Shared\Transfer\HelloSprykerTransfer;
use Pyz\Zed\HelloSpryker\Persistence\HelloSprykerRepositoryInterface;

class StringReader implements StringReaderInterface
{
    /**
     * @var \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerRepositoryInterface
     */
    protected $helloSprykerRepository;

    /**
     * @param \Pyz\Zed\HelloSpryker\Persistence\HelloSprykerRepositoryInterface $helloSprykerRepository
     */
    public function __construct(HelloSprykerRepositoryInterface $helloSprykerRepository)
    {
        $this->helloSprykerRepository = $helloSprykerRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\HelloSprykerTransfer $helloSprykerTransfer
     *
     * @return \Generated\Shared\Transfer\HelloSprykerTransfer
     */
    public function findHelloSpryker(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        $helloSprykerTransfer = $this->helloSprykerRepository->findPyzHelloSprykerById($helloSprykerTransfer->getIdHelloSpryker());

        if (!$helloSprykerTransfer) {
            return new HelloSprykerTransfer();
        }

        return $helloSprykerTransfer;
    }
}
