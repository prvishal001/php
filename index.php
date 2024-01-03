<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
		$name = "";
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$email = "";
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
		$website = "";
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<style>
	.form-data {
		border:20px solid blue;
		margin:auto;
		padding:22px;
		font-size:33px;
		background:rgb(222,222,222);
	}
	input{
		width:355px;
		height:50px;
		font-size:25px;
		
	}
	.btn {
		font-size:22px;
		margin:20px 0;
		background:blue;
		border:5px solid white;
		border-radius:11px;
		width:333px;
		color:white;
	}
	.btn:hover{
		border:5px solid blue;
		background:white;
		color:blue;
		cursor:pointer;
	}
	.gen {
		
	}
	.result {
		border:20px solid blue;
		margin:auto;
		padding:22px;
		font-size:33px;
		background:rgb(22,222,22);
		
	}
		
</style>

<div class="container">
	<form method="post"><table class="form-data"><tr><td>
		Name :</td><td> <input type="text" name="name"></td></tr><tr><td>
		Email :</td><td> <input type="email" name="email"></td></tr><tr><td>
		Website :</td><td> <input type="text" name="website"></td></tr><tr><td>
		Comment :</td><td> <input type="textarea" name="comment"></td></tr><tr><td>
		Gender :</td><td><label class="gen"><input type="radio" name="gender" value="male">Male<input type="radio" name="gender" value="female">Female</lable></td></tr><tr><td>
		<input type="submit" name="submit" value="Submit" class="btn" title="Click Here to Submit Form"></td><tr></table>
	</form>
</div>
<?php
echo "<table class='result'><tr><td>";
echo "Name :</td><td>".$name."</td></tr><tr><td>";
echo "Email :</td><td>".$email."</td></tr><tr><td>";
echo "Gender :</td><td>".$gender."</td></tr><tr><td>";
echo "Comment :</td><td>".$comment."</td></tr><tr><td>";
echo "website :</td><td>".$website."</td></tr><tr><td bgcolor='red'>Errors</td></tr><tr><td>";
echo "Name Error :</td><td>".$nameErr."</td></tr><tr><td>";
echo "Email Error :</td><td>".$emailErr."</td></tr><tr><td>";
echo "Gender Error :</td><td>".$genderErr."</td></tr><tr><td>";
echo "Website  Error :</td><td>".$websiteErr."</td></tr></table>";

?>