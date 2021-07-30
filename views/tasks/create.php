<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body"><h1>Create Task</h1></div>
        </div>
        <div class="row mt-5">
            <div class="col-6 offset-0 offset-xl-3">
                <div class="card">
                    <div class="card-body">
                        <form action="/tasks" method="post">
                            <?php csrf_field() ?>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control"  value="<?= old('username') ?>">
                                <?php if(errors('username')):  ?>
                                    <span class="text-danger"><?= errors('username') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="<?= old('email') ?>">
                                <?php if(errors('email')):  ?>
                                    <span class="text-danger"><?= errors('email') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Text</label>
                                <textarea name="text" class="form-control"><?= old('text') ?></textarea>
                                <?php if(errors('text')):  ?>
                                    <span class="text-danger"><?= errors('text') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-sm btn-info">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
