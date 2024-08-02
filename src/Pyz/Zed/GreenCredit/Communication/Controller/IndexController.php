<?php
namespace Pyz\Zed\GreenCredit\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\GreenCredit\Communication\Form\ApproveGreenCreditForm;
use Spryker\Zed\GreenCredit\Communication\Form\DenyGreenCreditForm;
use Spryker\Service\UtilText\Model\Url\Url;

use Spryker\Zed\CompanyGui\Communication\Form\ApproveCompanyForm;
use Spryker\Zed\CompanyGui\Communication\Form\DenyCompanyForm;

/**
 * @method \Spryker\Zed\GreenCredit\Communication\GreenCreditCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
     /**
     * @var string
     */
    public const URL_PARAM_ID_CREDIT = 'id-credit';

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
        $idCompany = $this->castId($request->query->get(static::URL_PARAM_ID_CREDIT));
        $redirectUrl = (string)$request->query->get(static::URL_PARAM_REDIRECT_URL, static::REDIRECT_URL_DEFAULT);

      /*  $form = $this->getFactory()->createApproveCompanyForm()->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->addErrorMessage('CSRF token is not valid');

            return $this->redirectResponse($redirectUrl);
        }

        $companyTransfer = $this->createCompanyTransfer();
        $companyTransfer->setIdCompany($idCompany)->setStatus(SpyCompanyTableMap::COL_STATUS_APPROVED);

        $this->getFactory()
            ->getCompanyFacade()
            ->update($companyTransfer);
     */
        $this->addSuccessMessage(static::MESSAGE_COMPANY_APPROVE_SUCCESS);

        return $this->redirectResponse($redirectUrl);
    }
}