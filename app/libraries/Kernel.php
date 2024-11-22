<?php

class Kernel
{
	public function __construct() {
        try {
            // get URL
			$url = $this->getUrl();

            // get API corresponding to the URL
			$api = new Api();
			$route = $api->findRoute($url);

            // get authorization
			$gate = new Gate();
			$gate->verify($route['restriction']);

            // execute method of controller
			require_once ('../app/controllers/' . $route['handler'][0] . '.php');
			$controller = new $route['handler'][0]();
			$method = $route['handler'][1];
			call_user_func([$controller, $method]);

		} catch (HttpStatusException $e) {
            http_response_code($e->getStatusCode());
            $controller = new Controller();
            $controller->view("exception",
              [
                'status' => $e->getStatusCode() . " " . HttpStatusException::getResponseStatusCodeText($e->getStatusCode()),
                'message' => $e->getMessage()
              ]
            );
		}
	}

    /**
     * @throws HttpStatusException
     */
    private function getUrl() {
		if (isset($_GET['url']) && !empty($_GET['url'])) {
		  	return $_GET['url'];
		} else {
		  	throw new HttpStatusException(400);
		}
    }
}