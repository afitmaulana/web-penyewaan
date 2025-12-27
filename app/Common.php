<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

/**
 * Get current authenticated user
 * Returns user array or null if not authenticated
 */
if (!function_exists('auth')) {
    function auth(): object|null
    {
        $session = session();
        if ($session->has('user_id')) {
            return (object) [
                'id'    => $session->get('user_id'),
                'email' => $session->get('email'),
                'name'  => $session->get('user_name'),
                'role'  => $session->get('role'),
            ];
        }
        return null;
    }
}

/**
 * Check if user is authenticated
 */
if (!function_exists('isAuth')) {
    function isAuth(): bool
    {
        return session()->has('user_id');
    }
}

/**
 * Check if user has specific role
 */
if (!function_exists('hasRole')) {
    function hasRole(string $role): bool
    {
        return session()->get('role') === $role;
    }
}
