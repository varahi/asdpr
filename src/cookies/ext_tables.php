<?php
defined('TYPO3_MODE') or die();

// TypoScript
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Cookie Control');

// Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Main',
    'Cookies'
);
$TCA['tt_content']['types']['list']['subtypes_addlist']['cookies_main'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('cookies_main', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');
// remove some fields from the plugin
$TCA['tt_content']['types']['list']['subtypes_excludelist']['cookies_main'] = 'layout,select_key,pages,recursive';