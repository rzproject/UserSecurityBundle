<?php

namespace Rz\UserSecurityBundle\Model\Component\Repository;

use Doctrine\ORM\QueryBuilder;
use Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface;
use Rz\UserSecurityBundle\Model\FrontModel\ModelInterface;

abstract class BaseRepository
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
     * @access public
     * @param \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
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
    public function createCountQuery($column = null, Array $aliases = null)
    {
        return $this->gateway->createCountQuery($column, $aliases);
    }

    /**
     *
     * @access public
     * @param  Array                                        $aliases = null
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function createSelectQuery(Array $aliases = null)
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
}
