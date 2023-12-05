<?php
namespace App\Http\Resolvers;
use App\Http\Resolvers\Exceptions\RouteNotFoundException;

class RouteResolver{
    private array $routes;

    public function register(string $requestMethod, string $route, callable|array $action):self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function __call($name, $argumnets){
        call_user_func_array([$this,'register'],[strtoupper($name), ...$argumnets]);
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if(is_callable($action)){
            return call_user_func($action);
        }

        if(is_array($action)){

            [$class,$method] = $action;
            
            if(method_exists($class,$method)){
                $obj = new $class();
                return call_user_func_array([$obj,$method],[]);
            }
        }

        throw new RouteNotFoundException();
        
    }
}