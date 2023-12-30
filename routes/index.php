<?php
use App\Http\Resolvers\RouteResolver;

session_start();

$router = new RouteResolver();

// $router->get('/', function(){
//     echo "Bismillah";
//     echo "Alhamdulillah";
//     echo "<br>Home Page";
// });

$router->get('/{test}', function($test){
    echo $test;
});

// $router->get('/invoice', [App\Http\Controllers\InvoiceController::class,'invoiceAdd']);

// $router->get('/invoice/download', [App\Http\Controllers\InvoiceController::class,'invoiceDownload']);

// $router->post('/invoice', [App\Http\Controllers\InvoiceController::class,'invoiceUpload']);

$router->get('/user/{id}/{invoice}',[App\Http\Controllers\UserController::class,'index']);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);