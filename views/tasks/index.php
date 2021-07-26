<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="card">

        </div>

        <div class="card mt-5">
            <div class="card-body">
                <div class="row">
                    <div class="col"><h1>Tasks</h1></div>
                    <div class="col text-right">
                        <a href="/tasks/create" class="btn btn-info float-right">Create new Task</a>
                    </div>
                    <div class="col text-right">
                        <?php if(auth()): ?>
                            <a href="/logout" class="btn btn-info float-right">Logout</a>
                        <?php else: ?>
                            <a href="/login" class="btn btn-info float-right">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if(errors('task')): ?>
            <div class="alert alert-danger mt-5">
                <?= errors('task') ?>
            </div>
        <?php endif; ?>

        <?php if(errors('message')): ?>
            <div class="alert alert-info mt-5">
                <?= errors('message') ?>
            </div>
        <?php endif; ?>

        <table class="table table-hovered">
            <thead>
                <tr>
                    <th>Text</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                   <?= auth() ? '<th>Edit</th>' : null ?>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= $task['text'] ?></td>
                    <td><?= $task['username'] ?></td>
                    <td><?= $task['email'] ?></td>
                    <td><?= $statuses[$task['status']] ?? 'unknown' ?></td>
                    <?php if(auth()): ?>
                        <td>
                            <form action="/tasks/approve" method="post">
                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <input <?= $task['status'] == 2 ? 'checked' : null ?> type="checkbox" onclick="this.form.submit()" >
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if($paginate['total'] > $paginate['perPage']): ?>
            <div class="row">
                <div class="col-12">
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <?php for($i = 0; $i < ceil($paginate['total']/$paginate['perPage']); $i++): ?>
                            <a href="?page=<?= $i + 1 ?>" class="btn btn-outline-primary <?= $paginate['current_page'] == ($i + 1) ? 'active' : null ?>"><?=  $i + 1 ?></a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
