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
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('SonataUserBundle:Profile:show.html.twig', array(
            'user'   => $user,
            'blocks' => $this->container->getParameter('sonata.user.configuration.profile_blocks')
        ));
    }
}
