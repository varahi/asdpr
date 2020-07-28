<?php

namespace T3Dev\Andprmembers\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DeleteUserCommandController extends AbstractCommand
{

    /**
     * Configure the command by defining the name, options and arguments
     */
    public function configure()
    {
        $this->setDescription('If user don\'t pay until 28/02, we remove them');
        $this->setHelp('If they don\'t pay until 28/02, we remove them');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initializeCommand();
        $this->getConfiguration();
        $this->initTSFE();

        // Variables for email to admin
        $mailTemplate = 'CommandController/MailToAdminDeleteUsers';
        $settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_andprmembers.']['settings.'];
        $sender = $settings['infoEmailAddresses.']['senderEmailAddress'];
        $receiver = $settings['infoEmailAddresses.']['toEmailAddress'];
        $subject = LocalizationUtility::translate('tx_andprmembers.subject_send_info_email', 'andprmembers');
        $fileName = '';

        $settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_andprmembers.']['settings.'];
        $contributionLateId = $settings['users.']['contributionLateId'];
        $users = $this->userRepository->findByContribution($contributionLateId);
        $variables = array('users' => $users);

        // Make instanse for send mail
        $mailUtility = GeneralUtility::makeInstance(\T3Dev\Andprmembers\Utility\MailUtility::class);

        if ($users) {
            foreach ($users as $user) {
                $this->userRepository->remove($user);
            }
            $this->persistenceManager->persistAll();
        }
        
        $mailUtility->sendEmail($mailTemplate, $receiver, $sender, $subject, $variables, $fileName);
        return 0; // everything fine
    }
}
