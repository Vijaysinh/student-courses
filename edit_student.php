<?php
require_once 'core/init.php';


$student_id = $_GET['id'];
$isError = '';
if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            'fname' => array('required' => true),
            'lname' => array('required' => true),
            'dob' => array('required' => true),
            'phone' => array('required' => true,'unique'=>'students')
        ));
        
        if ($validate->passed()) {
            $student = new Student();
            
            try {

                $student->update('students',array(
                    'fname' => Input::get('fname'),
                    'lname' => Input::get('lname'),
                    'phone' => Input::get('phone'),
                    'dob' => date('Y-m-d',strtotime(Input::get('dob')))),$student_id);

                header('Location: students_list.php');
            } catch(Exception $e) {
                //pr($e);
                $isError = $e->getMessage();
                //echo $e->getTraceAsString(), '<br>';
            }
        } 
        
        
        // else {
        //     foreach ($validate->errors() as $error) {
        //         echo $error . "<br>";
        //     }
        // }
    }
}
$student = new Student();
$student_detail = $student->findByID('students',$student_id);

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

    <title>Student Update</title>
  </head>
  <body class="bg-light">
    <div class="container">

    <?php if(isset($validate) && $validate->errors()){
                    foreach ($validate->errors() as $error) { ?>
                        <div class="alert alert-danger" role="alert">
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
            <form action="" method="post">

                <div class="mb-3">
                    <label for="username">First Name</label>
                    <div class="input-group">
                        <input type="text" value="<?php echo $student->data()->fname; ?>" class="form-control" id="fname" name="fname" placeholder="First Name" required="">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username">Last Name</label>
                    <div class="input-group">
                        <input type="text" value="<?php echo $student->data()->lname; ?>" class="form-control" id="lname" name="lname" placeholder="Last Name" required="">
                    </div>
                </div>


                <div class="mb-3">
                    <label for="username">Contact No</label>
                    <div class="input-group">
                        <input type="text" value="<?php echo $student->data()->phone; ?>" class="form-control" id="phone" name="phone" placeholder="Contact No" required="">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="dob">DOB</label>
                    <div class="input-group">
                        <input type="text" value="<?php echo date('m/d/Y',strtotime($student->data()->dob)); ?>" class="form-control" id="dob" name="dob" placeholder="Birthday" required="">
                    </div>
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <button class="btn btn-primary" type="submit">Submit</button>

                <?php include('actions_view.php');?>

                </form>
            </div>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <!--
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
     Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script>
        $(document).ready(function() {
            $('#dob').datepicker();
        });
    </script>
  </body>
</html>
