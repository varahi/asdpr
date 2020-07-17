<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'T3Dev.Andprmembers',
            'Andprmembers',
            [
                'User' => 'list, show, new, create, edit, update, delete',
                'Location' => 'list, show'
            ],
            // non-cacheable actions
            [
                'User' => 'create, update, delete',
                'Location' => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        andprmembers {
                            iconIdentifier = andprmembers-plugin-andprmembers
                            title = LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_andprmembers.name
                            description = LLL:EXT:andprmembers/Resources/Private/Language/locallang_db.xlf:tx_andprmembers_andprmembers.description
                            tt_content_defValues {
                                CType = list
                                list_type = andprmembers_andprmembers
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'andprmembers-plugin-andprmembers',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:andprmembers/Resources/Public/Icons/user_plugin_andprmembers.svg']
			);
		
    }
);
