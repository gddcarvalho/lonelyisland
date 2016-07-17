<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: mutleyafkceles.php");
    } else {
        $pdo = Database::connect();
        $sql = "SELECT * FROM members where id = ?";
        Database::disconnect();
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
                        <h3>Read a Member</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Display Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['display_name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Position</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['position'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">GC Seals</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['gc_seals'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="mutleyafkceles.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>