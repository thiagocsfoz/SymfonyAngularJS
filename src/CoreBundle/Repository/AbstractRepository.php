<?php

namespace CoreBundle\Repository;
use CoreBundle\Entity\AbstractEntity;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Entity\Paging\PageRequest;
use CoreBundle\Entity\Paging\Page;

/**
 * Class AbstractRepository
 * @package Operadores\Bundle\CoreBundle\Repository
 */
abstract class AbstractRepository extends EntityRepository implements IRepository
{
    public function getContainer()
    {var_dump("teste"); exit;
        global $kernel;
        return $kernel->getContainer();
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function insert( AbstractEntity $entity )
    {
        $this->getEntityManager()->persist( $entity );
        $this->getEntityManager()->flush();
        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @return AbstractEntity|object
     */
    public function update( AbstractEntity $entity )
    {
        $entity = $this->getEntityManager()->merge( $entity );
        $this->getEntityManager()->flush();
        return $entity;
    }

    /**
     * @param $id
     * @return null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Exception
     */
    public function remove( $id )
    {
        //FIXME Verificar se retorna null ou estoura expcetion
        $entity= $this->getEntityManager()->find( $this->getClassName(), $id );
        if ( $entity == null )
        {
            throw new \Exception( 'O identificador '.$id.' não foi encontrado para a entidade '.$this->getClassName(), 404 );
        }
        $this->getEntityManager()->remove( $entity );
        $this->getEntityManager()->flush();
        return $entity;
    }

    /**
     * @param $id
     * @return null|object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Exception
     */
    public function findById( $id )
    {
        //FIXME Verificar se retorna null ou estoura expcetion
        $entity = $this->getEntityManager()->find( $this->getClassName(), $id );
        if ( $entity == null )
        {
            throw new \Exception( 'O identificador '.$id.' não foi encontrado para a entidade '.$this->getClassName(), 404 );
        }
        return $entity;
    }

    /**
     * @return array
     */
    public function listAll()
    {
        //FIXME Verificar se retorna null ou estoura expcetion
        $statement = $this->getEntityManager()->createQueryBuilder();
        $query = $statement
            ->select( 'obj' )
            ->from($this->getClassName(), 'obj')
            ->orderBy('obj.id', 'asc');
        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param AbstractEntity|null $filters
     * @param PageRequest|null $pageRequest
     * @return mixed
     */
    public abstract function listByFilters( AbstractEntity $filters = null, PageRequest $pageRequest = null );
}