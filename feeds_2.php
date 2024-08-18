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

if(!empty($_POST))
{
	$faculty_id=$_POST['faculty_id'];
	//Fetch Name
	$name = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM faculty WHERE faculty_id='".$faculty_id."'"));
	$subject=$_POST['subject'];
	$sql=mysqli_query($al,"select * from feeds where faculty_id='$faculty_id' AND subject='$subject'");
	while($z=mysqli_fetch_array($sql))
	{
		$q1 = $q1 + $z['q1'];
		$q2 = $q2 + $z['q2'];
		$q3 = $q3 + $z['q3'];
		$q4 = $q4 + $z['q4'];
		$q5 = $q5 + $z['q5'];
		$q6 = $q6 + $z['q6'];
		$q7 = $q7 + $z['q7'];
		$q8 = $q8 + $z['q8'];
		$q9 = $q9 + $z['q9'];
		$q10 = $q10 + $z['q10'];
                $total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10;
		$s++;
             	
	}
        if ($s > 0) {
		$avg_total = $total / $s;
	} 
        else {
		$avg_total = 0; 	
             }
                     }
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

<div id="content" align="center" style="width:600px;">
<br>
<br>
<span class="SubHead">Faculty Feedback</span>
<br>
<br>

<table border="0" cellpadding="4" cellspacing="4">
<tr><td style="font-weight:bold;">Faculty Name : </td><td><?php echo $name['name'];?></td></tr>
<tr><td style="font-weight:bold;">Subject : </td><td><?php echo $subject;?></td></tr>
<tr>
            <td style="font-weight:bold;">1.The workload for assignments/projects given by this faculty?</td>
            <td><?php echo $q1; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">2.The fairness and transparency of the grading system used by this faculty?</td>
            <td><?php echo $q2; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">3.Faculty's engagement with students during lectures or discussions?</td>
            <td><?php echo $q3; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">4.Faculty's use of real-world examples or applications in lectures?</td>
            <td><?php echo $q4; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">5.Faculty's encouragement of critical thinking and problem-solving skills?</td>
            <td><?php echo $q5; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">6.Faculty's encouragement of students to think critically and analytically?</td>
            <td><?php echo $q6; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">7.Faculty's constructive feedback on assignments and exams?</td>
            <td><?php echo $q7; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">8.Faculty's encouragement of collaborative learning among students?</td>
            <td><?php echo $q8; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">9.Balance between theoretical concepts and practical applications in this faculty's teaching?</td>
            <td><?php echo $q9; ?></td>
        </tr>
        <tr>
            <td style="font-weight:bold;">10.Overall rating for this teacher, to help juniors understand if they should take their class?</td>
            <td><?php echo $q10; ?></td>
</tr>
<tr><td style="font-weight:bold;">Total Students :</td><td><?php echo $s;?></td></tr>
<tr><td style="font-weight:bold;">Avg_Total :</td><td><?php echo $avg_total;?></td></tr>
<tr><td style="font-weight:bold;" colspan="2" align="center">Comments</td></tr>
	<tr><td colspan="2">
    	<?php $cc = mysqli_query($al, "SELECT * FROM comments WHERE faculty_id = '".$faculty_id."' ORDER BY id DESC");
		while($pr = mysqli_fetch_array($cc))
		{
			echo "~".$pr['comment']."~";
		}
		?>
    </td>
    </tr>
</table>
<br>
<br>
<input type="button" onClick="window.print();" value="PRINT">&nbsp;<input type="button" onClick="window.location='feeds.php'" value="BACK">
<br>
<br>

</div>
</body>
</html>