<?php
namespace Pyz\Zed\GreenCredit\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\GreenCredit\Communication\Form\ApproveGreenCreditForm;
use Spryker\Zed\GreenCredit\Communication\Form\DenyGreenCreditForm;
use Spryker\Service\UtilText\Model\Url\Url;

use Spryker\Zed\CompanyGui\Communication\Form\ApproveCompanyForm;
use Spryker\Zed\CompanyGui\Communication\Form\DenyCompanyForm;
use Orm\Zed\GreenCredit\Persistence\Map\SpyGreenCreditTableMap;
use Symfony\Component\HttpFoundation\Request;
use Generated\Shared\Transfer\SpyGreenCreditEntityTransfer;
use Pyz\Zed\GreenCredit\Persistence\GreenCreditEntityManager;
/**
 * @method \Spryker\Zed\GreenCredit\Communication\GreenCreditCommunicationFactory getFactory()
 * @method \Pyz\Zed\GreenCredit\Persistence\GreenCreditEntityManagerInterface getEntityManager()
**/
class IndexController extends AbstractController
{
     /**
     * @var string
     */
    public const URL_PARAM_ID_CREDIT = 'id';

    /**
     * @var string
     */
    public const URL_PARAM_ACTION_CREDIT = 'action';

    /**
     * @var string
     */
    public const COL_STATUS_APPROVED = 2;

    /**
     * @var string
     */
    public const COL_STATUS_DENY = 3;

    /**
     * @var string
     */
    public const COL_STATUS_CLOSE = 4;

    /**
     * @var string
     */
    public const URL_PARAM_REDIRECT_URL = 'redirect-url';

    /**
     * @var string
     */
    public const REDIRECT_URL_DEFAULT = '/green-credit';

    /**
     * @var string
     */
    public const MESSAGE_CREDIT_APPROVE_SUCCESS = 'Credit Request has been approved.';

    /**
     * @var string
     */
    public const MESSAGE_CREDIT_DENY_SUCCESS = 'Credit Request has been denied.';

    /**
     * @var string
     */
    public const MESSAGE_CREDIT_CLOSE_SUCCESS = 'Credit Request has been closed.';

    /**
     * @return array
     */
    public function indexAction()
    {
        $greencreditTable = $this->getFactory()
            ->createGreenCreditTable();

        return $this->viewResponse([
            'credits' => $greencreditTable->render(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function tableAction()
    {
        $table = $this->getFactory()
            ->createGreenCreditTable();

        return $this->jsonResponse($table->fetchData());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function activateAction(Request $request)
    {
       
        $actionCredit = $_GET['action'];
        $idCredit = $this->castId($request->query->get(static::URL_PARAM_ID_CREDIT));
       // $actionCredit = $this->castAction($request->query->get(static::URL_PARAM_ACTION_CREDIT));
        $redirectUrl = (string)$request->query->get(static::URL_PARAM_REDIRECT_URL, static::REDIRECT_URL_DEFAULT);
        /*
        $form = $this->getFactory()->createApproveCompanyForm()->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->addErrorMessage('CSRF token is not valid');

            return $this->redirectResponse($redirectUrl);
        }
*/
        $greenCreditTransfer = new SpyGreenCreditEntityTransfer();
        if($actionCredit == 'deny') {
            $greenCreditTransfer->setId($idCredit)->setStatus(static::COL_STATUS_DENY);
            $entityManager = new GreenCreditEntityManager();
            $entityManager->saveCredit($greenCreditTransfer);

            $this->addSuccessMessage(static::MESSAGE_CREDIT_DENY_SUCCESS);
        } elseif($actionCredit == 'close') {
            $greenCreditTransfer->setId($idCredit)->setStatus(static::COL_STATUS_CLOSE);
            $entityManager = new GreenCreditEntityManager();
            $entityManager->saveCredit($greenCreditTransfer);

            $this->addSuccessMessage(static::MESSAGE_CREDIT_CLOSE_SUCCESS);
        } else {
            $greenCreditTransfer->setId($idCredit)->setStatus(static::COL_STATUS_APPROVED);
            $entityManager = new GreenCreditEntityManager();
            $entityManager->saveCredit($greenCreditTransfer);

            $this->addSuccessMessage(static::MESSAGE_CREDIT_APPROVE_SUCCESS);
        }
        
        
        

        return $this->redirectResponse($redirectUrl);
    }

    
}