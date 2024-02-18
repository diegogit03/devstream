<?php

namespace DevStream\Controllers;

use League\Plates\Engine;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\RedirectResponse;

class Controller
{
    protected Engine $view;

    public function __construct()
    {
        $this->view = new Engine(ROOT_DIR . '/views');
    }

    public function render($template, $params = [])
    {
        $template = $this->view->render($template, $params);

        $response = new Response();
        $response->getBody()->write($template);

        return $response;
    }

    public function redirect(string $url)
    {
        return new RedirectResponse($url);
    }
}
