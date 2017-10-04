<php
require_once('config.php');
function is_valid_email($mail)
{
	if(empty($mail))
	{
		echo"Enter your Email id";
		return false;
	}
	else
	{
		$email=test_input($mail);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
           echo "Invalid email format."; 
           return false;
    	} 

     $slquery = "SELECT 1 FROM register WHERE email = '$email'";
     $selectresult = mysql_query($slquery);
     	if(mysql_num_rows($selectresult)>0)
      	{
       		echo 'This email already exists.';
       		return false;
      	}
     		return true;
    }
}

function is_valid_passwords($password,$confirmpasword) 
{
    	 if (empty($password)) 
     	{
         echo "Password is required.";
         return false;
     	} 
     	else if ($password != $confirmpassword)
     	{
         echo 'Your passwords do not match. Enter again.';
         return false;
     	}
         return true;
}
function create_user($username, $password, $confirmpassword, $email) 
{
      $query = "INSERT INTO `user` (username, password, confirmpassword, email) VALUES ('$username', '$password', '$cpassword', '$email')";
      $result = mysql_query($query);
      if($result)
      {
          return true;
      }
      else
      {
          return false; 
      }
}


if (isset($_POST['username']) && isset($_POST['password']))
{


    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if (is_valid_email($email) && is_valid_passwords($password,$confirmpassword))
    {
        if (create_user($username, $password, $confirmpassword, $email))
        {
              echo 'Registered Successfully.';
        }
        else
        {
          echo 'Error Registering User!';
        }
    }
  ?> 
?>