<?php
require_once 'core/init.php';

$student = new Student();
$student->findAll('students');

$course = new Course();

$student_id = null;
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
    $courses = $course->filter_course_by_student($student_id);
}else{
    $course->findAll();
    $courses = $course->data();
}



if(Input::exists()){
    if(Token::check(Input::get('token'))) {
        pr($_POST);

        $validate = new Validate();
        $validate->check($_POST, array(
            'student_list' => array('required' => true),
            'course_list' => array('required' => true)
        ));

        if ($validate->passed()) {
            // $course = new Course();
            // try {
            //     $course->update(array(
            //         'course_name' => Input::get('course_name'),
            //         'course_details' => Input::get('course_details')
            //     ),$course_id);

            //     header('Location: course_list.php');
            // } catch(Exception $e) {
            //     pr($e);
            //     echo $e->getTraceAsString(), '<br>';
            // }
            $student = new Student();
            try {
                $student->create('students_subscribed_course',['student_id' => Input::get('student_list'),'course_id' => Input::get('course_list')]);
                header('Location: students_list.php');
            } catch(Exception $e) {
                pr($e);
                echo $e->getTraceAsString(), '<br>';
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
        <div class="row py-5">
            <div class="col-md-8 order-md-1">
                <form action="" method="post">
                    <h4 class="mb-3">Course Subscription</h4>    
                    <div class="form-row">
                        <div class="col">
                            <label for="sel1">Students</label>
                            <select class="form-control" id="student_list" name="student_list">
                                <option value="">Select Student</option>
                                <?php foreach($student->data() as $v){?>
                                    <option value="<?php echo $v->id;?>" <?php echo ($v->id == $student_id) ? "selected" : ""; ?>> <?php echo $v->fname;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="sel1">Courses</label>
                            <select class="form-control" id="course_list" name="course_list">
                                <option value="">Select Course</option>
                                <?php foreach($courses as $v){?>
                                    <option value="<?php echo $v->id;?>"> <?php echo $v->course_name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <button class="btn btn-primary mt-5" type="submit">Submit</button>
                    
                    <?php include('actions_view.php');?>

                </form>
            </div>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script>
        $('#student_list').on('change', function() {
            var url = window.location.href
            //var path = window.location.protocol+"://"+ window.location.host + window.location.pathname;
            //location.href = window.location.href + "?"+params;

            var url = window.location.href
            
            location.href = url.split('?')[0] + "?student_id=" +this.value;
        });
    </script>
  </body>
</html>
