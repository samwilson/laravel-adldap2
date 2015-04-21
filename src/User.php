<?php

namespace Adldap\Laravel;

class User extends \Illuminate\Auth\GenericUser {

    /** @var string The name of the unique identifier field. */
    public static $usernameField = 'samaccountname';

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->attributes[self::$usernameField];
    }

}
