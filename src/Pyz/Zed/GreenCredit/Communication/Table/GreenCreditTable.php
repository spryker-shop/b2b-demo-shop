<?php

namespace Pyz\Zed\GreenCredit\Communication\Table;

use Orm\Zed\GreenCredit\Persistence\Map\SpyGreenCreditTableMap;
use Orm\Zed\GreenCredit\Persistence\SpyGreenCreditQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\GreenCredit\Communication\Form\ApproveGreenCreditForm;
use Spryker\Zed\GreenCredit\Communication\Form\DenyGreenCreditForm;
use Spryker\Service\UtilText\Model\Url\Url;

use Spryker\Zed\CompanyGui\Communication\Form\ApproveCompanyForm;
use Spryker\Zed\CompanyGui\Communication\Form\DenyCompanyForm;

class GreenCreditTable extends AbstractTable
{

    public const CREDITSTATUS = ['1'=>'Submitted','2'=>'Approved','3'=>'Rejected','4'=>'Closed'];
    /**
     * @var string
     */
    public const ACTIONS = 'Actions';

    /**
     * @var string
     */
    public const STATUS = 'Status';

    /**
     * @var string
     */
    public const COL_STATUS = 'approved';
    /**
     * @var \Orm\Zed\GreenCredit\Persistence\SpyGreenCreditQuery
     */
    protected $spyGreenCreditQuery;

    /**
     * @var string
     */
    public const URL_GREEN_CREDIT_APPROVE = '/green-credit/index/activate';

    /**
     * @var string
     */
    public const URL_GREEN_CREDIT_DENY = '/green-credit/index/deny';

    /**
     * @var string
     */
    public const REQUEST_ID_CREDIT = 'id-credit';

    /**
     * GreenCreditTable constructor.
     *
     * @param \Orm\Zed\GreenCredit\Persistence\SpyGreenCreditQuery $spyGreenCreditQuery
     */
    public function __construct(SpyGreenCreditQuery $spyGreenCreditQuery)
    {
        $this->spyGreenCreditQuery = $spyGreenCreditQuery;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            SpyGreenCreditTableMap::COL_ID => 'Request ID',
            SpyGreenCreditTableMap::COL_SERVICE_REQUEST_NO => 'Request No',
            SpyGreenCreditTableMap::COL_QUANTITY => 'Quantity',
            SpyGreenCreditTableMap::COL_TOTAL => 'Credits',
            SpyGreenCreditTableMap::COL_REQUEST_RAISED_AT => 'Raised At',
            SpyGreenCreditTableMap::COL_CREATED_AT => 'Created At',
            SpyGreenCreditTableMap::COL_STATUS => 'Status',
            static::ACTIONS => 'Actions',
            
        ]);
        $config->addRawColumn(SpyGreenCreditTableMap::COL_STATUS);
        $config->addRawColumn('Actions');

        $config->setSortable([
            SpyGreenCreditTableMap::COL_ID,
            SpyGreenCreditTableMap::COL_QUANTITY,
            SpyGreenCreditTableMap::COL_TOTAL,
            SpyGreenCreditTableMap::COL_STATUS,
            SpyGreenCreditTableMap::COL_SERVICE_REQUEST_NO,
        ]);

        $config->setSearchable([
            SpyGreenCreditTableMap::COL_ID,
            SpyGreenCreditTableMap::COL_SERVICE_REQUEST_NO,
        ]);

    

        $config->setDefaultSortField(SpyGreenCreditTableMap::COL_ID,
        \Spryker\Zed\Gui\Communication\Table\TableConfiguration::SORT_ASC);

        return $config;
    }

    /**
     * @param TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $queryResult = $this->runQuery($this->spyGreenCreditQuery, $config);

        $results = [];
        foreach ($queryResult as $resultItem) {
            $results[] = [
                SpyGreenCreditTableMap::COL_ID => $resultItem[SpyGreenCreditTableMap::COL_ID],
                SpyGreenCreditTableMap::COL_SERVICE_REQUEST_NO => $resultItem[SpyGreenCreditTableMap::COL_SERVICE_REQUEST_NO],
                SpyGreenCreditTableMap::COL_QUANTITY => $resultItem[SpyGreenCreditTableMap::COL_QUANTITY],
                SpyGreenCreditTableMap::COL_TOTAL => $resultItem[SpyGreenCreditTableMap::COL_TOTAL],
                
                SpyGreenCreditTableMap::COL_REQUEST_RAISED_AT => $resultItem[SpyGreenCreditTableMap::COL_REQUEST_RAISED_AT],
                SpyGreenCreditTableMap::COL_CREATED_AT => $resultItem[SpyGreenCreditTableMap::COL_CREATED_AT],
               // SpyGreenCreditTableMap::COL_STATUS => Static::CREDITSTATUS[$resultItem[SpyGreenCreditTableMap::COL_STATUS]],
               SpyGreenCreditTableMap::COL_STATUS => $this->generateStatusLabels(Static::CREDITSTATUS[$resultItem[SpyGreenCreditTableMap::COL_STATUS]]),
                
                static::ACTIONS => $this->buildLinks($resultItem[SpyGreenCreditTableMap::COL_ID]),
                
            ];
        }

        return $results;
    }

    protected function buildLinks($id)
    {
       
        $buttons = [];
        $options = ['class'=>'btn-danger'];
        $buttons[] = $this->generateEditButton('/green-credit/index/activate?id=' . $id.'&action=approve', 'Approve');
       // $buttons[] = $this->generateRemoveButton('/green-credit/edit?id=' . $id, 'Reject');
       // $buttons[] = $this->generateStatusChangeButton($id,'approve');
       $buttons[] = $this->generateRemoveButton('/green-credit/index/activate?id=' . $id.'&action=deny', 'Deny');
       $buttons[] = $this->generateEditButton('/green-credit/index/activate?id=' . $id.'&action=close', 'Close');

       // $buttons = $this->expandLinks($$id);

        return implode(' ', $buttons);
    }



    

    /**
     * @param array $item
     *
     * @return string
     */
    protected function generateStatusChangeButton(int $id, $action)
    {
        if($action == 'approve') {
            return $this->generateFormButton(
                Url::generate(static::URL_GREEN_CREDIT_APPROVE, [
                    static::REQUEST_ID_CREDIT => $id,
                ]),
                'Approve',
                ApproveCompanyForm::class,
            );

        } else {

            return $this->generateFormButton(
                Url::generate(static::URL_GREEN_CREDIT_DENY, [
                    static::REQUEST_ID_CREDIT => $id,
                ]),
                'Deny',
                DenyCompanyForm::class,
                [
                    static::BUTTON_ICON => 'fa-trash',
                    static::BUTTON_CLASS => 'btn-danger safe-submit',
                ],
            );

        }
            
    }

    /**
     * @param array $item
     *
     * @return string
     */
    protected function generateStatusLabels($action)
    {
        if ($action =='Submitted') {
            return $this->generateLabel('Submitted', 'label-info');
        }
        if ($action =='Approved') {
            return $this->generateLabel('Approved', 'label-success');
        }
        if ($action =='Rejected') {
            return $this->generateLabel('Rejected', 'label-danger');
        }
        if ($action =='Closed') {
            return $this->generateLabel('Closed', 'label-success');
        }

        return $this->generateLabel('Inactive', 'label-danger');
    }
    
}