<?php
defined('TYPO3_MODE') || die();

if (!isset($GLOBALS['TCA']['fe_users']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['fe_users']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_andprmembers_fe_users = [];
    $tempColumnstx_andprmembers_fe_users[$GLOBALS['TCA']['fe_users']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['User','Tx_Andprmembers_User']
            ],
            'default' => 'Tx_Andprmembers_User',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tempColumnstx_andprmembers_fe_users);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'fe_users',
    $GLOBALS['TCA']['fe_users']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['fe_users']['ctrl']['label']
);

$tmp_andprmembers_columns = [

    'first_name' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.first_name',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'last_name' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.last_name',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
    'email' => [
        'exclude' => true,
        'label' => 'LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user.email',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim'
        ],
    ],
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
            'foreign_table' => 'tx_andprmembers_domain_model_tgi',
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
            'foreign_table' => 'tx_andprmembers_domain_model_appeal',
            'default' => 0,
            'minitems' => 0,
            'maxitems' => 1,
        ],
        
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_andprmembers_columns);

/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['fe_users']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['fe_users']['types']['Tx_Andprmembers_User']['showitem'] = $GLOBALS['TCA']['fe_users']['types']['0']['showitem'];
} elseif(is_array($GLOBALS['TCA']['fe_users']['types'])) {
    // use first entry in types array
    $fe_users_type_definition = reset($GLOBALS['TCA']['fe_users']['types']);
    $GLOBALS['TCA']['fe_users']['types']['Tx_Andprmembers_User']['showitem'] = $fe_users_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['fe_users']['types']['Tx_Andprmembers_User']['showitem'] = '';
}
$GLOBALS['TCA']['fe_users']['types']['Tx_Andprmembers_User']['showitem'] .= ',--div--;LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_domain_model_user,';
$GLOBALS['TCA']['fe_users']['types']['Tx_Andprmembers_User']['showitem'] .= 'first_name, last_name, email, note, contribution, tgi, appeal';

$GLOBALS['TCA']['fe_users']['columns'][$GLOBALS['TCA']['fe_users']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Andprmembers_User','Tx_Andprmembers_User'];
