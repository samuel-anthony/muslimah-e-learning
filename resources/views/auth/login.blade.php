<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>MT Ummahat</title>
</head>

<body>
    <div class="container">
        <div class="row py-5">
            <h1 class="col-12 text-center text-white">MT Ummahat</h1>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-6 bg-light rounded py-4 px-5">
                <form action="action_page.php" method="post">
                    <div class="form-group">
                        <label for="userId">User ID</label>
                        <input type="text" class="form-control" id="userId" placeholder="Enter User ID" name="userid" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
                <p class="text-right">Tidak Terdaftar? <a href="">Hubungi Kami</a></p>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/assets/js/jquery-1.12.4.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
