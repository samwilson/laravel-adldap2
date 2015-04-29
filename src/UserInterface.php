<?php

namespace Adldap\Laravel;

interface UserInterface
{

    /**
     * Get the name of the unique identifier.
     *
     * @return string Usually 'username'.
     */
    public static function getAuthIdentifierName();

    /**
     * Set the unique identifier of the user.
     *
     * @param string $value The user's identifier (e.g. their username).
     * @return void
     */
    public function setAuthIdentifier($value);
}
