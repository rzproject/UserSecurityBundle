<?php



namespace Rz\UserSecurityBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\FOSUserEvents;


class LockoutController extends Controller
{
    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function showMessageAction()
    {

        $lockoutManager = $this->container->get('rz_user_security.lockout_session.manager');

        if ($interval = $lockoutManager->getLockoutSessionInfo()) {
            $id = sprintf("lockout-id-%s",md5(microtime()));
            return $this->render($this->container->getParameter('rz_user_security.component.listener.blocking_login_listener.template'),
                array(
                    'id'           => $id,
                    'interval'     => $interval,
                    'show_counter' => true
                )
            );

        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'), 301);
        }
    }
}
