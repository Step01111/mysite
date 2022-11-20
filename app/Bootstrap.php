<?php
class Bootstrap
{
    private $route;
    private $controllerName = '';
    private $actionName;
    private $parametrs;

    public function __construct()
    {
        $siteRoutes = [
            ['/^$/', App\Controllers\MainController::class, 'main'],
            ['/^users\/registration$/',
                App\Controllers\UserController::class,
                'registration'
            ],
            ['/^categories\/(\d+)\/edit$/',
                App\Controllers\CategoryController::class,
                'edit'
            ],
            ['/^art\/(\d+)\/edit$/', App\Controllers\ArtController::class, 'edit'],
            ['/^adminpanel$/', App\Controllers\UserController::class, 'admin'],
            ['/^api\/users\/login$/', App\Controllers\UserAPIController::class, 'login'],
            ['/^api\/users\/logout$/', App\Controllers\UserAPIController::class, 'logout'],
            ['/^api\/users\/registration$/',
                App\Controllers\UserAPIController::class,
                'registration'
            ],
            ['/^api\/art\/delete$/', App\Controllers\ArtAPIController::class, 'delete'],
            ['/^api\/art\/create$/', App\Controllers\ArtAPIController::class, 'create'],
            ['/^api\/art\/edit$/', App\Controllers\ArtAPIController::class, 'edit'],
            ['/^api\/categories\/create$/',
                App\Controllers\CategoryAPIController::class,
                'create'
            ],
            ['/^api\/categories\/edit$/',
                App\Controllers\CategoryAPIController::class,
                'edit'
            ],
            ['/^api\/categories\/delete$/',
                App\Controllers\CategoryAPIController::class,
                'delete'
            ],
        ];

        $artRoutes = [
            ['/^([\w\-]+)$/', App\Controllers\CategoryController::class, 'view'],
            ['/^([\w\-]+)\/([\w\-]+)$/', App\Controllers\ArtController::class, 'view'],
        ];
    
        $this->route = $_GET['route'] ?? '';

        $this->getControllerName($siteRoutes);
        if (!$this->controllerName) {
            $this->getControllerName($artRoutes);
        }
        
        try {
            if (!$this->controllerName) {
                throw new \App\Exceptions\NotFoundException();
            }
            
            $controllerName = $this->controllerName;
            $actionName = $this->actionName;
            $parametrs = $this->parametrs;

            $controller = new $controllerName();
            $controller->$actionName(...$parametrs);
        } catch (\App\Exceptions\NotFoundException $e) {
            $view = new \App\View\View();
            $view->renderHTML('errors/404.php');
        }
    }

    private function getControllerName($routes)
    {
        foreach ($routes as $value) {
            preg_match($value[0], $this->route, $matches);
            if ($matches) {
                $this->controllerName = $value[1];
                $this->actionName = $value[2];
                
                unset($matches[0]);
                $this->parametrs = $matches;
                return;
            }
        }
    }
}
