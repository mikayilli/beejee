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

        <div class="row mt-5">
            <div class="col-6 offset-0 offset-xl-3">
                <div class="card">
                    <div class="card-body">
                        <?php if(errors('login')):  ?>
                            <div class="alert alert-danger mb-3">
                                <strong><?= errors('login')  ?></strong>
                            </div>
                        <?php endif; ?>
                        <h1>Login</h1>
                        <form action="/login" method="post">

                            <?php csrf_field(); ?>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input class="form-control" type="text" name="email" value="<?= old('email') ?>">
                                <?php if(errors('email')):  ?>
                                    <span class="text-danger"><?= errors('email') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input class="form-control" type="text" name="password">
                                <?php if(errors('password')):  ?>
                                    <span class="text-danger"><?= errors('password') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-sm mt-3">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
