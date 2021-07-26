<?php


namespace App\Http\Controller;


class BaseController
{
    public function __construct()
    {
        $status = session_get('error_status');
        if(session_get('errors')) {
            $status = !$status ? 1 : ($status+ 1);
            session_set('error_status', $status);
        }
    }

    public function __destruct()
    {
        $status = session_get('error_status');
        if($status && $status >= 1) {
            unset($_SESSION['errors']);
            unset($_SESSION['error_status']);
        }
    }
}
