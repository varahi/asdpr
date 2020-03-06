<?php
/***************************************************************
 *  Copyright notice
*
*  (c) 2018 Sven Burkert <bedienung@sbtheke.de>, SBTheke web development
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

namespace SBTheke\Cookies\Utility;

class Cookies {

    /**
     * Delete all cookies
     *
     * @return void
     */
    public static function deleteAll() {
        if(isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $_SERVER['HTTP_COOKIE']);
            $domain = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST');
            $domainParts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('.', $domain);
            foreach($cookies as $cookie) {
                $parts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('=', $cookie);
                $name = trim($parts[0]);
                $domainTmp = $domain;
                setcookie($name, false, time() - (60 * 60 * 24 * 365));
                setcookie($name, false, time() - (60 * 60 * 24 * 365), '/');
                for($i = 0; $i <= count($domainParts) - 2; $i++) {
                    setcookie($name, false, time() - (60 * 60 * 24 * 365), '/', $domainTmp);
                    $domainTmp = ltrim(ltrim($domainTmp, '.'), $domainParts[$i]); // remove leading subdomain
                }
            }
        }
    }

}