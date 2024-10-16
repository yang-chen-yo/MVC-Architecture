<?php

class kernel{

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
        $basePath = getenv('BASE_PATH') ?: '/MVC'; // 默認為'/MVC'
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = str_replace($basePath . '/public', '', $url);
        $url = trim($url, '/');
        if (empty($url) || !preg_match('/^[a-zA-Z0-9\/-]*$/', $url)) {
            throw new HttpStatusException(400); 
        }
        return $url;
    }
    
}
