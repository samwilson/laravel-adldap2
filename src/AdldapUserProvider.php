<?php

namespace Adldap\Laravel;

use Adldap\Adldap;
use Illuminate\Contracts\Auth\Authenticatable;

class AdldapUserProvider implements \Illuminate\Contracts\Auth\UserProvider
{

    /**
     * @var \Adldap\Adldap
     */
    protected $adldap;

    /**
     * @var string The user classname, defined in `config/auth.php`.
     */
    protected $authModel;

    /**
     * @var string The name of the unique user identifier.
     * @see UserInterface::getAuthIdentifierName()
     */
    protected $usernameField;

    /**
     * @param Adldap $adldap
     * @param string $authModel
     */
    public function __construct(Adldap $adldap, $authModel)
    {
        $this->adldap = $adldap;
        $this->authModel = $authModel;
        $this->usernameField = $authModel::getAuthIdentifierName();
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return Authenticatable|null
     */
    public function retrieveById($identifier)
    {
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
    public function retrieveByToken($identifier, $token)
    {
        
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if ($this->adldap->authenticate($credentials[$this->usernameField], $credentials['password'])) {
            $userInfo = $this->adldap->user()->info($credentials[$this->usernameField])[0];
            $user = new $this->authModel();
            $user->setAuthIdentifier($userInfo[$this->usernameField][0]);
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
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $username = $credentials[$this->usernameField];
        return $this->adldap->authenticate($username, $credentials['password']);
    }
}
