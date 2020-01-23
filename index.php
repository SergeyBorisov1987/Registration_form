<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="add/style.css" type="text/css">

    <title>CRUD</title>
</head>
<body>
<?php require_once ('crud.php');
error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');
?>
<!--#################################################################################################################-->
<!--#################################################################################################################-->
<div class="container-fluid">
    <form  method="POST" action="crud.php" enctype="multipart/form-data">
        <div class="form-group">
            <label class="label" for="exampleInputEmail1">Name</label>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="name" value="<?php echo $user; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Required for filling" required>
        </div>
        <div class="form-group">
            <label class="label" for="exampleInputEmail1">Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Required for filling" required>
        </div>
        <div class="mb-3">
            <label class="label" for="validationTextarea">Comment</label>
                <textarea class="form-control is-invalid" name="text" id="validationTextarea" placeholder="Required for filling" required><?php echo $comment; ?></textarea>
        </div>
        <div class="custom-file">
            <label class="label" for="validationTextarea">Choose file</label>
                <input type="file" name="file" class="custom-file-input" id="customFile" required>
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div><br/><br/>
        
            <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
            <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
        <?php if ($update == true): ?>
            <button type="submit" name="update" class="btn btn-secondary">Update</button>
        <?php endif; ?>
    </form>
    <br/><br/><hr/>
</div>
<!--#################################################################################################################-->
<!--#################################################################################################################-->
<?php while ($row = $stmt->fetch()):?>
<div class="card">
    <div class="card-header">
        <h4>CRUD</h4>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p><?php echo "Name of user: <b>". $row['name']."</b><br/>";?></p>
        <?php  if(isset ($_GET['show'])): ?>
            <p><?php echo "Email of user: <b>". $row['email']."</b><br/>";?></p>
            <p><?php echo "Comment of user: <b>". $row['text']."</b><br/>";?></p>
            <p><?php echo "Name of uploaded file: <b>". $row['fname']."</b><br/>";?></p>
            <p><?php echo "Path of uploaded file: <b>". $row['file_path']."</b><br/>";?></p>
        </blockquote>
    </div>
    <?php  endif; ?>
    <div class="card-header">
        <a href="index.php?show=<?php echo $row['id'];?>"><img src="icons/eye.png"/></a>  
        <a href="index.php?edit=<?php echo $row['id'];?>"><img src="icons/pen.png"/></a>  
        <a href="index.php?delete=<?php echo $row['id'];?>"><img src="icons/delete.png"/></a>
    </div>

</div>
<?php endwhile;?>
<!--#################################################################################################################-->
<!--#################################################################################################################-->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>