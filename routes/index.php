<?php
use App\Http\Resolvers\RouteResolver;
use App\Http\Resolvers\Exceptions\RouteNotFoundException;
use App\View;

try {
    $router = new RouteResolver();

    $router->get('/', function(){
        echo "Bismillah";
        echo "Alhamdulillah";
        echo "<br>Home Page";
        echo "<br>".$_ENV['DB_HOST'];
    });

    $router->get('/{id}', function($id){
        echo $id;
    });

    $router->get('/ok/{test}', function($test){
        echo $test;
    });

    $router->get('/invoice', [App\Http\Controllers\InvoiceController::class,'invoiceAdd']);

    $router->get('/invoice/download', [App\Http\Controllers\InvoiceController::class,'invoiceDownload']);

    $router->post('/invoice', [App\Http\Controllers\InvoiceController::class,'invoiceUpload']);

    $router->get('/user/{id}/{invoice}',[App\Http\Controllers\UserController::class,'index']);

    $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
}
catch (RouteNotFoundException $e) {
    http_response_code(404);
    echo View::make('not_found');
    
}
