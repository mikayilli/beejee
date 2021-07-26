<?php


namespace Config;


class Validation
{
    private $errors = [];
    public function check($key, $filter, $param = [])
    {
        if(!method_exists($this, $filter)) {
            throw new \Exception($filter .' Validation method not exist');
        }

        $this->{$filter}($key, ...$param);

        return  $this;
    }

    protected function max($key,$length) {
        if(strlen(trim(request($key))) > $length) {
            $this->errors[$key] = $key ." max length should be '{$length}'";
        }
    }

    protected function email($key) {
        if(!filter_var(request($key), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$key] = $key ." field must be valid email";
        }
    }

    protected function required($key) {
        if(empty(trim(request($key)))) {
            $this->errors[$key] = $key ." field is required";
        }
    }

    public function __destruct()
    {
        if(!empty($this->errors)) {
            session_set('errors', $this->errors);
            unset($_SESSION['error_status']);
            redirect(prev_uri());
        }
    }

    public function validated() {
        if(!empty($this->errors)) {
            return false;
        }

        return true;
    }
}
