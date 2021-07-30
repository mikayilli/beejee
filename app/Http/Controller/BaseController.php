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

        if(session_get('old') && !empty(session_get('old')['data']) && session_get('old')['status'] == 1) {
            session_set('old', ["data" => session_get('old')['data'], "status" => 2]);
        } else {
            session_set('old', ["data" => expect("_token", $_REQUEST), "status" => 1]);
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
