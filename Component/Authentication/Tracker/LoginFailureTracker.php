<?php

namespace Rz\UserSecurityBundle\Component\Authentication\Tracker;

use Rz\UserSecurityBundle\Model\FrontModel\SessionModel;

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
class LoginFailureTracker
{
    /**
     *
     * @access protected
     * @var \CCDNUser\SecurityBundle\Model\FrontModel\SessionModel $sessionModel
     */
    protected $sessionModel;

    /**
     *
     * @access public
     * @param \CCDNUser\SecurityBundle\Model\FrontModel\SessionModel $sessionModel
     */
    public function __construct(SessionModel $sessionModel)
    {
        $this->sessionModel = $sessionModel;
    }

    /**
     *
     * @access public
     * @param  string $ipAddress
     * @param  int    $blockingPeriod
     * @return array
     */
    public function getAttempts($ipAddress, $blockingPeriod)
    {
        // Set a limit on how far back we want to look at failed login attempts.
        $timeLimit = new \DateTime('-' . $blockingPeriod . ' minutes');
        $attempts = $this->sessionModel->findAllByIpAddressAndLoginAttemptDate($ipAddress, $timeLimit);

        return $attempts;
    }

    /**
     *
     * @access public
     * @param string $ipAddress
     * @param string $username
     */
    public function addAttempt($ipAddress, $username)
    {
        // Make a note of the failed login.
        $this->sessionModel->newRecord($ipAddress, $username);
    }
}
