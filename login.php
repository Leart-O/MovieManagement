<?php  include 'includes/db.php'; session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-shadow">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $sql('SELECT * FROM users WHERE email = ?');
                            $stmt = $pdo->prepare($sql);
                         $stmt->bindParam(':email' , $email);
                            $stmt->execute(); 
                            $result = $stmt -> get_result();
                            $user = $result ->fetch_assoc();

                            if($user && password_verify($password, $user('password'))){
                                $_SESSION['user_id'] = $user['id'];
                                $_SESSION['role'] = $user['role'];
                                echo "<div class='alert alert-successful'>Login sucessful! <a href='index.php'>Go Home</a></div>";
                            }else{
                                echo "<div class='alert alert-danger'>Invalid email or password</div>";
                            }
                        }
                        ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label" >Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label" >Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>