<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$newsColumns = [
    'display_date' => [
        'exclude' => true,
        'label' => 'LLL:EXT:tmpl/Resources/Private/Language/locallang_db.xlf:tx_tmpl_domain_model_news.display_date',
        'config' => [
            'dbType' => 'date',
            'type' => 'input',
            'renderType' => 'inputDateTime',
            'size' => 7,
            'eval' => 'date',
            'default' => null,
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tx_news_domain_model_news",$newsColumns,1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news', 'display_date', '', 'after:istopnews'
);
