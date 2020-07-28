<?php
//declare(strict_types=1);

namespace T3Dev\Andprmembers\Command;

use Symfony\Component\Console\Command\Command;
use T3Dev\Andprmembers\Utility\ObjectUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use T3Dev\Andprmembers\Domain\Repository\UserRepository;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class AbstractImportCommand
 */
abstract class AbstractCommand extends Command
{

    /**
     * userRepository
     *
     * @var \T3Dev\Andprmembers\Domain\Repository\UserRepository
     */
    protected $userRepository = null;

    /**
     * PersistenceManager
     *
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     */
    protected $persistenceManager;

    /**
     * Initialize the controller.
     */
    protected function initializeCommand()
    {
        $this->userRepository = ObjectUtility::getObjectManager()->get(UserRepository::class);
        $this->persistenceManager = ObjectUtility::getObjectManager()->get(PersistenceManager::class);

        $configurationManager = ObjectUtility::getConfigurationManager(BackendConfigurationManager::class);
        $this->configuration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT, 'andprmembers');
    }

    /**
     * Build config array (get from $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['inkluviva_icd10'])
     * if empty then set default values for configuration
     *
     * @return array Configuration
     */
    protected function getConfiguration()
    {
        if (empty($this->configuration)) {
            $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['andprmembers'];
            if (is_string($configuration)) {
                $configuration = unserialize($configuration);
            }
            // set default values if no global conf found
            if (empty($configuration)) {
                $configuration = array(
                    'userPid' => 0,
                    'receiver' => 'reciever@asdpr.dyndns.org',
                    'sender' => 'sender@asdpr.dyndns.org',
                    'deadlinePayTimeOne' => '15/02',
                    'deadlinePayTimeTwo' => '28/02'
                );
            }
            $this->configuration = $configuration;
        }
        return $this->configuration;
    }

    /**
     * Initializes a TypoScript Frontend necessary for using TypoScript and TypoLink functions
     *
     * @param int $id
     * @param int $typeNum
     */
    protected function initTSFE($id = 1, $typeNum = 0)
    {
        \TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
        if (!is_object($GLOBALS['TT'])) {
            $GLOBALS['TT'] = new \TYPO3\CMS\Core\TimeTracker\TimeTracker;
            $GLOBALS['TT']->start();
        }

        $GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $id, $typeNum);
        $GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $GLOBALS['TSFE']->sys_page->init(true);
        $GLOBALS['TSFE']->connectToDB();
        $GLOBALS['TSFE']->initFEuser();
        $GLOBALS['TSFE']->determineId();
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->rootLine = $GLOBALS['TSFE']->sys_page->getRootLine($id, '');
        $GLOBALS['TSFE']->getConfigArray();

        //\STZ\Wta\Utility\LocalizationUtility::resetExtensionLangCache('wta');
        //$GLOBALS['BE_USER']->uc['lang'] = 'fr';
    }
}
