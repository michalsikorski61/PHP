<?php

namespace Core;
class Router{
    protected  $routes = [];

    public function add($method, $uri, $controller){
        // $this->routes[] = compact('method', 'uri', 'controller');
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => null
        ];
        return $this;
    }
    public function get($uri, $controller){
        return $this->add('GET',$uri,$controller);
    }

    public function post($uri, $controller){
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller){
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller){
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller){
       return $this->add('PUT', $uri, $controller);
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function route($uri,$method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method )){

                //apply middleware
                if($route['middleware'] === 'guest'){
                    if($_SESSION['user'] ?? false){
                        header('Location: /');
                        exit();
                    }
                }

                if($route['middleware'] === 'auth'){
                    if(!$_SESSION['user'] ?? false){
                        header('Location: /');
                        exit();
                    }
                }
                require base_path($route['controller']);
                return;
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




