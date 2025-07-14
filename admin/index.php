<?php session_start();

if(isset($_SESSION['admin']))
{
	
	header('location:main.php');
	
	}
else
{
include_once "links.html";

include_once "headera.html";

?>

<div class="col-md-12 col-sm-12 col-xs-12" id="main">
<div class="col-md-4 col-sm-3 col-xs-3"></div>
<div id="loginpanel" class="col-md-4 col-sm-6 col-xs-6">

<h4 style="text-align:center; ">Login Your Admin Account</h4>

<form action="login.php" method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">UserName</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="UserName" name="uname">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="pass">
  </div>
  <br>
  <div class="form-group">
    <input type="submit" class="form-control center-block btn-primary" id="formGroupExampleInput2" value="Login Your Account">  
  </div>
<p style="margin-top:5px">
<a href="../index.php" style="color:#FFF;"><span style="margin-left:5px;">Cancel</span></a>
</p>
</form>
</div>
</div>


</body>
</html>

<?php
include_once "footer.html";
 } ?>
