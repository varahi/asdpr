<?php
defined('TYPO3_MODE') || die();

$languageFile = 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:';

$tmp_andprmembers_columns = [

    'note' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.note',
        'config' => [
            'type' => 'text',
            'cols' => 40,
            'rows' => 5,
            'eval' => 'trim'
        ]
    ],

    'contribution' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.contribution',
        'config' => [
            //'type' => 'radio',
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [$languageFile . 'tx_andprmembers.contribution_uptodate', '1'],
                [$languageFile . 'tx_andprmembers.contribution_late', '2']
            ],
        ]
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

    'pay_date' => [
        'exclude' => true,
        'label' => $languageFile . 'tx_andprmembers.pay_date',
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

$fields = 'note, contribution, tgi, appeal';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_andprmembers_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    '--div--;LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers.additional_fields, ' . $fields
);
