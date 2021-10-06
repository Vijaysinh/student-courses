<?php
require_once 'core/init.php';
$isError = '';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            'fname' => array('required' => true,'min' => 1,'max' => 20,'name' => 'First Name'),
            'lname' => array('required' => true,'min' => 1,'max' => 20,'name' => 'Last Name'),
            'phone' => array(
                'required' => true,
                'min' => 1,
                'max' => 10,
                'unique'=>'students'),
            'dob' => array('required' => true)
        ));
        
        if ($validate->passed()) {
            $student = new Student();
            try {
                $student->create('students',['fname' => checkInput(Input::get('fname')),'lname' => checkInput(Input::get('lname')),
                'dob' => date('Y-m-d',strtotime(Input::get('dob'))),
                'phone' => checkInput(Input::get('phone'))]);
                
                header('Location: students_list.php');
            } catch(Exception $e) {
                $isError = $e->getMessage();
            }
        } 
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="bootstrap-sidebar/css/style.css">

    <title>Add New Student</title>
  </head>
  <body class="bg-light">
    <div class="wrapper d-flex align-items-stretch">
            <?php include("menu/side_bar.php");?>

             <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
                </button>
                <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul> -->
                </div>
            </div>
            </nav>

            <h2 class="mb-4">Add New Student</h2>

                    <?php if(isset($validate) && $validate->errors()){
                            foreach ($validate->errors() as $error) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?php  echo $error . "<br>";?>
                                </div>
                    <?php }}?>
                    
                    <?php if(isset($isError) && $isError!=''){  ?>
                    <div class="alert alert-danger" role="alert">
                        <?php  echo $isError . "<br>";?>
                    </div>
                    <?php }?>
        

                    
                        <div class="col-md-8 order-md-1">
                            <form action="" method="post">

                                <div class="mb-3">
                                    <label for="username">First Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" maxlength="20" required="">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="username">Last Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" maxlength="20" required="">
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="username">Contact No</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact No" maxlength="10" required="">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="dob">DOB</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Birthday" required="">
                                    </div>
                                </div>
                                
                                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                                <button class="btn btn-primary" type="submit">Submit</button>
                                
                                <?php //include('actions_view.php');?>

                            </form>
                        </div>
                    
            </div>
    </div>

    
            
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="bootstrap-sidebar/js/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-sidebar/js/main.js"></script>                  
    
  </body>
</html>
