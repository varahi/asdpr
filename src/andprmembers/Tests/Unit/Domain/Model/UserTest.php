<?php
namespace T3Dev\Andprmembers\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Dmitry Vasilev <dmitry@t3dev.ru>
 */
class UserTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \T3Dev\Andprmembers\Domain\Model\User
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \T3Dev\Andprmembers\Domain\Model\User();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getFirstNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameForStringSetsFirstName()
    {
        $this->subject->setFirstName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLastNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameForStringSetsLastName()
    {
        $this->subject->setLastName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNoteReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNote()
        );
    }

    /**
     * @test
     */
    public function setNoteForStringSetsNote()
    {
        $this->subject->setNote('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'note',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getContributionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getContribution()
        );
    }

    /**
     * @test
     */
    public function setContributionForStringSetsContribution()
    {
        $this->subject->setContribution('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'contribution',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTgiReturnsInitialValueForTgi()
    {
        self::assertEquals(
            null,
            $this->subject->getTgi()
        );
    }

    /**
     * @test
     */
    public function setTgiForTgiSetsTgi()
    {
        $tgiFixture = new \T3Dev\Andprmembers\Domain\Model\Tgi();
        $this->subject->setTgi($tgiFixture);

        self::assertAttributeEquals(
            $tgiFixture,
            'tgi',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAppealReturnsInitialValueForAppeal()
    {
        self::assertEquals(
            null,
            $this->subject->getAppeal()
        );
    }

    /**
     * @test
     */
    public function setAppealForAppealSetsAppeal()
    {
        $appealFixture = new \T3Dev\Andprmembers\Domain\Model\Appeal();
        $this->subject->setAppeal($appealFixture);

        self::assertAttributeEquals(
            $appealFixture,
            'appeal',
            $this->subject
        );
    }
}
