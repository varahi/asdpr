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
abstract class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * Helper function to use localized strings
     *
     * @param string $key locallang key
     * @param string $default the default message to show if key was not found
     * @return string
     */
    protected function translate($key, $defaultMessage = '') {
        $message = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, $this->extensionName);
        if($message === NULL) {
            $message = $defaultMessage;
        }
        return $message;
    }

}