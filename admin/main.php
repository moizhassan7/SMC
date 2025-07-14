<?php session_start();
if(isset($_SESSION['admin']))
{
include_once "links.html";
include_once "header.html";	
include_once "../config.php";
?>	
<div id="sidepanel" class="col-md-2 col-sm-2 col-xs-2" style="padding-left:0px; padding-right:0px;">
<a href="view_slider.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-th-large"></span><span id="moveview">Sldier</span></div>
</a>

<a href="view_news.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-th-list"></span><span id="moveview">News and Events</span></div>
</a>


<a href="view_downloads.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-remove-circle"></span><span id="moveview">Downloads</span></div>
</a>


<a href="view_notifications.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-share"></span><span id="moveview">Notifications</span></div>
</a>

<a href="view_faculties.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-tasks"></span><span id="moveview">Faculty</span></div>
</a>


<a href="view_departments.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-eye-open"></span><span id="moveview">Departments</span></div>
</a>
<a href="view_research.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-eye-open"></span><span id="moveview">Research</span></div>
</a>
<a href="manage_site_images.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-eye-open"></span><span id="moveview">Site Setting</span></div>
</a>

<a href="myprofile.php" target="iframea">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-user"></span><span id="moveview">Admin Profile</span></div>
</a>

<a href="logout.php">
<div class="col-md-12 col-sm-12 col-xs-12" id="menu"><span class="glyphicon glyphicon-log-out"></span><span id="moveview">Logout</span></div>
</a>

</div>

<div class="col-md-10 col-sm-10 col-xs-10" id="frame">
<iframe src="" name="iframea" frameborder="0"></iframe>
</div>
<?php
include_once "footer.html";
?>
</body>
</html>
<?php
} 
else
{
header('Location:index.php');	
}
?>