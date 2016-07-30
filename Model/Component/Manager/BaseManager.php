<?php

namespace Rz\UserSecurityBundle\Model\Component\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Persistence\ManagerRegistry;
use Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface;
use Rz\UserSecurityBundle\Model\FrontModel\ModelInterface;
use Sonata\CoreBundle\Model\BaseEntityManager;

abstract class BaseManager extends BaseEntityManager
{
    /**
     *
     * @access protected
     * @var \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface $gateway
     */
    protected $gateway;

    /**
     *
     * @access protected
     * @var \Rz\UserSecurityBundle\Model\FrontModel\ModelInterface $model
     */
    protected $model;

    /**
     *
     * @access protected
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface  $dispatcher
     */
    protected $dispatcher;

    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface       $dispatcher
     * @param \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface $gateway
     */
    public function __construct($class, ManagerRegistry $registry, EventDispatcherInterface $dispatcher, GatewayInterface $gateway)
    {
        parent::__construct($class, $registry);
        $this->dispatcher = $dispatcher;
        $this->gateway = $gateway;
    }

    /**
     *
     * @access public
     * @param  \Rz\UserSecurityBundle\Model\FrontModel\ModelInterface                $model
     * @return \Rz\UserSecurityBundle\Model\Component\Repository\RepositoryInterface
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface
     */
    public function getGateway()
    {
        return $this->gateway;
    }

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->gateway->getQueryBuilder();
    }

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createCountQuery($column = null, array $aliases = null)
    {
        return $this->gateway->createCountQuery($column, $aliases);
    }

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(array $aliases = null)
    {
        return $this->gateway->createSelectQuery($aliases);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb)
    {
        return $this->gateway->one($qb);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function all(QueryBuilder $qb)
    {
        return $this->gateway->all($qb);
    }

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function persist($entity)
    {
        $this->gateway->persist($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function remove($entity)
    {
        $this->gateway->remove($entity);

        return $this;
    }

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function flush()
    {
        $this->gateway->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function refresh($entity)
    {
        $this->gateway->refresh($entity);

        return $this;
    }
}
