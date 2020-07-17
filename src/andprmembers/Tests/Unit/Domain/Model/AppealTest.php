<?php
namespace T3Dev\Andprmembers\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Dmitry Vasilev <dmitry@t3dev.ru>
 */
class AppealTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \T3Dev\Andprmembers\Domain\Model\Appeal
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \T3Dev\Andprmembers\Domain\Model\Appeal();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }
}
