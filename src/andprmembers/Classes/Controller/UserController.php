<?php
namespace T3Dev\Andprmembers\Controller;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
 * UserController
 */
class UserController extends AbstractController
{

    /**
     * userRepository
     *
     * @var \T3Dev\Andprmembers\Domain\Repository\UserRepository
     */
    protected $userRepository = null;

    /**
     * @param \T3Dev\Andprmembers\Domain\Repository\UserRepository $userRepository
     */
    public function injectUserRepository(\T3Dev\Andprmembers\Domain\Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Load JS Libraries and Code
     */
    private function loadSources()
    {

        /** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        $extRelPath = ExtensionManagementUtility::siteRelPath('andprmembers');
        $pageRenderer->addJsFile($extRelPath . "Resources/Public/Javascript/jquery.dataTables.js", 'text/javascript', false, false, '', true);
        $pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/datatables.css", 'stylesheet', 'all', '', true);
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $this->loadSources();
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);

        //$itemsPerPage = $this->settings['list']['pagibation']['itemsPerPage'];
        //$this->view->assign('itemsPerPage', $itemsPerPage);
        //\TYPO3\CMS\Core\Utility\DebugUtility::debug($settings);
    }

    /**
     * action show
     *
     * @param \T3Dev\Andprmembers\Domain\Model\User $user
     * @return void
     */
    public function showAction(\T3Dev\Andprmembers\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     *
     * @param \T3Dev\Andprmembers\Domain\Model\User $newUser
     * @return void
     */
    public function createAction(\T3Dev\Andprmembers\Domain\Model\User $newUser)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->add($newUser);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \T3Dev\Andprmembers\Domain\Model\User $user
     * @ignorevalidation $user
     * @return void
     */
    public function editAction(\T3Dev\Andprmembers\Domain\Model\User $user)
    {
        $this->view->assign('user', $user);
    }

    /**
     * action update
     *
     * @param \T3Dev\Andprmembers\Domain\Model\User $user
     * @return void
     */
    public function updateAction(\T3Dev\Andprmembers\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->update($user);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \T3Dev\Andprmembers\Domain\Model\User $user
     * @return void
     */
    public function deleteAction(\T3Dev\Andprmembers\Domain\Model\User $user)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->userRepository->remove($user);
        $this->redirect('list');
    }
}
