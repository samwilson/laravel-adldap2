<?php

class AdldapTest extends PHPUnit_Framework_TestCase {

    protected $ad;
    protected $user;

    public function setUp() {
        $this->ad = $this->getMockBuilder('Adldap\Adldap')
                ->setMethods(['authenticate'])
                ->disableOriginalConstructor()
                ->getMock();
        $this->user = $this->getMockBuilder('\Illuminate\Contracts\Auth\Authenticatable')
                ->disableOriginalConstructor()
                ->getMock();
    }

    /**
     * @testdox AdldapUserProvider::validateCredentials returns the value of Adldap::authenticate()
     * @test
     */
    public function validateCredentials() {
        $userProvider = new \Adldap\Laravel\AdldapUserProvider($this->ad, get_class($this->user));

        $credentials = ['samaccountname' => 'user', 'password' => 'correct-password'];
        $valueMap = [
            ['user', 'correct-password', true],
            ['user', 'wrong-password', false],
        ];
        $this->ad->expects($this->exactly(2))
                ->method('authenticate')
                ->will($this->returnValueMap($valueMap));
        $this->assertTrue($userProvider->validateCredentials($this->user, $credentials));
        $this->assertFalse($userProvider->validateCredentials($this->user, $credentials));
    }

}
