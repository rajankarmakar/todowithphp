<?php
session_start();
require_once "class.database.php";
if(!isset($_SESSION['access-token'])){
    header("Location: ../index.php");
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ToDo App with OOP in PHP</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12">
                <h1 class="text-success text-center"> Simple TODO App</h1>
                <h3 class="text-success text-center"> <?php $obj->insertTodo(); ?> </h3>
                <div class="text-center mt-5 mb-5">
                    <form method="GET" action="logout.php">
                        <button class="btn btn-info text-center" type="submit" name="logout" value="true"> Logout </button>
                    </form>
                </div>
            </div>

            <div class="col-sm-12">
                <form method="POST">
                    <div class="form-row">
                        <div class="col-sm-12 mb-3">
                            <label for="validationServer01">Task Name</label>

                            <input type="text" name="task" id="task" class="form-control " id="validationServer01" placeholder="Write your task" value="<?php if(isset($_GET['edit'])){ $editItem = $obj->editItem(); echo $editItem['task']; } ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="validationServer02">Enter Date</label>
                            <input type="text" name="date" id="date" class="form-control " id="validationServer02" value="<?php if(isset($_GET['edit'])): $editItem = $obj->editItem(); echo $editItem['date']; endif; ?>" placeholder="Type Date" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <?php if(isset($_GET['edit'])){ ?>
                        <button class="btn btn-primary" type="submit" name="update" value="<?php $_GET['edit']; ?>">Update</button>
                        <?php }else{ ?>
                        <button class="btn btn-primary" type="submit" name="submit">ADD Task</button>
                        <?php } ?>
                </form>
            </div>
        </div>
        <?php
        $completeTodos = $obj->getCompleteTodo();
        if(!empty($completeTodos)):
        ?>
        <div class="col-sm-12 mt-5">
            <h3 class="text-success pb-3"> Completed TODO </h3>
            <table class="table">
                <thead>

                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Task</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($completeTodos as $completeTodo){
                    ?>
                    <tr>
                        <th scope="col"><?php echo $completeTodo['id'] ?></th>
                        <th scope="col"><?php echo $completeTodo['task'] ?></th>
                        <th scope="col"><?php echo $completeTodo['date'] ?></th>
                        <th scope="col">
                            <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="incomplete" value="<?php echo $completeTodo['id'] ?>" class="btn btn-secondary"> Incomplete </button>
                            </form>
                            <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="edit" value="<?php echo $completeTodo['id'] ?>" class="btn btn-info"> Edit </button>
                            </form>
                            <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="delete" value="<?php echo $completeTodo['id'] ?>" class="btn btn-danger"> Delete </button>
                            </form>
                        </th>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        <?php
            $record = $obj->getTodo();
            if(!empty($record)):
        ?>
        <div class="col-sm-12 mt-5">
            <h3 class="text-primary pb-3"> Incomplete TODO </h3>
            <table class="table">
                <thead>

                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Task</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $datas = $obj->getTodo();
                    foreach ($datas as $data){
                        ?>
                        <tr>
                            <th scope="col"><?php echo $data['id'] ?></th>
                            <th scope="col"><?php echo $data['task'] ?></th>
                            <th scope="col"><?php echo $data['date'] ?></th>
                            <th scope="col">
                                <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="complete" value="<?php echo $data['id'] ?>" class="btn btn-success"> Complete </button>
                                </form>
                                <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="edit" value="<?php echo $data['id'] ?>" class="btn btn-info"> Edit </button>
                                </form>
                                <form method="GET" action="index.php" class="d-inline">
                                <button type="submit" name="delete" value="<?php echo $data['id'] ?>" class="btn btn-danger"> Delete </button>
                                </form>
                            </th>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</html>