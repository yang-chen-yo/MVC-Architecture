<?php

class api{

    /**
     * @throws HttpStatusException
     */
    public function findRoute($targetRoute): array
    {
        foreach ($this->routes as $restriction => $route) {
            if (array_key_exists($targetRoute, $route)) {
				return [
					'restriction' => $restriction,
					'handler' => $route[$targetRoute]
				];
            }
        }
        throw new HttpStatusException(404, "找不到您想要瀏覽的網頁或執行的動作!");
    }
}