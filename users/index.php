<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/style.css">
    <title>Hello, world!</title>
</head>
<body>
    <div class="container my-5">
        <h1>ข้อมูลสมาชิก</h1>
        <div><a href="create_frm.php" class="btn btn-success mb-2">+ข้อมูล</a></div>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <table class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อ-สกุล</th>
                    <th scope="col">email</th>
                    <th scope="col">วันที่แก้ไขครั้งล่าสุด</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col" colspan="2">จักการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../common/connect.php';
                $ststement = $conn->prepare("SELECT * FROM users");
                $ststement->execute();
                
                if ($ststement->rowCount() > 0) {
                    $rows = $ststement->fetchAll(PDO::ATTR_AUTOCOMMIT);
                    $n = 1;
                    foreach($rows as $row){
                        ?>
                        <tr>
                            <th><?=$n ?></th>
                            <td><?= $row['u_name'] ?></td>
                            <td><?= $row['u_email'] ?></td>
                            <td><?= $row['Updated_at'] ?></td>
                            <!-- <td><?= $row['Status'] ?></td> -->
                            <!-- <td>
                            <?php
                                // if($row['Status'] == 'true' ){
                                //     echo"เปิดการใช้งาน";
                                // }else {
                                //     echo"ปิดการใช้งาน";
                                // }
                            ?>
                            </td> -->
                            <td><?= ($row['Status']=='true')?'เปิดการใช้งาน':'ปิดการใช้งาน' ?></td>
                            <td>
                                <a href="update_frm.php?u_id=<?=$row['u_id']?>" 
                                onclick="return confirm('Are you sure you want to Edit?');" 
                                class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <a href="Delete.php?u_id=<?=$row['u_id']?>" 
                                onclick="return confirm('Are you sure you want to Delete?');" 
                                class="btn btn-danger">Delete</a></td>
                            </tr>
                        <?php
                        $n++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
