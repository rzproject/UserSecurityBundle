<?php



namespace Rz\UserSecurityBundle\Component\Authentication\Tracker;

use CCDNUser\SecurityBundle\Model\FrontModel\SessionModel;
use CCDNUser\SecurityBundle\Component\Authentication\Tracker\LoginFailureTracker as BaseLoginFailureTracker;

class LoginFailureTracker extends BaseLoginFailureTracker
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
        //$timeLimit = new \DateTime('-' . $blockingPeriod . ' minutes');
        //From Andrew Aculana
        $timeLimit = new \DateTime();
        $timeLimit->sub(date_interval_create_from_date_string(sprintf('%s minutes', $blockingPeriod)));
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
