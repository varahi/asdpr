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
class SendEmailCommandController extends AbstractCommand
{


    /**
     * Configure the command by defining the name, options and arguments
     */
    public function configure()
    {
        $this->setDescription('Send email to all members on the first of January asking to member to pay the fees');
        $this->setHelp('All member who pay between 15/02 turn in "à jour", all member who didn\'t pay before 15/02will receive an email asking them to pay the fee again.');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->initializeCommand();
        $this->initTSFE();
        $config = $this->getConfiguration();

        $mailTemplate = 'CommandController/MailToUserNotification';
        $settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_andprmembers.']['settings.'];
        $sender = $settings['infoEmailAddresses.']['senderEmailAddress'];
        $subject = LocalizationUtility::translate('tx_andprmembers.subject_send_info_email', 'andprmembers');
        $fileName = '';

        $contributionLateId = $settings['users.']['contributionLateId'];
        $users = $this->userRepository->findByContribution($contributionLateId);
        $mailUtility = GeneralUtility::makeInstance(\T3Dev\Andprmembers\Utility\MailUtility::class);

        // Current date time object
        $current = date('d/m/Y');
        $datetime = new \DateTime();
        $currentDayMonth = $datetime->createFromFormat('d/m/Y', $current);

        // Date time object of the deadline / default value is 15/02/2021
        $deadlinePayTimeOne = $config['deadlinePayTimeOne'];
        $deadlinePayTimeTwo = $config['deadlinePayTimeTwo'];
        $deadlinePayDate = \DateTime::createFromFormat('d/m/Y', $deadlinePayTimeOne);

        if ($users) {
            if ($currentDayMonth <= $deadlinePayDate) {
                foreach ($users as $user) {
                    if ($user->getEmail()) {
                        $receiver = $user->getEmail();
                    } else {
                        $receiver = $settings['infoEmailAddresses.']['toEmailAddress'];
                    }
                    $variables = array('firstName' => $user->getFirstName(), 'lastName' => $user->getLastName(), 'deadlinePayTimeTwo' => $deadlinePayTimeTwo);
                    $mailUtility->sendEmail($mailTemplate, $receiver, $sender, $subject, $variables, $fileName);
                }
            }
        }

        return 0; // everything fine
    }
}
