<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Auth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @namespace
 */
namespace ZendTest\Auth\Adapter\Ldap;

/**
 * @category   Zend
 * @package    Zend_Auth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Auth
 */
class OfflineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Authentication adapter instance
     *
     * @var Zend_Auth_Adapter_Ldap
     */
    protected $_adapter = null;

    /**
     * Setup operations run prior to each test method:
     *
     * * Creates an instance of Zend\\Auth\\Adapter\\Ldap
     *
     * @return void
     */
    public function setUp()
    {
        $this->_adapter = new \Zend\Authentication\Adapter\Ldap();
    }

    public function testGetSetLdap()
    {
        if (!extension_loaded('ldap')) {
            $this->markTestSkipped('LDAP is not enabled');
        }
        $this->_adapter->setLdap(new \Zend\Ldap\Ldap());
        $this->assertType('Zend_Ldap', $this->_adapter->getLdap());
    }

    public function testUsernameIsNullIfNotSet()
    {
        $this->assertNull($this->_adapter->getUsername());
    }

    public function testPasswordIsNullIfNotSet()
    {
        $this->assertNull($this->_adapter->getPassword());
    }

    public function testSetAndGetUsername()
    {
        $usernameExpected = 'someUsername';
        $usernameActual = $this->_adapter->setUsername($usernameExpected)
                                         ->getUsername();
        $this->assertSame($usernameExpected, $usernameActual);
    }

    public function testSetAndGetPassword()
    {
        $passwordExpected = 'somePassword';
        $passwordActual = $this->_adapter->setPassword($passwordExpected)
                                         ->getPassword();
        $this->assertSame($passwordExpected, $passwordActual);
    }

    public function testSetIdentityProxiesToSetUsername()
    {
        $usernameExpected = 'someUsername';
        $usernameActual = $this->_adapter->setIdentity($usernameExpected)
                                         ->getUsername();
        $this->assertSame($usernameExpected, $usernameActual);
    }

    public function testSetCredentialProxiesToSetPassword()
    {
        $passwordExpected = 'somePassword';
        $passwordActual = $this->_adapter->setCredential($passwordExpected)
                                         ->getPassword();
        $this->assertSame($passwordExpected, $passwordActual);
    }
}