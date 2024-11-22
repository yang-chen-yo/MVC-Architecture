<?php

class Controller
{
    public function model($model) {
        if ($this->isModelExists($model)) {
            require_once ('../app/models/' . $model . '.php');
            return new $model();
        } else {
            die('Model does not exist');
        }
    }

    public function view($view, array $data = []): void
    {
        if ($this->isViewExists($view)) {
            require_once ('../app/views/' . $view . '.php');
        } else {
            die('View does not exist');
        }
    }

    private function isViewExists($view): bool
    {
        return file_exists('../app/views/' . $view . '.php');
    }

    private function isModelExists($model): bool
    {
        return file_exists('../app/models/' . $model . '.php');
    }

    protected function redirect($url): void
    {
        header('Location: ' . $url);
    }

    protected function retrievePostData(): array
    {
        return $_POST;
    }

    protected function retrieveGetData(): array
    {
        unset($_GET['url']);
        return $_GET;
    }

}