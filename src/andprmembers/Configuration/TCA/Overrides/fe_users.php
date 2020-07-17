<?php
defined('TYPO3_MODE') || die();

$tmp_andprmembers_columns = [

    'note' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.note',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        ]
    ],
    'contribution' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.contribution',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'tgi' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.tgi',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_andprmembers_domain_model_location',
            'default' => 0,
            'minitems' => 0,
            'maxitems' => 1,
        ],

    ],
    'appeal' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.appeal',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_andprmembers_domain_model_location',
            'default' => 0,
            'minitems' => 0,
            'maxitems' => 1,
        ],

    ],

];

$fields = 'note, contribution, tgi, appeal';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_andprmembers_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers.additional_fields, ' . $fields
);

