<?php
    $host = "webserver-dicoding.mysql.database.azure.com";
    $user = "rohmatjoule@webserver-dicoding";
    $pass = "Sintingpisan123";
    $db = "dbo";


    $conn = mysqli_init();
    mysqli_real_connect($conn, $host, $user, $pass, $db, 3306);
    if (mysqli_connect_errno($conn)) {
    die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    // $res = mysqli_query($conn, 'SELECT * FROM users');
    // while ($row = mysqli_fetch_assoc($res)) {
    // var_dump($row);
    // }
    
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if ($stmt = mysqli_prepare($conn, "INSERT INTO users (name, telp, email, address) VALUES (?, ?, ?, ?)")) {
                mysqli_stmt_bind_param($stmt, 'ssss', $name, $telp, $email, $address);
                mysqli_stmt_execute($stmt);
                printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
                mysqli_stmt_close($stmt);
            }
            
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rohmatjoule | Azure</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    @media only screen and (min-width: 600px) {
        .col-md-2{
          text-align: right;  
        }
    }
    </style>
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <!-- input form -->
                <div class="col-md-6">
                    <form method="post" action="index.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-2">Nama</div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control form-group">
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-2">Telepon</div>
                            <div class="col-md-8">
                                <input type="text" name="telp" class="form-control form-group" placeholder="ex : +628...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Email</div>
                            <div class="col-md-8">
                                <input type="Email" name="email" class="form-control form-group">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Address</div>
                            <div class="col-md-8">
                                <input type="text" name="address" class="form-control form-group">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                <input type="reset" value="Reset" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                        <table class="table table-responsive-md table-hover table-light">
                                <thead>
                                    <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col-2">Name</th>
                                    <th scope="col-5">Telepon</th>
                                    <th scope="col-2">Email</th>
                                    <th scope="col-3">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $res = mysqli_query($conn, 'SELECT * FROM users');
                                  $n= 1;
                                  foreach ($res as $key => $value) {
                                ?>
                                    <tr>
                                    <th scope="row"><?=$n++?></th>
                                    <td><?=$value['name']?></td>
                                    <td><?=$value['telp']?></td>
                                    <td><?=$value['email']?></td>
                                    <td><?=$value['address']?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
  

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>

