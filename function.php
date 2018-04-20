<?php
	function log_in_view($cook){
		if((!isset($cook)) OR (empty($cook)) OR ($cook == NULL)){

			echo "<li><a href='index.php?page=login'><i class='glyphicon glyphicon-lock'></i> Вход</a>

			</li>";	
		}
		else{
			$select = new select('users');
			$result = $select->selectByLogin($cook);
			echo '<li>
                <a href="#"><img src="views/img/'.$result['avatar'].'" width="30px" height="25px"> <b class="caret">'.$cook.'</b></a>
                <ul class="submenu">
                    <li><a href="logout.php">Выход <i class="glyphicon glyphicon-share-alt"></i></a></li>
                </ul>
            </li>';
		}
	}

	function watch($id,$table){
	if(isset($id))
		{
			$update = new update($table);
			$res = $update->increment('watch',$id);
		}
	}

	function writer_user($id){
		$select_user = new select('users');
		$res = $select_user->selectByid($id);

		return $res['login'];
	}

	function popular_posts($table)
	{
		$select = new select($table);
		$result = $select->selectBylimit();
		for($i=0;$i<count($result);$i++)
		{
			echo '<li><img src="views/'.$result[$i]['img'].'" width="40px" height="40px"> <a href="index.php?page=news&id='.$result[$i]['id'].'"><b>'.$result[$i]['title'].'</b><br>
						'.mb_substr($result[$i]['text'], 0,140,'UTF-8').'</a>
						</li>';
		}
		
	}

function input_images($id)
{
	$select = new select('images');
	$result = $select->selectByid($id);
	return $result['path'];
}

function show_coachs($by_select,$table){
	$select = new select($table);
	$result = $select->select_unlimit($by_select);
	for($i=0;$i<count($result);$i++)
	{
		echo "<tr>
			<td>".$result[$i]['id']."</td>
			<td>".$result[$i]['fio']."</td>
			<td>".$result[$i]['sex']."</td>
			<td>".$result[$i]['birth']."</td>
			<td>".$result[$i]['cols_pupils']."</td>
		</tr>";
	}
}

function show_sportsman($by_select,$table){
	$select = new select($table);
	$result = $select->select_unlimit($by_select);
	for($i=0;$i<count($result);$i++)
	{
		echo "<tr>
			<td>".$result[$i]['id']."</td>
			<td>".$result[$i]['fio']."</td>
			<td>".$result[$i]['sex']."</td>
			<td>".$result[$i]['birth']."</td>
			<td>".$result[$i]['rank']."</td>
		</tr>";
	}
}

function show_news(){
	$select = new select('news');
	$result = $select->select();
	for($i=0;$i<count($result);$i++)
	{
		echo '<figure class="white">
					<a href="index.php?page=news&id='.$result[$i]['id'].'">
						<img src="views/img/news/'.$result[$i]['img'].'" alt="" />
						<dl>
							<dt>'.mb_substr($result[$i]['title'], 0,25,"UTF-8").'</dt>
							<dd>'.mb_substr($result[$i]['text'], 0,60,"UTF-8").'</dd>	
								</dl>
						
                         <div id="wrapper-part-info">
                           <div class="part-info-image"><img src="views/img/icon-psd.svg" alt="" width="28" height="28"/></div>
                            	<div id="part-info">'.mb_substr($result[$i]['title'], 0,20,"UTF-8").'</div>
                            	<div id="part-info-datetime">Дата: '.$result[$i]['datetime'].'</div>
					</div>
					</a>
                   </figure>';
	}
}

function show_one_news($id){
	$select = new select('news');
	$result = $select->selectByid($id);
	echo '	
	<tr>
	<td><img src="views/img/news/'.$result['img'].'" height="80px" width="80px">
								<label><h3>'.$result['title'].'</h3></label>
							</td>
							<td rowspan="3">
								<hr>
								<label for="date">Добавил</label>
								<conteiner id="date"><b><img src="views/img/'.avatars($result['id_login']).'" height="25px" width="25x">'.writer_user($result['id_login']).'</b></conteiner><br><br>
								<label for="date"></label>
								<conteiner id="date">Добавлено: <b>'.$result['datetime'].'</b></conteiner>
							</td>
						</tr>
						<tr>
							<td class="bodynews"><hr>
							 '.$result['text'].'
							</td>
						</tr>
						<tr>
							<td>Просмотров: '.$result['watch'].' | Комментариев: '.$result['comments'].'</td>
						</tr>
						';
}


	function avatars($id)
	{
		$select = new select('users');
		$result = $select->selectByidImg($id);

		return $result['avatar'];
	}
	function show_single($id){
		$select = new select('subs');
		$result = $select->selectByid($id);

			echo '            <article>
	                <h3 class="title-bg"><a href="#">'.$result['title'].'</a></h3>
	                <div class="post-content">
	                    <a href="#"><img src="views/'.avatars($result['id_user']).'" id="avatar"></a>

	                    <div class="post-body">
	                        <p>'.$result['text'].'</p>

	                        <p class="well">'.$result['ps'].'</p>

	                       <blockquote>
	                            '.$result['citation'].'
	                       </blockquote>

	                       <p>'.$result['conclusion'].'</p>
	                    </div>

	                    <div class="post-summary-footer">
	                     <div class="bottom-singlePage">
	                        <ul class="post-data">
	                            <li><i class="glyphicon glyphicon-calendar"></i>'.$result['date'].'</li>
	                            <li><i class="glyphicon glyphicon-user"></i> <a href="#">'.writer_user($result['id_user']).'</a></li>
	                            <li><i class="glyphicon glyphicon-comment"></i> '.$result['answers'].'</li>
	                            <li><a href="controllers/likes.php?ret=single&table=subs&idsubs='.$id.'&like='.$result['id'].'"><i class="glyphicon glyphicon-thumbs-up"></i></a> <a href="controllers/likes.php?ret=single&table=subs&idsubs='.$id.'&dislike='.$result['id'].'"><i class="glyphicon glyphicon-thumbs-down"></i></a> '.$result['likes'].'</li> <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i></a>'.$result['watch'].'</li>
	                        </ul>
	                        </div>
	                    </div>
	                </div>
	            </article>';
	}
	function count_com($id)
	{
		$select = new select('subs');
		$result = $select->selectByid($id);

		return $result['answers'];
	}
	function show_comments($id)
	{
		$select = new select('comments');
		$result = $select->selectCommentByid_news($id);

		for($i=0;$i<count($result);$i++)
		{
			$id_login = $result[$i]['id_login'];
				$sel = new select('users');
				$res = $sel->selectByid($id_login);
				if(($res['login'] === $_COOKIE['login']) AND ($res['login'] == $_COOKIE['login']) AND (!empty($res['login'])))
				{
					$delete = '<div class="delete">
						<a href="admin/controllers/delete.php">
						<img src="views/img/buttons/delete.png" height="15px" width="15px">
						</a>
					</div>';
				}
				else
				{
					unset($delete);
				}
			echo '<tr>
    			<td><img src="views/img/'.$res['avatar'].'" width="60px" height="60px"></td>
    			<td>
					'.$delete.'
    			<label>'.$res['login'].'</label><br>
					'.$result[$i]['comment'].'<br>
    			</td>
    		</tr>';
		}
	}

	function last_user()
	{
		$select = new select('users');
		$result = $select->last_DO();

		return $result['login'];
	}

	function users(){
		$select = new select('users');
		$result = $select->select();

		for($i=0;$i<count($result);$i++)
		{
			echo '<tr>
		            	<td width="10%">
							<img src="views/'.$result[$i]['img'].'">
		            	</td>
	            		<td width="60%">
	            			<ul>
	            				<li><b>'.$result[$i]['login'].'</b></li>
	            				<li>'.$result[$i]['fio'].'<hr></li>
	            				<li>
								<ul class="downUl">
									<li>Сообщений: <b>'.$result[$i]['comments'].'</b></li>
									<li>Лайков: <b>123</b></li>
								</ul>
	            				</li>
	            			</ul>
	            		</td>
	            		<td width="25%">
	            			'.$result[$i]['comments'].'
	            		</td>
	            	</tr>';
		}
	}

	function last_news_footer()
	{
		$select = new select('news');
		$result = $select->selectBylimit3();

		for($i=0;$i<count($result);$i++){
			echo '<li>
				<a href="#">'.mb_substr($result[$i]['title'], 0,10,"UTF-8").'</a> 
				'.mb_substr($result[$i]['content'], 0,40,"UTF-8").'
				</li>';
		}
	}

	function last_comment_footer()
	{
		$select = new select('comments');
		$result = $select->selectBylimit3();

		for($i=0;$i<count($result);$i++){
			echo '                        <li><a href="#">'.$result[$i]['comment'].'</a></li>';
		}
	}

	function gallery()
	{
		$select = new select('images');
		$result = $select->select();

		for($i=0;$i<count($result);$i++)
		{
			echo '<li><a href="#"><img src="images/img/'.$result[$i]['path'].'" data-large="images/img/'.$result[$i]['path'].'" alt="image'.$result[$i]['id'].'" data-description="'.$result[$i]['title'].'" /></a></li>';
		}
	}

	function search_view($id)
	{
		$select = new select('sportsman');
		$result = $select->selectByid($id);
		for($i=0;$i<count($result);$i++)
		{
			show_sportsman('fio','sportsman');
		}

	}

	function transform_month($id)
	{
		$Month_r = array(
		"01" => "Января",
		"02" => "Февраля",
		"03" => "Марта",
		"04" => "Апреля",
		"05" => "Майя",
		"06" => "Июня",
		"07" => "Июля",
		"08" => "Августа",
		"09" => "Сентября",
		"10" => "Октября",
		"11" => "Ноября",
		"12" => "Декабря"); 

		return $Month_r[$id];
	}

	function calendar_event()
	{
		// проверяем, если в переменная month была установлена в URL-адресе, 
	//либо используем PHP функцию date(), чтобы установить текущий месяц.
	if(isset($_GET['month']))
	    $month = $_GET['month']; 
	elseif(isset($_GET['viewmonth']))
	    $month = $_GET['viewmonth']; 
	else $month = date('m'); 
	 
	// Теперь мы проверим, если переменная года устанавливается в URL, 
	//либо использовать PHP функцию date(), 
	//чтобы установить текущий год, если текущий год не установлен в URL-адресе.
	if(isset($_GET['year']))
	    $year = $_GET['year']; 
	elseif(isset($_GET['viewyear'])) 
	    $year = $_GET['viewyear']; 
	else $year = date('Y'); 

	if($month == '12')	
		$next_year = $year+1;
	else $next_year = $year;

	$Month_r = array(
	"1" => "Январь",
	"2" => "Февраль",
	"3" => "Март",
	"4" => "Апрель",
	"5" => "Май",
	"6" => "Июнь",
	"7" => "Июль",
	"8" => "Август",
	"9" => "Сентябрь",
	"10" => "Октябрь",
	"11" => "Ноябрь",
	"12" => "Декабрь"); 


	$first_of_month = mktime(0, 0, 0, $month, 1, $year); 

	// Массив имен всех дней в неделю
	$day_headings = array('Sunday', 'Monday', 'Tuesday', 
	'Wednesday', 'Thursday', 'Friday', 'Saturday'); 

	$maxdays = date('t', $first_of_month); 
	$date_info = getdate($first_of_month); 
	$month = $date_info['mon']; 
	$year = $date_info['year']; 
	 
	// Если текущий месяц это январь, 
	//и мы пролистываем календарь задом наперед число, 
	//обозначающее год, должно уменьшаться на один. 

	if($month == '1'): 
	    $last_year = $year-1; 
	else: $last_year = $year; 
	endif; 

	// Вычитаем один день с первого дня месяца, 
	//чтобы получить в конец прошлого месяца
	$timestamp_last_month = $first_of_month - (24*60*60); 
	$last_month = date("m", $timestamp_last_month);
	 
	// Проверяем, что если месяц декабрь, 
	//на следующий месяц равен 1, а не 13
	if($month == '12')
	    $next_month = '1'; 
	else $next_month = $month+1; 

	$_SESSION['month'] = $Month_r[$month];
	echo '<table class="cal">
		      <caption>
		        <span class="prev"><a href="index.php?page=calendar&month='.$last_month.'&year='.$last_year.'">←</a></span>
		        <span class="next"><a href="index.php?page=calendar&month='.$next_month.'&year='.$next_year.'">→</a></span>
		        '.$Month_r[$month]." ".$year.'
		      </caption>
		      <thead>
		        <tr>
		          <th>Пн</th>
		          <th>Вт</th>
		          <th>Ср</th>
		          <th>Чт</th>
		          <th>Пт</th>
		          <th>Сб</th>
		          <th>Вс</th>
		        </tr>
		      </thead>
		      <tr>
		      <tbody>
	';
	 
	// очищаем имя класса css
	$class = "";
	 
	$weekday = $date_info['wday'];
	 
	// Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
	$weekday = $weekday-1; 
	if($weekday == -1) $weekday=6;
	 
	// станавливаем текущий день как единица 1
	$day = 1;
	// выводим ширину календаря
	if($weekday > 0) {
	 $d = date("d", $timestamp_last_month) - $weekday;;
		for($i=0;$i<$weekday;$i++)
		{
			$d++;
	    echo "<td class='off'>".$d."</td>";
	    }
	}
	 if($month < 10)
	 {
	 	$month = '0'.$month;
	 }
	while($day <= $maxdays)
	{
	    // если суббота, выволдим новую колонку.
	    if($weekday == 7) {
	        echo "</tr><tr>";
	    $weekday = 0;
	  }

	  	if($day < 10)
	 	{
	 		$day = '0'.$day;
	 	}
	 
	  $linkDate = mktime(0, 0, 0, $month, $day, $year);
	 
	  // проверяем, если распечатанная дата является сегодняшней датой.
	  //если так, используем другой класс css, чтобы выделить её 
	    if((($day < 10 and "0$day" == date('d')) or ($day >= 10 and "$day" == date('d'))) 
	    and (($month < 10 and "0$month" == date('m')) 
	    or ($month >= 10 and "$month" == date('m'))) and $year == date('Y'))
	       $class = "active";

	  //в противном случае, печатаем только ссылку на вкладку
	    else {
	    $d = date('m/d/Y', $linkDate);
	      $class = "default";
	  }

	 	 	// Проверяем, есть ли какие либо события на этот день.
	   $date = $year."-".$month."-".$day;
	 	$select = new select('event');
	 	$result = $select->selectbydate($date);
	 	if($result != NULL)
	 	{
	 		$class = 'eventClass';
	 	}
	 
	  //помечаем выходные дни красным
	  if($weekday == 5 || $weekday == 6) $red='style="color: red" ';
	  else $red='';    
	    echo "
	        <td class='{$class}'><a href='index.php?page=calendar&date=".$year."-".$month."-".$day."&month=".$month."&day=".$day."&year=".$year."'><span ".$red.">{$day}</span></a>
	        </td>";
	    $day++;
	    $weekday++;  
	}
	 
	if($weekday != 7) 
	  echo "<td class='off' colspan='" . (7 - $weekday) . "'><a href='#'></td>";
	 
	echo  "</tr></tbody></table>";  
	}

	function event_year($variable)
	{
		$select = new select('event');
		$result = $select->eventbyyear($variable);		
		for($i=0;$i<count($result);$i++)
		{
			$month = $result[$i]['month'];
			if($month < 10)
	 		{
	 			$month = '0'.$month;
	 		}
			echo "	<li><a href='index.php?page=event&id=".$result[$i]['id']."'>
						".$result[$i]['day']." ".transform_month($month)." ".$result[$i]['year']."
							</a><br>".mb_substr($result[$i]['event'],0,20,'UTF-8')."</li>";
		}	

	}

	function news_archive()
	{
		$select = new select('archive');
		$result = $select->selectBylimit();

		for($i=0;$i<count($result);$i++)
		{


				echo "
						<li>За ".$result[$i]['year']." <b>Общ.Кол ".$result[$i]['count']."</b>
						<ul>";
				for($j=0;$j<count(event_year($result[$i]['year']));$j++)
				{
					echo event_year($result[$j]['year']);
				}
						
				echo "		</ul>
						</li>
						
				 ";
		}
	}


	function event($date,$year,$month,$day)
	{
		if(isset($date) and !empty($date))
		{
			$select = new select('event');
			$result = $select->selectbydate($date);
		if($result != NULL)
			{
				if(isset($result['img']) and !empty($result[$i]['img']))
				{
					$img = $result['img'];
				}
				else
				{
					$img = 'views/img/free.jpg';
				}
				for($i=0;$i<count($result);$i++)
				{
					echo "
					<li>
					<table class='event_right'>
						<tr>
							<th colspan='2'>
							<img src='".$img."' width='100%' height='250px'>
							</th>
						</tr>
						<tr>
							<td width='25%' class='smalltd'>
								<a href='index.php?page=event&id=".$result[$i]['id']."'>
								<h2>".$day."</h2>
								".transform_month($month)." ".$year."
								</a>
							</td>
							<td>
							<p>".$result[$i]['title']."</p>
								".mb_substr($result[$i]['event'],0,55,'UTF-8')."...
								<a href='index.php?page=event&id=".$result[$i]['id']."'>Подробнее</a>
							</td>
						</tr>
					</table>
					</li>
					";
				}
			}
			else
			{
				echo "По выбранной дате нет событий";
			}
		}
		else
		{
			echo "Вы не выбрали дату событий";
		}
	}

	function event_single($id)
	{
		$select = new select('event');
		$result = $select->selectByid($id);
		if(isset($result[$i]['img']) and !empty($result[$i]['img']))
				{
					$img = $result[$i]['img'];
				}
				else
				{
					$img = 'views/img/free.jpg';
				}

				echo "
					<table class='event_right' style='width:80%; margin:0 auto;'>
						<tr>
							<th colspan='2'>
							<img src='".$img."' 	>
							</th>
						</tr>
						<tr>
							<td width='25%' class='smalltd'>
								<a href=''>
								<h2>".$day."</h2>
								".transform_month($month)." ".$year."
								</a>
							</td>
							<td>
							<p>".$result['title']."</p>
								".$result['event']."
							</td>
						</tr>
					</table>
					";

	}

/*function imagegettext(){
  $text = "ros";
  $im = ImageCreateFromJPEG('../views/img/free.jpg');
  $color = imagecolorallocate($im, 255, 0, 0);
 //указываем на тип передаваемых данных
  $x = 10 ; $y= 30 ; $fs = 20 ;
  $fonts = "../views/font/ARIAL.TTF";
  imagettftext($im, $fs, 0, $x+1, $y-1, $color, $fonts ,$text);
	# Сохраняем рисунок в формате JPEG
  
  $randN = rand(0,100);
    imagejpeg($im,'../views/img/thumb/'.$randN.'.free.jpg',95);    
    imagedestroy($im);
  }

  //вывод функции
  imagegettext();*/
?>