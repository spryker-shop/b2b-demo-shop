<?php

namespace Pyz\Zed\GreenCredit\Communication;

use Orm\Zed\GreenCredit\Persistence\SpyGreenCreditQuery;
use Pyz\Zed\GreenCredit\Communication\Table\GreenCreditTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class GreenCreditCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return GreenCreditTable
     */
    public function createGreenCreditTable(): GreenCreditTable
    {
        return new GreenCreditTable($this->createGreenCreditQuery());
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function createGreenCreditQuery(): SpyGreenCreditQuery
    {
        return SpyGreenCreditQuery::create();
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createApproveGreenCreditForm(): FormInterface
    {
        return $this->getFormFactory()->create(ApproveGreenCreditForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createDenyGreenCreditForm(): FormInterface
    {
        return $this->getFormFactory()->create(DenyGreenCreditForm::class);
    }
}