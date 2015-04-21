<?php

namespace Adldap\Laravel;

class User implements \Illuminate\Contracts\Auth\Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    /** @var string The name of the unique identifier field. */
    public static $usernameField = 'samaccountname';

    /**
     * Set the unique identifier of the user.
     *
     * @param string $username The user's identifier.
     * @return void
     */
    public function setAuthIdentifier($username) {
        return $this->{self::$usernameField} = $username;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->{self::$usernameField};
    }

}
