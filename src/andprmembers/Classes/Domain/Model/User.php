<?php
namespace T3Dev\Andprmembers\Domain\Model;


/***
 *
 * This file is part of the "andprmembers" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Dmitry Vasilev <dmitry@t3dev.ru>
 *
 ***/
/**
 * User
 */
class User extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{

    /**
     * firstName
     * 
     * @var string
     */
    protected $firstName = '';

    /**
     * lastName
     * 
     * @var string
     */
    protected $lastName = '';

    /**
     * email
     * 
     * @var string
     */
    protected $email = '';

    /**
     * note
     * 
     * @var string
     */
    protected $note = '';

    /**
     * contribution
     * 
     * @var string
     */
    protected $contribution = '';

    /**
     * tgi
     * 
     * @var \T3Dev\Andprmembers\Domain\Model\Location
     */
    protected $tgi = null;

    /**
     * appeal
     * 
     * @var \T3Dev\Andprmembers\Domain\Model\Location
     */
    protected $appeal = null;

    /**
     * Returns the firstName
     * 
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the firstName
     * 
     * @param string $firstName
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns the lastName
     * 
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the lastName
     * 
     * @param string $lastName
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the note
     * 
     * @return string $note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Sets the note
     * 
     * @param string $note
     * @return void
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * Returns the contribution
     * 
     * @return string $contribution
     */
    public function getContribution()
    {
        return $this->contribution;
    }

    /**
     * Sets the contribution
     * 
     * @param string $contribution
     * @return void
     */
    public function setContribution($contribution)
    {
        $this->contribution = $contribution;
    }

    /**
     * Returns the tgi
     * 
     * @return \T3Dev\Andprmembers\Domain\Model\Location tgi
     */
    public function getTgi()
    {
        return $this->tgi;
    }

    /**
     * Sets the tgi
     * 
     * @param \T3Dev\Andprmembers\Domain\Model\Location $tgi
     * @return void
     */
    public function setTgi(\T3Dev\Andprmembers\Domain\Model\Location $tgi)
    {
        $this->tgi = $tgi;
    }

    /**
     * Returns the appeal
     * 
     * @return \T3Dev\Andprmembers\Domain\Model\Location appeal
     */
    public function getAppeal()
    {
        return $this->appeal;
    }

    /**
     * Sets the appeal
     * 
     * @param \T3Dev\Andprmembers\Domain\Model\Location $appeal
     * @return void
     */
    public function setAppeal(\T3Dev\Andprmembers\Domain\Model\Location $appeal)
    {
        $this->appeal = $appeal;
    }
}
