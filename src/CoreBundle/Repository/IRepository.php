<?php
namespace CoreBundle\Repository;

use CoreBundle\Entity\AbstractEntity;
use CoreBundle\Entity\Paging\PageRequest;
use CoreBundle\Entity\Paging\Page;
/**
 * Interface IRepository
 * @package App\Bundle\CoreBundle\Repository
 */
interface IRepository
{
    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function insert( AbstractEntity $entity );

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function update( AbstractEntity $entity );

    /**
     * @param $id
     * @return mixed
     */
    public function remove( $id );
    
    /**
     * @param $id
     * @return AbstractEntity
     */
    public function findById( $id );

    /**
     * @param $filters
     * @param PageRequest $pageRequest
     * @return Page
     */
    public function listByFilters( AbstractEntity $filters = null, PageRequest $pageRequest = null );
}