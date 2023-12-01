<?php
use App\Http\Resolvers\RouteResolver;

echo "Bismillah";
echo "Alhamdulillah";

$router = new RouteResolver();

$router->register('/', function(){
    echo "<br>Home Page";
});
$router->register('/invoice', function(){
    echo "<br>Invoice Page";
});
$router->resolve($_SERVER['REQUEST_URI']);