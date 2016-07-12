<?php

namespace CoreBundle\Repository;
use CoreBundle\Entity\AbstractEntity;
use CoreBundle\Entity\Paging\PageRequest;

/**
 * UsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersRepository extends AbstractRepository
{
    /**
     * @param AbstractEntity|null $filters
     * @param PageRequest|null $pageRequest
     * @return mixed
     */
    public function listByFilters(AbstractEntity $filters = null, PageRequest $pageRequest = null)
    {
        // TODO: Implement listByFilters() method.
    }
}