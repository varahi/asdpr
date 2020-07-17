<?php
namespace T3Dev\Andprmembers\Controller;


/***
 *
 * This file is part of the "andprmembers" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Dmitry Vasilev <dmitry@t3dev.ru>
 *
 ***/
/**
 * AppealController
 */
class AppealController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * appealRepository
     * 
     * @var \T3Dev\Andprmembers\Domain\Repository\AppealRepository
     */
    protected $appealRepository = null;

    /**
     * @param \T3Dev\Andprmembers\Domain\Repository\AppealRepository $appealRepository
     */
    public function injectAppealRepository(\T3Dev\Andprmembers\Domain\Repository\AppealRepository $appealRepository)
    {
        $this->appealRepository = $appealRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $appeals = $this->appealRepository->findAll();
        $this->view->assign('appeals', $appeals);
    }

    /**
     * action show
     * 
     * @param \T3Dev\Andprmembers\Domain\Model\Appeal $appeal
     * @return void
     */
    public function showAction(\T3Dev\Andprmembers\Domain\Model\Appeal $appeal)
    {
        $this->view->assign('appeal', $appeal);
    }
}
