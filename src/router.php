<?php

function router($httpMethods, $route, $callback, $exit = true)
{
    static $path = null;

    if ($path === null) {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $scriptName = str_replace(
            '\\', '/', dirname(
                dirname($_SERVER['SCRIPT_NAME'])
            )
        );
        $len = strlen($scriptName);

        if ($len > 0 && $scriptName !== '/') {
            $path = substr($path, $len);
        }
    }
    if (!in_array($_SERVER['REQUEST_METHOD'], (array) $httpMethods)) {
        return;
    }
    $matches = null;
    $regex = '/' . str_replace('/', '\/', $route) . '/';
    if (!preg_match_all($regex, $path, $matches)) {
        return;
    }
    if (empty($matches)) {
        echo call_user_func(array($callback[0], $callback[1]));
    } else {
        $params = array();
        foreach ($matches as $k => $v) {
            if (!is_numeric($k) && !isset($v[1])) {
                $params[$k] = $v[0];
            }
        }
        echo call_user_func(array($callback[0], $callback[1]), $params);
    }
    if ($exit) {
        exit;
    }
}
