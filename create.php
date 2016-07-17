<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $display_name = $_POST['display_name'];
        $position = $_POST['position'];
        $gc_seals = $_POST['gc_seals'];
         
        // validate input
        $valid = true;
        if (empty($display_name)) {
            $nameError = 'Please enter Display Name';
            $valid = false;
        }
         
        if (empty($position)) {
            $emailError = 'Please enter Ṕosition';
            $valid = false;
        }
         
        if (empty($gc_seals)) {
            $mobileError = 'Please enter GC Seals';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $sql = "INSERT INTO members (display_name,position,gc_seals) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($display_name,$position,$gc_seals));
            Database::disconnect();
            header("Location: mutleyafkceles.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="stylesheets/bootstrap.min.css" rel="stylesheet">
    <script src="javascripts/bootstrap.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="display_name" type="text"  placeholder="Display Name" value="<?php echo !empty($display_name)?$display_name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Position</label>
                        <div class="controls">
                            <input name="position" type="text" placeholder="Position" value="<?php echo !empty($position)?$position:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">GC Seals</label>
                        <div class="controls">
                            <input name="gc_seals" type="text"  placeholder="Mobile Number" value="<?php echo !empty($gc_seals)?$gc_seals:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="mutleyafkceles.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>