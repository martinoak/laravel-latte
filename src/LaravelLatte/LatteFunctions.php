<?php

declare(strict_types=1);

namespace MarvelousMartin\LaravelLatte;

use Illuminate\Support\Facades\Route;

class LatteFunctions
{
    public static function link(string $name, array $parameters = [], bool $absolute = true): string
    {
        $array = explode('@', $name);

        if (count($array) === 1 && $name === 'this' && empty($parameters)) {
            // Jen 'this' (bez parametru) vrati aktualni URL
            return url()->current();
        }
        
        if (count($array) === 1 && ($current = Route::currentRouteAction()) === null) {
            // 'this' s parametry, nebo nazev metody musi mit definovanou action 
            throw new \RuntimeException('Latte function link(): there is no current route action for "' . $name . '"');
        }
        
        if (count($array) === 1) {
            // 'this' s parametry, nebo nazev metody - zjistit controller a metodu z current action
            list($controller, $method) = explode('@', $current);
            if ($name !== 'this') {
                // nazev metody - prepsat
                $method = $name;
            } else {
                // 'this' s parametry - pouzit aktualni action a pohrat si s parametry
                $diff = array_diff_key(request()->route()->parameters, $parameters);
                $i = 0;
                foreach ($diff as $n => &$d) {
                    if (isset($parameters[$i])) {
                        $d = $parameters[$i];
                        unset($parameters[$i]);
                    }
                    $i++;
                }
                $parameters = array_merge($diff, $parameters);
            }
        } else {
            // Contoller@method
            $controller = class_exists('App\\Http\\Controllers\\' . $array[0] . 'Controller') 
                ? 'App\\Http\\Controllers\\' . $array[0] . 'Controller'
                : 'App\\Http\\Controllers\\' . $array[0];
            $method = $array[1] ?: 'index';
        }
        
        return action([$controller, $method], $parameters, $absolute);
    }

    public static function asset(string $url, string $paramName = 'm'): string
    {
        return $url . "?$paramName=" . filemtime(public_path(ltrim($url, '/')));
    }
}
