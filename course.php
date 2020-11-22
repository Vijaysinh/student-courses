<?php
require_once 'core/init.php';

if (Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            'course_name' => array('required' => true),
            'course_details' => array('required' => true)
        ));
        
        if ($validate->passed()) {
            $course = new Course();
            try {
                $course->create(['course_name' => Input::get('course_name'),'course_details' => Input::get('course_details')]);
                header('Location: course_list.php');
            } catch(Exception $e) {
                pr($e);
                echo $e->getTraceAsString(), '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                //echo $error . "<br>";
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
            
            
        

        <div class="row py-5">
            <div class="col-md-8 order-md-1">
                <form action="" method="post">
                    <h1>Add New Course</h4>    

                    <div class="mb-3">
                        <label for="username">Course Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" required="">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Course Details</label>
                        <div class="input-group">
                        <textarea class="form-control" id="course_details" name="course_details" rows="3" placeholder="Course Details"></textarea>
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
  </body>
</html>
