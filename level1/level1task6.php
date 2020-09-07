<?php
$filename = "visits.txt";
$number_of_visits = file_get_contents($filename);

if($number_of_visits == 0){
	echo "<center> Вы еще не посещали данную страницу, поэтому будем считать что Вы здесь впервые! </center>";
}else{
	echo "<center> Вы посетили данную страницу ".$number_of_visits." раз(а)! </center>";
}
file_put_contents($filename,$number_of_visits+1);