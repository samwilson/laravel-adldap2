<?php

namespace Adldap\Laravel;

class User implements \Illuminate\Contracts\Auth\Authenticatable, UserInterface
{

    use \Illuminate\Auth\Authenticatable;

    public static function getAuthIdentifierName()
    {
        return 'samaccountname';
    }

    /**
     * Set the unique identifier of the user.
     *
     * @param string $username The user's identifier.
     * @return void
     */
    public function setAuthIdentifier($username)
    {
        return $this->{self::getAuthIdentifierName()} = $username;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{self::getAuthIdentifierName()};
    }
}
