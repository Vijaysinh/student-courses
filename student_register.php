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

    <title>Student Courses</title>
  </head>
  <body class="bg-light">
    <div class="container">
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
        

        <div class="row py-5">
            <div class="col-md-8 order-md-1">
                    <h1>Add New Student</h1>
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
                    
                    <?php include('actions_view.php');?>

                </form>
            </div>
        </div>
    </div>
    <?php include('js_loader.php');?>                    
    
  </body>
</html>
