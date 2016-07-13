<?php

namespace Rz\UserSecurityBundle\Model\FrontModel;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface;
use Rz\UserSecurityBundle\Model\Component\Repository\RepositoryInterface;

interface ModelInterface
{
    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface             $dispatcher
     * @param \Rz\UserSecurityBundle\Model\Component\Repository\RepositoryInterface $repository
     * @param \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface       $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RepositoryInterface $repository, ManagerInterface $manager);

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Model\Component\Repository\RepositoryInterface
     */
    public function getRepository();

    /**
     *
     * @access public
     * @return \Rz\UserSecurityBundle\Model\Component\Manager\ManagerInterface
     */
    public function getManager();
}
