<?php
defined('TYPO3_MODE') or die();

// Additional fields for page
$GLOBALS['TCA']['pages']['columns'] += array(

    'page_title' => array(
        'label' => 'LLL:EXT:tmpl/Resources/Private/Language/locallang_db.xlf:page.page_title',
        'exclude' => 1,
        'config' => array (
            'type' => 'input',
            'size' => 40,
            'eval' => 'trim'
        )
    ),

    'page_description' => array(
        'label' => 'LLL:EXT:tmpl/Resources/Private/Language/locallang_db.xlf:page.page_description',
        'exclude' => 1,
        'config' => array (
            'type' => 'text',
            'cols' => 40,
            'rows' => 3,
            'eval' => 'trim'
        )
    ),

);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes (
    'pages', 'page_title', '1', 'after:description'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes (
    'pages', 'page_description', '1', 'after:page_title'
);