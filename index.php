<!DOCTYPE html>

<?php
include_once  'includes/functions.php';

?>


<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Web Programming using PHP TMA Mikolaj Marczak</title>
		<p>Web Programming Using PHP TMA</p>
    </head>
    <body>
		<?php
		#opens the data file
		$handle = fopen('data/DTT1.txt', 'r');
		
		
		
		#prints out first line of data file in appropriate format
		if ($handle) { 
			
			$line1 = fgets($handle);
			$moduleDetails = explode(',', $line1);
			$moduleDetails = array_map('trim', $moduleDetails);#this array_map to trim idea is from StackOverflow: https://stackoverflow.com/questions/5762439/how-to-trim-white-spaces-of-array-values-in-php 6/12/18
			
			#print module details or appropriate errors:
			
			if($moduleDetails[0]=== 'PP' OR $moduleDetails[0]=== 'P!' OR $moduleDetails[0]=== 'DT'){
				echo '<p>'.'Module Code: '.$moduleDetails[0].'</p>';
			}elseif(empty($moduleDetails[0]) OR ctype_space($moduleDetails[0])){
				echo '<p>'.'Module Code: '.'//Module code is missing!'.'</p>';
			}else{
				echo '<p>'.'Module Code: '.$moduleDetails[0].'//Wrong module code!'.'</p>';
			}
			
			if($moduleDetails[1]=== 'Problem Solving for Programming' OR $moduleDetails[1]=== 'Web Programming using PHP' OR $moduleDetails[1]=== 'Introduction to Database Technology'){
				echo '<p>'.'Module Title: '.$moduleDetails[1].'</p>';
			}elseif(empty($moduleDetails[1]) OR ctype_space($moduleDetails[1])){
				echo '<p>'.'Module Title: '.'//Module title missing!'.'</p>';
			}else{
				echo '<p>'.'Module Title: '.$moduleDetails[1].'//Please make sure the module title is correct!'.'</p>';
			}
			
			if(ctype_alpha(str_replace(' ', '', $moduleDetails[2]))){
				echo '<p>'.'Tutor name: '.$moduleDetails[2].'</p>';
			}elseif(empty($moduleDetails[2]) OR ctype_space($moduleDetails[2])){
				echo '<p>'.'Tutor name: '.'//Tutor name is missing!'.'</p>';
			}else{
				echo '<p>'.'Module Code: '.$moduleDetails[0].'//Wrong module code!'.'</p>';
			}	
			
			if($moduleDetails[0]=== 'PP' OR $moduleDetails[0]=== 'P!' OR $moduleDetails[0]=== 'DT'){
				echo '<p>'.'Module Code: '.$moduleDetails[0].'</p>';
			}elseif(empty($moduleDetails[0]) OR ctype_space($moduleDetails[0])){
				echo '<p>'.'Module Code: '.'//Module code is missing!'.'</p>';
			}else{
				echo '<p>'.'Module Code: '.$moduleDetails[0].'//Wrong module code!'.'</p>';
			}			
			
				#echo '<p>'.'Module Code: '.$moduleDetails[0].'</p>'. 
				#	'<p>'.'Module Title: '.$moduleDetails[1].'</p>'.
				#	'<p>'.'Tutor Name: '.$moduleDetails[2].'</p>'.
				#	'<p>'.'Date marking was done: '.$moduleDetails[3].'</p>';
						
		}else{		
			echo '<p>Error - could not open file.</p>';
					
		}
		

		
		#prints out student IDs and their grade, number of students assessed and returns number 
		#of each grade
		if ($handle) { 
			$count = 0;
			$distinction = 0;
			$merit = 0;
			$pass = 0;
			$fail = 0;
			$wrongGrade = 0;
			$iderror = 0;
			$gradesOnly = array(); #will use it to calculate mean, median, mode and range
			while(!feof($handle)){	
					$students = fgets($handle, 1024);
					$grades = explode(',', $students);
					$count++;
					array_push($gradesOnly,trim($grades[1]));		
					
						if (!is_numeric(trim($grades[1])) OR ($grades[1] < 0 OR $grades[1] > 100)){
								$wrongGrade++;
						}elseif ($grades[1] >= 70 && $grades[1] <= 100){
								$distinction++;
						}elseif($grades[1] >= 60 && $grades[1] <=69){
								$merit++;
						}elseif($grades[1] >= 40 && $grades[1] <=59){
								$pass++;
						}elseif($grades[1] < 40 && $grades[1] >0){
								$fail++;

						}
				
						
				#check student ID and grade for correctness, every case taken into account
		
					if (is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0 && is_numeric(trim($grades[0])) && strlen($grades[0]) === 8){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'</p>';
					}elseif((is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0) && (is_numeric(trim($grades[0])) && strlen($grades[0]) > 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Student number too long'.'</p>';	
						$iderror++;
					}elseif((is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0) && (is_numeric(trim($grades[0])) && strlen($grades[0]) < 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Student number too short'.'</p>';
						$iderror++;
					}elseif((is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0]) > 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Student number too long and contains unacceptable characters'.'</p>';
						$iderror++;
					}elseif((is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0]) < 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Student number too short and contains unacceptable characters'.'</p>';		
						$iderror++;
					}elseif((is_numeric (trim($grades[1])) && $grades[1] <= 100 && $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0]) === 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Student number contains unacceptable characters'.'</p>';	
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && is_numeric(trim($grades[0])) && strlen($grades[0]) === 8){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade.'.'</p>';
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0]) === 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade and unacceptable characters in the student number'.'</p>';
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && (is_numeric(trim($grades[0])) && strlen($grades[0]) > 8)){		
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade and student number too long'.'</p>';
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && (is_numeric(trim($grades[0])) && strlen($grades[0]) < 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade and student number too short'.'</p>';
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0]) > 8)){
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade, student number too long and contains unacceptable characters'.'</p>';
						$iderror++;
					}elseif((!is_numeric (trim($grades[1])) OR $grades[1] <= 100 OR $grades[1] >= 0) && (!is_numeric(trim($grades[0])) && strlen($grades[0] < 8))){	
						echo '<p>'.'Student ID: '.$grades[0].' Grade: '.$grades[1].'//Attention! Incorrect grade, student number too short and contains unacceptable characters'.'</p>';	
						$iderror++;
					}
	}
		}else{		
			echo '<p>Error - could not open file.</p>';
				
		}
		
		echo '<p>'.'Number of students assessed: '.$count.'</p>';
		
		#prints out number of each grade 
		echo '<p>'.'Distinctions: '.$distinction.'</p>';
		echo '<p>'.'Merits: '.$merit.'</p>';
		echo '<p>'.'Passes: '.$pass.'</p>';
		echo '<p>'.'Fails: '.$fail.'</p>';
		echo '<p>'.'Incorrectly marked: '.$wrongGrade.'</p>';
		echo '<p>'.'Data error: '.$iderror.'</p>';
		
		#prints out mean, most frequent and range
		#print_r($gradesOnly);
		#var_dump ($gradesOnly);
		#var_dump ($grades[1]);
		#$grades[1] >=0 && $grades[1] <=100 && 
		
		
		$mean = mmmr($gradesOnly, 'mean');
		$median = mmmr($gradesOnly, 'median');
		$mode = mmmr($gradesOnly, 'mode');
		$range = mmmr($gradesOnly, 'range');
		
		echo '<p>'.'Mean Mark: '.round($mean).'</p>';
		echo '<p>'.'Median Mark: '.$median.'</p>';
		echo '<p>'.'Mode Mark: '.$mode.'</p>';
		echo '<p>'.'Range: '.$range.'</p>';
		
		
#		while (!feof($handle)) {
#			$info = fgets($handle);
#		echo '<p>' . $info . '</p>';
#		}
#		fclose($handle);
		
		
		
#		while(false !== ($file = readdir($handle))){
#			echo '<p>' . $file . '</p>';
#		}
#		closedir($handle);
		
		
		
		

		
		?>
    </body>
</html> 