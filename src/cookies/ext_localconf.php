<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'SBTheke.' . $_EXTKEY,
    'Main',
    array(
        'Main' => 'cookie, cookieCached, submit',
    ),
    // non-cacheable actions
    array(
        'Main' => 'cookie, submit',
    )
);