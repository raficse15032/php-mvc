<?php

namespace App\Http\Resolvers\Exceptions;

class RouteNotFoundException extends \Exception{

    protected $message = "Route not found";

}