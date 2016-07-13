<?php

namespace Rz\UserSecurityBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 *
 * This controller is only for testing the POST request circumvention of login
 * protection and is not used during prod environment. Routes are only imported
 * during the test env for Behat under Tests/Functional/app/config
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
class TestLoginController extends ContainerAware
{
    public function circumventAction()
    {
        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->container->get('templating')->renderResponse('CCDNUserSecurityBundle::login.html.twig', array('csrf_token' => $csrfToken));
    }
}
