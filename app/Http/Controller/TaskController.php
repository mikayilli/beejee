<?php


namespace App\Http\Controller;


use App\Models\Task;
use Config\Validation;

class TaskController extends BaseController
{
    public function index()
    {
        $statuses = [
            "1" => "new",
            "2" => "completed"
        ];

        $current_page = 1;

        if(request('page'))
            $current_page = (int)request('page') <= 0 ? 1 : (int)request('page') ;

        $perPage = 10;
        $offset = $perPage * $current_page - $perPage;
        $total = Task::count();
        $tasks = Task::orderBy('status')->limit($perPage)->offset($offset)->get();

        $paginate = compact('perPage', 'current_page', 'total');
        return view("tasks/index", compact('tasks', 'statuses', 'paginate'));
    }

    public function create()
    {
        return view("tasks/create");
    }

    public function store()
    {
        $validator = new Validation();
        $validator->check("email", 'email');
        $validator->check("email", "max", ['50']);
        $validator->check('email', 'required');
        $validator->check('username', 'required');
        $validator->check('username', 'max', [50]);
        $validator->check('text', 'required');

        if(!$validator->validated()) return;
        $sth = pdo()->prepare('insert into `tasks` set `email` = :email,
                        `username` = :username,
                        `text` = :text'
        );
        $sth->execute([
            ":email" => request('email'),
            ":username" => request('username'),
            ":text" => request('text')
        ]);

        session_set('errors', ["message" => "successfully created"]);
        redirect("/");
    }

    public function approve()
    {
        $validator = (new Validation())->check('task_id', 'required');
        if(!$validator->validated()) return;

        $task = pdo()->prepare('select * from `tasks` where `id` = :id');
        $task->execute([':id' => request('task_id')]);
        $result = $task->fetch();

        if(!$result) {
            session_set("errors", ["task" => "Task Not Found"]);
            redirect(prev_uri());
        }
        $status = 1;
        if($result['status'] == 1) {
            $status = 2;
        }

        $update = pdo()->prepare("update `tasks` set `status` = :status where `id` = :id");
        $update->execute([':id' => $result['id'], ':status' => $status]);

        session_set('errors', ["message" => "successfully updated"]);
        redirect(prev_uri());
    }
}
