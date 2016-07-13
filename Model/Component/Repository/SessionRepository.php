<?php

namespace Rz\UserSecurityBundle\Model\Component\Repository;

class SessionRepository extends BaseRepository implements RepositoryInterface
{
    /**
     *
     * @access public
     * @param  string                                       $ipAddress
     * @param  string                                       $timeLimit
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit)
    {
        $qb = $this->createSelectQuery(array('s'));

        $params = array('1' => $ipAddress, '2' => $timeLimit);

        $qb
            ->where(
                $qb->expr()->andx(
                    $qb->expr()->eq('s.ipAddress', '?1'),
                    $qb->expr()->gt('s.loginAttemptDate', '?2')
                )
            )
        ;

        return $this->gateway->findSessions($qb, $params);
    }
}
