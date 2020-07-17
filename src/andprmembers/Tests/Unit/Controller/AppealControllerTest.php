<?php
namespace T3Dev\Andprmembers\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Dmitry Vasilev <dmitry@t3dev.ru>
 */
class AppealControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \T3Dev\Andprmembers\Controller\AppealController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\T3Dev\Andprmembers\Controller\AppealController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllAppealsFromRepositoryAndAssignsThemToView()
    {

        $allAppeals = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $appealRepository = $this->getMockBuilder(\T3Dev\Andprmembers\Domain\Repository\AppealRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $appealRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAppeals));
        $this->inject($this->subject, 'appealRepository', $appealRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('appeals', $allAppeals);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAppealToView()
    {
        $appeal = new \T3Dev\Andprmembers\Domain\Model\Appeal();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('appeal', $appeal);

        $this->subject->showAction($appeal);
    }
}
