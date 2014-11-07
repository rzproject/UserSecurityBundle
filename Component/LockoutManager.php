<?php

namespace Rz\UserSecurityBundle\Component;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Rz\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker;

class LockoutManager
{
	protected $requestStack;
	protected $loginFailureTracker;
	protected $forceAccountRecovery;
	protected $blockPages;
	
    public function __construct(RequestStack $requestStack, Session $session, LoginFailureTracker $loginFailureTracker, $forceAccountRecovery, $blockPages)
    {
		$this->requestStack          = $requestStack;
		$this->session               = $session;
		$this->loginFailureTracker   = $loginFailureTracker;
		$this->forceAccountRecovery  = $forceAccountRecovery;
		$this->blockPages            = $blockPages;
    }

    public function getLockoutSessionInfo()
    {
		$session = $this->getSessionInfo();
		if ($session && $session['defered']) {
			if ($this->session->has(SecurityContext::AUTHENTICATION_ERROR)) {
				$this->session->remove(SecurityContext::AUTHENTICATION_ERROR);
			}
			return $session['interval'];
		}
		return null;
    }
    
    public function getLockoutAttemptRemaining()
    {
		$session = $this->getSessionInfo();
		if ($session && ($session['remaining_attempts'] > 0)) {
			return (int)$session['remaining_attempts'];
		}
		return null;
	}
	
	protected function getSessionInfo()
	{
		if (($this->forceAccountRecovery['enabled'] || $this->blockPages['enabled'])) {
			$request = $this->requestStack->getMasterRequest();
			$ipAddress = $request->getClientIp();


            if ($this->blockPages['enabled']) {
                // Get number of failed login attempts.
                $durationInMinutes = (int) $this->blockPages['duration_in_minutes'];
                $attempts = $this->loginFailureTracker->getAttempts($ipAddress, $this->blockPages['duration_in_minutes']);
                $maxAttempts = (int) $this->blockPages['after_attempts'];
                $interval = null;
                $defered  = false;

                if (count($attempts) >= $this->blockPages['after_attempts']) {
                    $dateFirstAttempt = new \DateTime($attempts[0]->getLoginAttemptDate()->format('Y-m-d H:i:s'));
                    $dateFirstAttempt->add(date_interval_create_from_date_string(sprintf('%s minutes',$durationInMinutes)));
                    $dateNow          = new \DateTime();
                    $interval         = $dateFirstAttempt->diff($dateNow);
                    $defered          = true;
                }
                $remainingAttempt = ($maxAttempts - count($attempts));
                return array(
                    'defered'           => $defered,
                    'attempts'          => $attempts,
                    'remaining_attempts'=> $remainingAttempt,
                    'interval'          => $interval
                );
            }


			if ($this->forceAccountRecovery['enabled']) {
				$durationInMinutes = (int) $this->forceAccountRecovery['duration_in_minutes'];
				$attempts = $this->loginFailureTracker->getAttempts($ipAddress, $durationInMinutes);
				$maxAttempts = (int) $this->forceAccountRecovery['after_attempts'];
				$interval = null;
				$defered  = false;
				if (count($attempts) >= $this->forceAccountRecovery['after_attempts']) {
					$dateFirstAttempt = new \DateTime($attempts[0]->getLoginAttemptDate()->format('Y-m-d H:i:s'));
					$dateFirstAttempt->add(date_interval_create_from_date_string(sprintf('%s minutes',$durationInMinutes)));
					$dateNow          = new \DateTime();
					$interval         = $dateFirstAttempt->diff($dateNow);
					$defered          = true;
				}
				$remainingAttempt = ($maxAttempts - count($attempts));
				return array(
					'defered'           => $defered,
					'attempts'          => $attempts,
					'remaining_attempts'=> $remainingAttempt,
					'interval'          => $interval
				);
			}
		}
		return null;
	}

}
