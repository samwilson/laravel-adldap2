Adldap authentication for Laravel 5
===================================

## Installation

In `config/app.php` set:

    'providers' => [
        ...
        'Adldap\Laravel\AdldapServiceProvider',
        ...

In `config/auth.php` set:

    'driver' => 'adldap',
    'model' => '\\Adldap\\Laravel\\User',

The model can be any class that implements the
[`Illuminate\Contracts\Auth\Authenticatable`](http://laravel.com/api/5.0/Illuminate/Contracts/Auth/Authenticatable.html)
interface; see below.

Create `config/adldap.php` with:

    return array(
        'account_suffix'     => env('ADLDAP_SUFFIX'),
        'domain_controllers' => array(env('ADLDAP_DC1'), env('ADLDAP_DC2'), env('ADLDAP_DC3')),
        'base_dn'            => env('ADLDAP_BASEDN'),
        'admin_username'     => env('ADLDAP_ADMIN_USER', ''),
        'admin_password'     => env('ADLDAP_ADMIN_PASSWORD', ''),
        'real_primary_group' => env('ADLDAP_GROUP', true),
        'use_ssl'            => env('ADLDAP_SSL', false),
        'use_tls'            => env('ADLDAP_TLS', false),
        'recursive_groups'   => env('ADLDAP_RECURSIVE', true)
    );

Add the required keys to your local `.env` file.

## Customisation

The Auth user 
