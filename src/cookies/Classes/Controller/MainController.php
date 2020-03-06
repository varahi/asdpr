<?php
/***************************************************************
 *  Copyright notice
*
*  (c) 2016 Sven Burkert <bedienung@sbtheke.de>, SBTheke web development
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

namespace SBTheke\Cookies\Controller;

/**
 * @package cookies
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class MainController extends AbstractController {

    /**
     * action cookie: display info to accept cookies
     *
     * @return void
     */
    public function cookieAction() {
        if($_COOKIE['tx_cookies_accepted'] && !$this->settings['showPermanent']) {
            return FALSE;
        }
        $this->view->assign('accepted', array_key_exists('tx_cookies_accepted', $_COOKIE) ? 1 : 0);
        $this->view->assign('disabled', array_key_exists('tx_cookies_disabled', $_COOKIE) ? 1 : 0);
        $this->view->assign('acceptedOrDisabled', ($_COOKIE['tx_cookies_accepted'] || $_COOKIE['tx_cookies_disabled']) ? 1 : 0);
    }

    /**
     * action cookie (cached): display info to accept cookies
     *
     * @return void
     */
    public function cookieCachedAction() {
    }

    /**
     * action submit: process user selection
     *
     * @param boolean $accept
     * @param boolean $disable
     * @return void
     */
    public function submitAction($accept = NULL, $disable = NULL) {
        if($disable !== NULL) {
            if($disable) {
                \SBTheke\Cookies\Utility\Cookies::deleteAll();
                setcookie('tx_cookies_disabled', 1, time() + (60*60*24*$this->settings['expire']), '/');
                $this->addFlashMessage(
                    $this->translate('flashmessage.disabled'),
                    $this->translate('flashmessage.disabled.title'),
                    \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
                );
            } else {
                setcookie('tx_cookies_disabled', FALSE, time() - (60*60*24*$this->settings['expire']), '/');
                $this->addFlashMessage(
                    $this->translate('flashmessage.enabled'),
                    $this->translate('flashmessage.enabled.title'),
                    \TYPO3\CMS\Core\Messaging\AbstractMessage::OK
                );
            }
        }
        if($accept !== NULL) {
            if($accept) {
                setcookie('tx_cookies_accepted', 1, time() + (60*60*24*$this->settings['expire']), '/');
            } else {
                setcookie('tx_cookies_accepted', FALSE, time() - (60*60*24*$this->settings['expire']), '/');
            }
        }
        $this->redirect('cookie');
    }

}