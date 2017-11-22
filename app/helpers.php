<?php

if (!function_exists('_uses')) {
    /**
     * Return $controllerClass . '@' . $method
     * routes.php にて、 uses 指定の際に \Some\NameSpace\SomeController::class 記法を使えるようにするための helper
     *
     * @param string $controllerClass
     * @param string $method
     *
     * @return string
     */
    function _uses($controllerClass, $method = '')
    {
        $ary = [];
        $count = 0;
        foreach (explode('/', strtr($controllerClass, '\\', '/')) as $elm) {
            ($count >= 3) and $ary[] = $elm;
            ++$count;
        }

        return implode('\\', $ary).(($method !== '') ? '@'.$method : '');
    }
}
