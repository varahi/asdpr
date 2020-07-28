<?php
namespace T3Dev\Andprmembers\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager;


class MailUtility implements SingletonInterface
{

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Initialize the controller.
     */
    protected function initialize()
    {
        $this->objectManager = ObjectUtility::getObjectManager()->get(ObjectManager::class);
        $this->configurationManager = ObjectUtility::getConfigurationManager(BackendConfigurationManager::class);
    }


    /**
     * Generate and send Email
     *
     * @param \string Template file in Templates/Email/
     * @param \array $receiver Combination of Email => Name
     * @param \array $receiverCc Combination of Email => Name
     * @param \array $receiverBcc Combination of Email => Name
     * @param \array $sender Combination of Email => Name
     * @param \string $subject Mail subject
     * @param \array $variables Variables for assignMultiple
     * @param \string $message
     * @param \string $fileName
     * @return \bool Mail was sent?
     */
    public function sendEmail($template, $receiver, $sender, $subject, $variables = array(), $fileName)
    {
        $this->initialize();

        /** @var StandaloneView $view */
        $emailBodyObject = $this->objectManager->get(StandaloneView::class);
        $emailBodyObject->setTemplatePathAndFilename($this->getTemplatePath('Email/' . $template . '.html'));
        $emailBodyObject->setLayoutRootPaths(array(
            'default' => ExtensionManagementUtility::extPath('andprmembers') . 'Resources/Private/Layouts',
            'specific' => 'fileadmin/template/extensions/andprmembers/Layouts'
        ));
        $emailBodyObject->setPartialRootPaths(array(
            'default' => ExtensionManagementUtility::extPath('andprmembers') . 'Resources/Private/Partials',
            'specific' => 'fileadmin/template/extensions/andprmembers/Partials'
        ));
        $emailBodyObject->assignMultiple($variables);

        $email = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $email
            ->setTo($receiver)
            //->setCc($additionalReciever)
            //->setBcc($receiverBcc)
            ->setFrom($sender)
            ->setSubject($subject)
            ->setCharset($GLOBALS['TSFE']->metaCharset)
            ->setBody($emailBodyObject->render(), 'text/html');

        if ($fileName) {
            $localFilePath = PATH_site . $fileName;
            $email->attach(\Swift_Attachment::fromPath($localFilePath));
        }

        $email->send();
        return $email->isSent();
    }

    /**
     * Return path and message for a file
     * 		respect *RootPaths and *RootPath
     *
     * @param string $relativePathAndmessage e.g. Email/Name.html
     * @return string
     */
    private function getTemplatePath($relativePathAndFilename)
    {
        $this->initialize();

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        if (!empty($extbaseFrameworkConfiguration['view']['templateRootPaths'])) {
            foreach ($extbaseFrameworkConfiguration['view']['templateRootPaths'] as $path) {
                $absolutePath = GeneralUtility::getFileAbsFileName($path);
                if (file_exists($absolutePath . $relativePathAndFilename)) {
                    $absolutePathAndFilename = $absolutePath . $relativePathAndFilename;
                }
            }
        }
        if (empty($absolutePathAndFilename)) {
            $absolutePathAndFilename = GeneralUtility::getFileAbsFileName(
                'EXT:andprmembers/Resources/Private/Templates/' . $relativePathAndFilename
            );
        }
        return $absolutePathAndFilename;
    }

}
