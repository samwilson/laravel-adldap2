<?php

namespace Adldap\Laravel;

class AdldapAuthManager extends \Illuminate\Auth\AuthManager {

    /**
     * Create an instance of the Adldap driver.
     *
     * @return \Illuminate\Auth\Guard
     */
    protected function createAdldapDriver() {
        $provider = $this->createAdldapProvider();
        return new \Illuminate\Auth\Guard($provider, $this->app['session.store']);
    }

    /**
     * Create an instance of the Eloquent user provider.
     *
     * @return AdldapUserProvider
     */
    protected function createAdldapProvider() {
        $adldap = new \Adldap\Adldap($this->app['config']['adldap']);
        $authModel = $this->app['config']['auth.model'];
        return new AdldapUserProvider($adldap, $authModel);
    }

}
