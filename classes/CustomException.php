<?php
class CustomException extends Exception {
    public function error_message() {
      $error_msg = 'Error caught on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage().'</b> is no valid input.';
      return $error_msg;
    }
}

// try {
//   if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
//     //throwing an exception
//     throw new CustomException($email);
//   }
// } catch (CustomException $e) {
//   echo $e->error_message();
// }


function myException($exception) {
  echo "<b>Exception is </b> " . $exception->getMessage();
}
set_exception_handler('myException');

$email = 'test.com';
try {
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
    throw new Exception('EmailID IS NOT CORRECT.');
  }
} catch (CustomException $e) {
  echo $e->error_message();
}
?>