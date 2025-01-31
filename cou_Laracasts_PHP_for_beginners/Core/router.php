<?php

namespace Core;
class Router{
    protected  $routes = [];
    public function get($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET',
        ];
    }

    public function post($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST',
        ];
    }

    public function delete($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'DELETE',
        ];
    }

    public function patch($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PATCH',
        ];
    }

    public function put($uri, $controller){
        $this->routes[] =[
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PUT',
        ];
    }

    public function route($uri,$method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                require base_path($route['controller']);
            }

        }
        $this->abort();
    }
    
    protected function abort($status_code = 404){
        http_response_code($status_code);
        $heading = $status_code;
        require base_path("views/{$status_code}.view.php");
    }
}




