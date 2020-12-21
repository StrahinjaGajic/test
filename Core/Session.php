<?php

namespace Core;

/**
 * Class Session
 *
 * @package Core
 */
class Session
{
    /**
     * Session constructor.
     */
    public static function init()
    {
        session_start();
    }

    /**
     * Show session data
     */
    public static function dump()
    {
        dump($_SESSION);
    }
    /**
     * Get a value from the session by key
     *
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Set a value to a key in the session
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Check if a value exists in the session
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a value from the session by key
     *
     * @param $key
     */
    public static function delete($key)
    {
        if (!isset($_SESSION[$key])) return;
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session and removes all session values
     */
    public static function destroy()
    {
        session_destroy();
    }
}