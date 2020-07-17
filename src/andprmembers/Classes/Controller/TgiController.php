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
 * TgiController
 */
class TgiController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * tgiRepository
     * 
     * @var \T3Dev\Andprmembers\Domain\Repository\TgiRepository
     */
    protected $tgiRepository = null;

    /**
     * @param \T3Dev\Andprmembers\Domain\Repository\TgiRepository $tgiRepository
     */
    public function injectTgiRepository(\T3Dev\Andprmembers\Domain\Repository\TgiRepository $tgiRepository)
    {
        $this->tgiRepository = $tgiRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $tgis = $this->tgiRepository->findAll();
        $this->view->assign('tgis', $tgis);
    }

    /**
     * action show
     * 
     * @param \T3Dev\Andprmembers\Domain\Model\Tgi $tgi
     * @return void
     */
    public function showAction(\T3Dev\Andprmembers\Domain\Model\Tgi $tgi)
    {
        $this->view->assign('tgi', $tgi);
    }
}
