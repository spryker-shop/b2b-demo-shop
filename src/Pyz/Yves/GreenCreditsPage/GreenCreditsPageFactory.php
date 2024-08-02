<?php
namespace Pyz\Yves\GreenCreditsPage;

use Pyz\Yves\GreenCreditsPage\Form\GreenCreditsFormType;
use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;

class GreenCreditsPageFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createGreenCreditsForm()
    {
        return $this->getFormFactory()->create(GreenCreditsFormType::class);
    }

    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory()
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }
}
