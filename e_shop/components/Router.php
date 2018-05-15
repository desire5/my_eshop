<?php


//namespace e_shop\components;

//use  e_shop\controllers\ProductController;
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';

        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if(!empty($_SERVER["REQUEST_URI"]))
        {
           return trim($_SERVER["REQUEST_URI"],"/");

        }
    }

    public function run()
    {

       $url =  $this->getURI();
       echo $url."<br>";

        // parsing routes
        foreach ($this->routes as $urlPattern=>$path)
        {

            if(preg_match("~$urlPattern~",$url))
            {

                //take inner url from zovnishnogo
                $internalRoute = preg_replace("~$urlPattern~", $path, $url);
                echo $internalRoute."<br>";
    // take controller, action, parametrs
                $segments = explode('/', $internalRoute);

                // delete the first element of url (my diretory 'e_shop'). latter delete this string
                array_shift($segments);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                // dele first symbol $ lettatr dont need this function
                $controllerName = ucfirst(mb_substr( $controllerName, 1));

                $actionName = 'action'.ucfirst(array_shift($segments));


                $parameters = $segments;
                print_r($parameters);
                echo "<br>";
                echo "name of coontroler - ". $controllerName."<br>";
                echo "name of method -". $actionName."<br>";

                echo "<br>";

                $controllerFile = ROOT. '/controllers/'.$controllerName.'.php';
                if(file_exists($controllerFile))
                {
                    echo "fileee"."<br>";

                    include_once($controllerFile);

                }
               //create object and call method
                // (new $controllerName)->$actionName();
                $controllerObj = new $controllerName;
                $result = call_user_func_array(array(
                         $controllerObj,$actionName),$parameters);
                if($result !=null)
                {
                    break;
                }

            }


       }
    }

}