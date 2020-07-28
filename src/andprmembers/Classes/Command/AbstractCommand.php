<?php
//declare(strict_types=1);

namespace T3Dev\Andprmembers\Command;

use Symfony\Component\Console\Command\Command;
use T3Dev\Andprmembers\Utility\ObjectUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use T3Dev\Andprmembers\Domain\Repository\UserRepository;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
     * Initialize the controller.
     */
    protected function initializeCommand()
    {
        $this->userRepository = ObjectUtility::getObjectManager()->get(UserRepository::class);
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
                );
            }
            $this->configuration = $configuration;
        }
        return $this->configuration;
    }

}
