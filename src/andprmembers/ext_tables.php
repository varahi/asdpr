<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'T3Dev.Andprmembers',
            'Andprmembers',
            'andprmembers'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('andprmembers', 'Configuration/TypoScript', 'andprmembers');

        // Add FlexForm
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['andprmembers_andprmembers'] = 'recursive,select_key,pages';
        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['andprmembers_andprmembers'] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            'andprmembers_andprmembers',
            'FILE:EXT:andprmembers/Configuration/FlexForms/flexform_andprmembers.xml'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_andprmembers_domain_model_location', 'EXT:andprmembers/Resources/Private/Language/locallang_csh_tx_andprmembers_domain_model_location.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_andprmembers_domain_model_location');

    }
);
