<?php


namespace App\Traits;


trait Pagination
{
    private static $instance;
    public function __construct() {
        self::$instance = $this;
    }
    public static function paginate($perPage = 3)
    {
        $current_page = 1;

        if(request('page'))
            $current_page = (int)request('page') <= 0 ? 1 : (int)request('page') ;

        self::$instance->perPage = $perPage;
        $offset = self::$instance * $current_page - self::$instance->perPage;
        $total = self::$instance->count();

        $data = self::$instance->limit(self::$instance->perPage)->offset($offset)->get();

        return compact("data", "perPage", "total", "current_page");
    }
}
