<?php

namespace App\Lib;

use Closure;
use TypeError;

class Router
{
    private $routes;

    public function go(Request $request): void
    {
        $route = $this->matchRoute($request);

        call_user_func_array($route['callable'], [$request, $route['params']]);
    }

    /**
     * Returns registered route that corresponds with the incoming url path and param count
     *
     * @param Request $request
     * @return array
     */
    private function matchRoute(Request $request): ?array
    {
        $parsedPath = $this->parsePath($request->path(), function ($segment) {
            return is_numeric($segment) ? (int)$segment : null;
        });

        if (isset($this->routes[$request->method()][$parsedPath['path']])) {
            $routes = $this->routes[$request->method()][$parsedPath['path']];

            foreach ($routes as $route) {
                if (count($route['params']) === count($parsedPath['params'])) {
                    $route['params'] = array_combine($route['params'], $parsedPath['params']);
                    return $route;
                }
            }
        }

        //redirect to 404 if not matched to any registered route
        $this->error();
    }

    /**
     * @param string $path
     * @param array $callable
     */
    public function get(string $path, array $callable): void
    {
        $this->register('GET', $path, $callable);
    }

    /**
     * @param string $path
     * @param array $callable
     */
    public function post(string $path, array $callable): void
    {
        $this->register('POST', $path, $callable);
    }

    /**
     * @param string $path
     * @param array $callable
     */
    public function put(string $path, array $callable): void
    {
        $this->register('PUT', $path, $callable);
    }

    /**
     * @param string $path
     * @param array $callable
     */
    public function delete(string $path, array $callable): void
    {
        $this->register('DELETE', $path, $callable);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $callable
     */
    private function register(string $method, string $path, array $callable): void
    {
        $parsedPath = $this->parsePath($path, function ($segment) {
            if (strpos($segment, ':') !== false) {
                return substr($segment, 1);
            }
            return null;
        });

        try {
            $this->routes[$method][$parsedPath['path']][] = [
                'callable' => Closure::fromCallable($callable),
                'params' => $parsedPath['params'],
            ];
        } catch (TypeError $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * Reconstructs path without params and stores params in array
     *
     * @param string $path
     * @param callable $splitter
     * @return array
     */
    private function parsePath(string $path, callable $splitter): array
    {
        $newPath = [];
        $params = array_filter(array_map(
            function ($segment) use (&$newPath, $splitter) {
                if ($param = call_user_func($splitter, $segment)) {
                    return $param;
                }
                $newPath[] = $segment;
                return null;
            },
            explode('/', $path)
        ));

        return [
            'params' => $params,
            'path' => implode('/', array_filter($newPath))
        ];
    }

    public function error(): void
    {
        http_response_code(404);
        die('404 Page not found');
    }
}
