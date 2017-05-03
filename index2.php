<!DOCTYPE html>
<html>
<head>
	<title>TO-DO</title>
	<style>
    body {
        margin: 1em auto;
        max-width: 30em;
        padding: 0 .62em;
        /*font: 1.2em/1.62em sans-serif;*/
    }
    ul li {
    	margin: 1em 5em;
    }
    /*  h1, h2, h3 {
        line-height: 1.2em;
    }
    @media print {
        body {
            max-width: none
        }
    }
    li.task-done > a {
        text-decoration: line-through
    }
        li.urgent {
        background-color: red;
    }
       li.urgent > a {
        color: white;
    }*/
</style>
</head>
<h2 style="text-align: center">Task info</h2>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?> 
<?php
		$arrays=[];
	$filereading = fopen('todo.csv', 'r');
		while (($array = fgetcsv($filereading)) !== false) {
			$array = array (
				'title' => $array['0'],
				'text' => $array['1'],
				'date' => $array['2'],
				'priority' => $array['3']
				);
			$arrays[] = $array;
		};
	fclose($filereading);

		foreach ($arrays as $key => $value) :
			echo '<ul>';
			echo '<li>';
			echo '<a href="index2.php?op=task&id='.$key.'">'.$value['title'].'</a><br/>';
			echo $value['text'].'<br/>';
			echo date('Y-m-d', $value['date']).'<br>';
			echo $value['priority'].'<br/>';
			echo '</li>';
			echo '</ul>';
			// echo "<a href='index2.php' style='margin-right: 20px;'>Atlikta</a>";
			echo "<a href='index2.php?op=delete'>Delete</a>";
		endforeach;
			
	if (array_key_exists('text', $_POST) && array_key_exists('title', $_POST)) :
			if ($_POST['title']!==""||$_POST['text']!=="") {
				if (isset($_POST['submit'])) :
					$date = mktime(0, 0, 0, $_POST['month'],$_POST['day'],$_POST['year']);
					$array = array (
						'title' => $_POST['title'],
						'text' => $_POST['text'],
						'date' => $date,
						'priority' => $_POST['priority']
						);
					$arrays[] = $array;
				$dabar = time();
			if ($dabar < $date) {
				echo '<h3 style="background-color: yellow;">Dar neatejo</h3>';
			}else {
				echo '<h3 style="background-color: red;">Jau praejo</h3>';
			}			
				endif;
			}
		endif;	
?>
<body style="text-align: center;">
<article>	
	<!-- <li class="urgent">
        <a href="index.php?op=task&amp;id=0"></a></li>
	<li class="urgent">
         <a href="index.php?op=task&amp;id=1"></a></li>
	<li class="urgent">
        <a href="index.php?op=task&amp;id=2"></a></li> -->
		
<form  action="index2.php?op=new-task" method="post">
	<div>
		<label for="title" style="margin-top: 20px; padding: 4px;"">Title </label>
			<input type="text" id="title" name="title" style="margin: 20px; padding: 4px; width: 50%"><br>
	</div>
	<div>
		<label for="text">Text</label>
			<textarea type="text" id="text" name="text" cols=45 rows=10 style="margin: 10px"></textarea><br>
	</div>
	<div>
	<label for="deadline">Deadline </label>
		<select name="day">
			<option value='1'>01</option>
			<option value='2'>02</option>
			<option value='3'>03</option>
			<option value='4'>04</option>
			<option value='5'>05</option>
			<option value='6'>06</option>
			<option value='7'>07</option>
			<option value='8'>08</option>
			<option value='9'>09</option>
			<option value='10'>10</option>
			<option value='11'>11</option>
			<option value='12'>12</option>
			<option value='13'>13</option>
			<option value='14'>14</option>
			<option value='15'>15</option>
			<option value='16'>16</option>
			<option value='17'>17</option>
			<option value='18'>18</option>
			<option value='19'>19</option>
			<option value='20'>20</option>
			<option value='21'>21</option>
			<option value='22'>22</option>
			<option value='23'>23</option>
			<option value='24'>24</option>
			<option value='25'>25</option>
			<option value='26'>26</option>
			<option value='27'>27</option>
			<option value='28'>28</option>
			<option value='29'>29</option>
			<option value='30'>30</option>
			<option value='31'>31</option>
		</select> 
		<select name="month">
			<option value='1'>January</option>
			<option value='2'>February</option>
			<option value='2'>March</option>
			<option value='4'>April</option>
			<option value='5'>May</option>
			<option value='6'>June</option>
			<option value='7'>July</option>
			<option value='8'>August</option>
			<option value='9'>September</option>
			<option value='10'>October</option>
			<option value='11'>November</option>
			<option value='12'>December</option>
		</select> 
		<select name="year">
			<option value='2017'>2017</option>
			<option value='2018'>2018</option>
			<option value='2019'>2019</option>
		</select><br>
	</div>
	<div>
	<label for="priority">Priority </label>
		<label for="priority_low">
			<input type="radio" id="priority_low" name="priority" value="low" style="margin-top: 10px"> Low
		</label>
		<label for="priority_normal">
			<input type="radio" id="priority_normal" name="priority" value="normal" checked=""> Normal
		</label>
		<label for="priority_high">
			<input type="radio" id="priority_high" name="priority" value="high"> High
		</label>
	</div>
		<br/>
		<input type="submit" name="submit" value="SUBMIT" style="margin: 20px; padding: 4px; background-color: GhostWhite ;">
</form>
</body>
</html>

<?php
	$write = fopen('todo.csv', 'w');
		foreach ($arrays as $key) {
			fputcsv($write, [$key['title'], $key['text'], $date, $key['priority']]);
			//$arrays = [$key['title'], $key['text'], $date, $key['priority']
			//	];
			//	fputcsv($write, $arrays);
		};
			fclose($write);	
?>