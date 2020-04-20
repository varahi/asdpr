<?php
namespace T3Dev\Tmpl\Domain\Model;

class NewsDefault extends \GeorgRinger\News\Domain\Model\News
{

    /**
     * displayDate
     *
     * @var \DateTime
     */
    protected $displayDate = null;

    /**
     * Returns the displayDate
     *
     * @return \DateTime $displayDate
     */
    public function getDisplayDate()
    {
        return $this->displayDate;
    }

    /**
     * Sets the displayDate
     *
     * @param \DateTime $displayDate
     * @return void
     */
    public function setDisplayDate(\DateTime $displayDate)
    {
        $this->displayDate = $displayDate;
    }

}
