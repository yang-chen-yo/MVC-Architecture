<?php

class Gate
{
    /**
     * @throws HttpStatusException
     */
    public function verify($restriction): void
    {
        session_start();
        if (!call_user_func([$this, $restriction])) {
            throw new HttpStatusException(403, "您尚無權限瀏覽的網頁或執行動作!");
        }
    }

    public function noRestriction(): bool
    {
        return true;
    }

    public function hasLogin(): bool
    {
        return isset($_SESSION['id']) && !empty($_SESSION['id']);
    }

    
}