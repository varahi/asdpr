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

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_andprmembers_domain_model_location', 'EXT:andprmembers/Resources/Private/Language/locallang_csh_tx_andprmembers_domain_model_location.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_andprmembers_domain_model_location');

    }
);
