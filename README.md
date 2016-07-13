UserSecurityBundle
==================

#### Fork of CCDNUserSecurityBundle:

* Version >= 2.0 will no longer require CCDNUserSecurityBundle
 
#### FROM CCDNUserSecurityBundle

This bundle is for the symfony framework and requires Symfony ~2.4 and PHP >=5.3.2

This project uses Doctrine >=2.1 and so does not require any specific database. 

## Description:

Use this bundle to mitigate brute force dictionary attacks on your sites. Excessive failed logins will force users to recover their account, additional attempts
to circumvent that will block the user from specified webpages by returning an HTTP 500 response on all specified routes.

### You can use this bundle with any User Bundle you like.

> This bundle does *NOT*  provide user registration/login/logout etc features. This bundle is for brute force dictionary attack mitigation only. Use this bundle in conjunction with your preferred user bundle.

## Features.

SecurityBundle Provides the following features:

1. Prevent brute force attacks being carried out by limiting number of login attempts:
	1. When first limit is reached, redirect to an account recovery page.
	2. When secondary limit is reached, return an HTTP 500 status to block login pages etc.
3. All limits are configurable.
4. Routes to block are configurable.
5. Route for account recovery page is configurable.
6. Decoupled from UserBundle specifics. You can use this with any user bundle you like.
6. Redirect user to last page they were on upon successful login.
7. Redirect user to last page they were on upon successful logout.

## Documentation.

Documentation can be found in the `Resources/doc/index.md` file in this bundle:

[Read the Documentation](http://github.com/rzproject/UserSecurityBundle/blob/2.0.0/Resources/doc/index.md).

## Installation.

All the installation instructions are located in [documentation](http://github.com/rzproject/UserSecurityBundle/blob/2.0.0/Resources/doc/install.md).

## License.

This software is licensed under the MIT license. See the complete license file in the bundle:

	Resources/meta/LICENSE

[Read the License](http://github.com/rzproject/UserSecurityBundle/blob/2.0.0/Resources/meta/LICENSE).

## About.

[UserSecurityBundle](http://github.com/rzproject/UserSecurityBundle) is free software from [rzproject](http://rzproject.github.io). 

## Reporting an issue or feature request.

Issues and feature requests are tracked in the [Github issue tracker](http://github.com/rzproject/UserSecurityBundle/issues).

Back to: [rzproject](http://rzproject.github.io)