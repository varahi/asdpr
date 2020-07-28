<?php
namespace T3Dev\Andprmembers\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
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
 * The repository for Users
 */
class UserRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Initializes the repository.
     *
     * @return void
     * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
     */
    public function initializeObject()
    {
        /** @var $querySettings Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function findByFields($strFilter = '', $boolOrderingASC = true)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->logicalOr(
                $query->like('last_name', '%'.$strFilter.'%'),
                $query->like('first_name', '%'.$strFilter.'%'),
                $query->like('email', '%'.$strFilter.'%'),
                $query->like('username', '%'.$strFilter.'%'),
                $query->like('note', '%'.$strFilter.'%'),
                $query->like('uid', '%'.$strFilter.'%'),
                $query->like('tgi.name', '%'.$strFilter.'%'),
                $query->like('appeal.name', '%'.$strFilter.'%')
            )
        );

        // Ordering
        if ($boolOrderingASC) {
            $query->setOrderings(array('last_name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
                'first_name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
        } else {
            $query->setOrderings(array('last_name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
                'first_name' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
        }
        return $query->execute();
    }

}
