<?php

namespace Rz\UserSecurityBundle\Model\Component\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\QueryBuilder;
use Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface;
use Rz\UserSecurityBundle\Model\FrontModel\ModelInterface;

interface ManagerInterface
{
    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface       $dispatcher
     * @param \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface $gateway
     */
    public function __construct(EventDispatcherInterface $dispatcher, GatewayInterface $gateway);

    /**
     *
     * @access public
     * @param  \Rz\UserSecurityBundle\Model\FrontModel\ModelInterface                $model
     * @return \Rz\UserSecurityBundle\Model\Component\Repository\RepositoryInterface
     */
    public function setModel(ModelInterface $model);

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Gateway\GatewayInterface
     */
    public function getGateway();

    /**
     *
     * @access public
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder();

    /**
     *
     * @access public
     * @param  string                                       $column  = null
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createCountQuery($column = null, Array $aliases = null);

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function one(QueryBuilder $qb);

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function all(QueryBuilder $qb);

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function persist($entity);

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function remove($entity);

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function flush();

    /**
     *
     * @access public
     * @param  Object                                                            $entity
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function refresh($entity);
}
