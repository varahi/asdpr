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
 * LocationController
 */
class LocationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * locationRepository
     *
     * @var \T3Dev\Andprmembers\Domain\Repository\LocationRepository
     */
    protected $locationRepository = null;

    /**
     * @param \T3Dev\Andprmembers\Domain\Repository\LocationRepository $locationRepository
     */
    public function injectLocationRepository(\T3Dev\Andprmembers\Domain\Repository\LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $locations = $this->locationRepository->findAll();
        $this->view->assign('locations', $locations);
    }

    /**
     * action show
     *
     * @param \T3Dev\Andprmembers\Domain\Model\Location $location
     * @return void
     */
    public function showAction(\T3Dev\Andprmembers\Domain\Model\Location $location)
    {
        $this->view->assign('location', $location);
    }
}
