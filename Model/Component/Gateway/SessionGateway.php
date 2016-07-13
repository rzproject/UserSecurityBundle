<?php

/*
 * This file is part of the CCDNUser SecurityBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rz\UserSecurityBundle\Model\Component\Gateway;

use Doctrine\ORM\QueryBuilder;
use Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface;
use Rz\UserSecurityBundle\Model\Component\Gateway\BaseGateway;
use Rz\UserSecurityBundle\Entity\Session;

/**
 *
 * @category CCDNUser
 * @package  SecurityBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserSecurityBundle
 *
 */
class SessionGateway extends BaseGateway implements GatewayInterface
{
    /**
     *
     * @access private
     * @var string $queryAlias
     */
    private $queryAlias = 's';

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                          $qb
     * @param  Array                                               $parameters
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findSession(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->one($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findSessions(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->all($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array                      $parameters
     * @return int
     */
    public function countSessions(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createCountQuery();
        }

        if (null == $parameters) {
            $parameters = array();
        }

        $qb->setParameters($parameters);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    /**
     *
     * @access public
     * @param  string                     $column  = null
     * @param  Array                      $aliases = null
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createCountQuery($column = null, Array $aliases = null)
    {
        if (null == $column) {
            $column = 'count(' . $this->queryAlias . '.id)';
        }

        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($column);
        }

        if (! in_array($column, $aliases)) {
            $aliases = array($column) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     *
     * @access public
     * @param  Array                      $aliases = null
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createSelectQuery(Array $aliases = null)
    {
        if (null == $aliases || ! is_array($aliases)) {
            $aliases = array($this->queryAlias);
        }

        if (! in_array($this->queryAlias, $aliases)) {
            $aliases = array($this->queryAlias) + $aliases;
        }

        return $this->getQueryBuilder()->select($aliases)->from($this->entityClass, $this->queryAlias);
    }

    /**
     *
     * @access public
     * @param  \Rz\UserSecurityBundle\Entity\Session                           $session
     * @return \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface
     */
    public function persistSession(Session $session)
    {
        $this->persist($session)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Rz\UserSecurityBundle\Entity\Session                           $session
     * @return \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface
     */
    public function updateSession(Session $session)
    {
        $this->persist($session)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Rz\UserSecurityBundle\Entity\Session                           $session
     * @return \Rz\UserSecurityBundle\Model\Component\Gateway\GatewayInterface
     */
    public function deleteSession(Session $session)
    {
        $this->remove($session)->flush();

        return $this;
    }
}
