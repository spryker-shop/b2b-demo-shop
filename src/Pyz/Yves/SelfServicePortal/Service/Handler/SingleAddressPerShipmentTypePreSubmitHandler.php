<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal\Service\Handler;

use SprykerFeature\Yves\SelfServicePortal\Service\Handler\SingleAddressPerShipmentTypePreSubmitHandler as SprykerSingleAddressPerShipmentTypePreSubmitHandler;
use Symfony\Component\Form\FormEvent;

class SingleAddressPerShipmentTypePreSubmitHandler extends SprykerSingleAddressPerShipmentTypePreSubmitHandler
{
    public function handlePreSubmit(FormEvent $event): void
    {
        $data = $event->getData();
        if (!is_array($data)) {
            return;
        }

        parent::handlePreSubmit($event);
    }
}
