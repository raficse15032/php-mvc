<?php
namespace App;
use App\Http\Resolvers\Exceptions\ViewNotFoundException;

class View{
    public function __construct(protected string $fileName,protected array $params)
    {
        
    }

    public static function make(string $fileName, array $params = []):static
    {
        return new static($fileName,$params);
    }

    public function render()
    {
        // phpinfo();

        $filePath = VIEW_PATH.'/'.$this->fileName.'.php';

        if(!file_exists($filePath)){
            throw new ViewNotFoundException();
        }
        // ob_start();

        foreach($this->params as $key => $value){
            $$key = $value;
        }

        ob_start();

        include($filePath);

        echo (string) ob_get_clean();

        return "";
    }

    public function __toString()
    {
        return $this->render();
    }
}