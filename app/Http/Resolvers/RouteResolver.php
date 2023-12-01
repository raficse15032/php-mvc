<?php
namespace App\Http\Resolvers;
use App\Http\Resolvers\Exceptions\RouteNotFoundException;

class RouteResolver{
    private array $routes;

    public function register(string $route, callable $action):self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if(!$action){
            throw new RouteNotFoundException();
        }

        return call_user_func($action);
    }
}