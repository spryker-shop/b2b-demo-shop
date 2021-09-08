<?php

namespace Pyz\Zed\HelloSpryker\Business\Reverser;

use Generated\Shared\Transfer\HelloSprykerTransfer;

class StringReverser implements StringReverserInterface
{
    /**
     * @param string $stringToReverse
     *
     * @return string
     */
    public function reverseString(HelloSprykerTransfer $helloSprykerTransfer): HelloSprykerTransfer
    {
        $reversedString = strrev($helloSprykerTransfer->getOriginalString());
        $helloSprykerTransfer->setReversedString($reversedString);

        return $helloSprykerTransfer;
    }
}
