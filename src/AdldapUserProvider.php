<?php

namespace Adldap\Laravel;

use Adldap\Adldap;
use Adldap\Laravel\User;
use Illuminate\Contracts\Auth\Authenticatable;

class AdldapUserProvider implements \Illuminate\Contracts\Auth\UserProvider {

    /** @var \Adldap\Adldap */
    protected $adldap;

    /** @var string The user classname, defined in `config/auth.php`. */
    protected $authModel;

    /**
     * @param Adldap $adldap
     * @param string $user
     */
    public function __construct(Adldap $adldap, $authModel) {
        $this->adldap = $adldap;
        $this->authModel = $authModel;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return Authenticatable|null
     */
    public function retrieveById($identifier) {
        $user = new $this->authModel();
        $user->setAuthIdentifier($identifier);
        return $user;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token) {
        
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) {
        
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        if ($this->adldap->authenticate($credentials[User::$usernameField], $credentials['password'])) {
            $userInfo = $this->adldap->user()->info($credentials[User::$usernameField])[0];
            $user = new $this->authModel();
            $user->setAuthIdentifier($userInfo[User::$usernameField][0]);
            return $user;
        }
        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) {
        return $this->adldap->authenticate($credentials[User::$usernameField], $credentials['password']);
    }

}
