<?php
include("configASL.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:index.php");
}
$aid=$_SESSION['aid'];
$x=mysqli_query($al,"select * from admin where aid='$aid'");
$y=mysqli_fetch_array($x);
$name=$y['name'];

// Fetch faculty list ordered by average total score
$faculty_query = "SELECT faculty_id, name, AVG(total) AS avg_total FROM feeds GROUP BY faculty_id ORDER BY avg_total DESC";
$faculty_result = mysqli_query($al, $faculty_query);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Faculty Feedback System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="topHeader">
	VIT KMS PROJECT<br />
    <span class="tag">KNOWLEDGE CONNECT</span>
</div>
<br>
<br>
<br>
<br>

<div id="content" align="center">
<br>
<br>
<span class="SubHead">View Student Feedback on Faculty</span>
<br>
<br>

<form method="post" action="feeds_2.php" >
<div id="table"> 
    <div class="tr">
		<div class="td">
        	<label>Faculty : </label>
        </div>
        <div class="td">
			<select name="faculty_id" required>
            <option value="NA" disabled selected> - - Select Faculty - -</option>
            <?php while($faculty_row=mysqli_fetch_array($faculty_result)) { ?>
             <option value="<?php echo $faculty_row['faculty_id'];?>"><?php echo $faculty_row['name'];?> (Average Score: <?php echo $faculty_row['avg_total'];?>)</option>
             <?php } ?>
            </select>
        </div>
    </div>
     <div class="tr">
     <div class="td">
        	<label>Subject : </label>
        </div>
        <div class="td">

     <div class="td">
			<select name="subject" required>
            <option value="NA" disabled selected> - - Select Subject - -</option>
            <?php
			$x=mysqli_query($al,"select * from faculty");
			while($y=mysqli_fetch_array($x))
			{
			 ?>
             <option value="<?php echo $y['s1'];?>"><?php echo $y['s1'];?></option>
             <option value="<?php echo $y['s2'];?>"><?php echo $y['s2'];?></option>
             
             <?php } ?>
                </select>
        </div>
      </div>
</div>
</div>
		
        <div class="tdd">
        	<input type="button" onClick="window.location='home.php'" value="BACK">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="NEXT" />
        </div>
    
    <br>
</div>
</form>

</div>
</body>
</html>