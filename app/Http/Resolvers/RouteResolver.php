<?php
namespace App\Http\Resolvers;
use App\Http\Resolvers\Exceptions\RouteNotFoundException;

class RouteResolver{
    private array $routes;
    private array $params;

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
        $this->params = [];
        
        $requestRoute = explode('?', $requestUri)[0];
        
        $action = $this->routes[$requestMethod][$requestRoute] ?? null;

        if(!$action){
            foreach ($this->routes[$requestMethod] as $route => $routeAction) {
                if($this->compareRoutes($requestRoute, $route)){
                    $action = $routeAction;
                    break;
                }
            }
            
            if(!$action){
                throw new RouteNotFoundException();
            }
        }

        if(is_callable($action)){
            return call_user_func($action, ...$this->params);
        }

        if(is_array($action)){

            [$class,$method] = $action;
            
            if(method_exists($class,$method)){
                $obj = new $class();
                return call_user_func_array([$obj,$method],$this->params);
            }
        }

        throw new RouteNotFoundException();
        
    }

    private function compareRoutes($requestRoute, $route)
    {  
        $requestRouteParts = \explode('/', $requestRoute);
        $routeParts = \explode('/', $route);

        if (count($requestRouteParts) !== count($routeParts)) {
            return false;
        }

        foreach ($routeParts as $key => $part) {
            $pattern = '/\{.*\}/';
            if (preg_match($pattern, $part)) {
                $this->params[] = $requestRouteParts[$key];
                $requestRouteParts[$key] = $part;
            }
            
        }

        if($route != \implode('/', $requestRouteParts)){
            return false;
        }
        
        return true; 
    }
}