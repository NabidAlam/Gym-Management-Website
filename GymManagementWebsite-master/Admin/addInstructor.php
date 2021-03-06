<?php 
session_start();
include_once '../Include/class.Admin.php';
$admin = new Admin(); $id = $_SESSION['id'];
if (!$admin->get_admin_session()){
 header("location: ../Admin/adminLogin.php");
}

if (isset($_GET['q'])){
 $admin->admin_logout();
 header("location: ../Admin/adminLogin.php");
}
 ?>
<?php
include_once '../Include/class.Admin.php';
$admin = new Admin();

    if (isset($_REQUEST['submit'])){
        extract($_REQUEST);
        $instructor = $admin->add_instructor($name, $package, $qualification);
        if ($instructor) {
            // Registration Success
            echo "<script>alert('/instructor Added')</script>";
            header("location: ../Admin/viewInstructor.php");
        } else {
            // Registration Failed
            echo "<script>alert('Already exists')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Instructor</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  
	<script type="text/javascript">
	var ar_ext = ['JPEG', 'JPG', 'jpeg', 'jpg', 'PNG', 'png'];        // array with allowed extensions

	function checkName(el) {

	  // get the file name and split it to separe the extension
	  var name = el.value;
	  var ar_name = name.split('.');

	  // check the file extension
	  var re = 0;
	  for(var i=0; i<ar_ext.length; i++) {
	    if(ar_ext[i] == ar_name[1]) {
	      re = 1;
	      break;
	    }
	  }

	  // if re is 1, the extension is in the allowed list
	  if(re==1) {


	  }
	  else {
	    // delete the file name, disable Submit, Alert message
	    el.value = '';
	    alert('".'+ ar_name[1]+ '" is not an file type allowed for upload');
	  }
	}
	</script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once("include_templates/navigation.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             Add Instructor
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">

                    <form class="col-md-12"  name="instructor" action='addinstructor.php' method='post' enctype="multipart/form-data">

                                    <div class="form-group" >
				        <input type="text" name="name" class="form-control input-lg" placeholder="Name" required="required">
				    </div>
                        
                                    <div class="form-group" >
                                           <select name="package" required="required" class="form-control input-lg">
                                            <option>
                                              <?php
                             
                                        mysql_connect('localhost','root','');

                                        mysql_select_db('gym');

                                        $sql="SELECT * FROM package";
                                        $result=  mysql_query($sql);

                                        while($package_row=  mysql_fetch_array($result))
                                        {
                                           $package_id = $package_row['id'];
                                           $package_name = $package_row['name'];

                                            echo "<option value='$package_id'>$package_name</option>";
                                        }

                                        echo "</select>";

    
                                              ?>
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                            <textarea type="text" name="qualification" rows="3" class="form-control input-lg"></textarea>
                                    </div>
                                    <div class="form-group">
				        <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value='Save' >
				    </div>
                    </form>
                </div>
                         
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
