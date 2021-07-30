<?php


namespace App\Http\Controller;


use Config\Validation;

class LoginController extends BaseController
{
    public function show()
    {
        return view('login');
    }

    public function login()
    {
        $validator = (new Validation())
            ->check("password", "required")
            ->check("email", "required");

        if(!$validator->validated()) return;

        $user = pdo()
            ->prepare("select `id`,`email`, `password` FROM `users` where `email` = :email and `password` = :password");
        $user->execute([ ":email" => request('email'), ":password" => request('password')]);
        $result = $user->fetchAll();

        if(count($result) < 1) {
            session_set("errors", ["login" => "email or password not match"]);
            redirect(current_uri());
        }
        else {
            session_set('user', 1);
            redirect('/');
        }

    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }

}
