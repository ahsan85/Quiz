<?php
/**
 * var dump and then die
 */
function dd($data)
{
    var_dump($data);
    die();
}

/**
 * get configurations by different key levels
 * Note : Please make sure that you have set $_SESSION['config'] = $config;
 * before calling this function, becuase this function reads configs from
 * session
 *
 * Examples :
 * config(keyLevel1) should return $config[keyLevel1]
 * config(keyLevel1.keyLevel2) should return $config[keyLevel1][keyLevel2]
 * config(keyLevel1.keyLevel2.keyLevel3) should return $config[keyLevel1][keyLevel2][keyLevel3]
 */
function config($name)
{
    $names = explode('.', $name);
    if (count($names) == 1 && isset($_SESSION['config'][$name]))
        return $_SESSION['config'][$name];
    else if (count($names) == 2 && isset($_SESSION['config'][$names[0]][$names[1]]))
        return $_SESSION['config'][$names[0]][$names[1]];
    else if (count($names) == 3 && isset($_SESSION['config'][$names[0]][$names[1]][$names[2]]))
        return $_SESSION['config'][$names[0]][$names[1]][$names[2]];

}

/**
 * Checks if a user is logged in
 */
function isUserLoggedIn()
{
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'])
        return true;
    return false;
}

/**
 * Checks if a user has given role
 */
function isUserHasRole($role)
{
    if (!isUserLoggedIn())
        return false;

    return isset($_SESSION['loggedInUser']['role']) && $_SESSION['loggedInUser']['role'] == $role;
}



?>