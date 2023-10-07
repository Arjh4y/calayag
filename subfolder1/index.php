<?php
error_reporting(0);
function build_calendar($month, $year) {
	$mysqli = new mysqli('localhost', 'root', '', 'bookingsysystem');
    $stmt = $mysqli->prepare("SELECT * FROM bookings_record WHERE MONTH(DATE) = ? AND YEAR(DATE) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['DATE'];
            }
            
            $stmt->close();
        }
    }
	
    
    
    $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    $numberDays = date('t',$firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');

    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
    

    $calendar .= "<tr>";
    foreach($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    } 

    $currentDay = 1;
    $calendar .= "</tr><tr>";


    if ($dayOfWeek > 0) { 
        for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

        }
    }
    
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {

        if ($dayOfWeek == 7) {

            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";

        }
        
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
        if($date<date('Y-m-d')){
            $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
        }elseif(in_array($date, $bookings)){
            $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-dangerbook btn-xs'> <span class='glyphicon glyphicon-lock
            '></span> Already Booked</button>";
        }else{
            $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
        }
            
        $calendar .="</td>";
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) { 
    
        $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 
    }
    }
    
    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar;

}
    
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calayag Farm Online Reservation</title>
    <style>
        body, html {
    margin: 0;
    padding: 0;
}

.bg {
    background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url('bahay.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    height: 100vh;
    font-family: Arial, sans-serif;
}

.head {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    margin-bottom:4%;
}

.menu {
    background-color: rgba(255, 211, 66, 0.5); 
    padding: 10px; 
    border-radius: 10px; 
}

.menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu ul li {
    display: inline-block;
    margin: 0 15px;
}

.menu ul li a {
    text-decoration: none;
    color: antiquewhite;
    font-size: 18px;
    font-weight: bold;
    font-family:'Times New Roman', Times, serif;
    padding: 10px 20px;
    transition: background-color 0.3s;
    border-radius: 50px;
}

.menu ul li a:hover {
    color: #ffd722;
    background-color: rgba(250, 235, 215, 0.226);
    border-radius: 50px;
    cursor: pointer;
}

.menu ul li a:active {
    opacity: 0.8;
    color: #ffdc42;
    background-color: antiquewhite;
}

.main {
    text-align: center;
    color: antiquewhite; 
    font-size: 60px; 
    margin: 30px 0 0px;  
    line-height: 1.42857143;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-family: 'monikaitalic';
}



p.h-first-line {
	font-size: 40px;
	font-family: 'Tahoma-Regular', 'sans-serif';
	text-transform: uppercase;
	letter-spacing: 8px;
    text-shadow: 3px 2px 15px rgba(0, 0, 0, 1);
}

.carousel-text {
	position: absolute;
	z-index: 2;
	color: antiquewhite;
    top: 10%;
	left: 0;
	right: 0;
	margin: 0 auto;
}

.carousel-text p{
	color: antiquewhite;
}

p.h-first-line,
.carousel-text p {
    text-align: center;
}

.footer {
    background-color: rgba(255, 211, 66, 0.5); 
    color: antiquewhite;
    text-align: center;
    padding: 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
    font-size: 14px; 
    border-top: 2px solid #fff; 
    font-family:'Times New Roman', Times, serif;
}

/* PARA SA CALENDAR*/


table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px; 
}

th, td {
    padding: 5px;
    text-align: center;
    border: 1px solid #ccc;
    width: 10%; 
}

th {
    background-color: #f0f0f0; 
    font-weight: bold;
}

.empty {
    background-color: #f7f7f7;
}

.today {
    background: #eee; /* eto vurrent day */
}

.btn {
    padding: 2px 8px;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.btn-xs {
    font-size: 13px; 
}

.btn-success {
    background-color: #5cb85c;
    color: #fff;
}

.btn-danger {
    background-color: #d9534f;
    color: #fff;
    opacity: 0.5;
    cursor: not-allowed; 
    font-size:12px;
}

.btn-dangerbook {
    background-color: #d9534f;
    font-size:12px;
    cursor: not-allowed;
    color: #eee;
}

.btn-primary {
    background-color: rgba(255, 211, 70, 100); 
    color: #000;
}

.btn:hover {
    opacity: 0.8;
}

.alert-default {
    background-color: #f0f0f0; 
    padding: 3px;
    border-radius: 10px;
    margin: 7% 10% ;
}

.btn-already-booked {
    opacity: 1;
    cursor: pointer;
}




    </style>
</head>

<body>
    <div class="bg">
        <div class="head">
            <nav class="menu">
                <ul>
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="index.php">RESERVATION</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                </ul>
            </nav>
        </div>
        <div class="carousel-text">
            <p class="h-first-line">Online Reservation</p>
        </div>
        <div class="footer">
        <p>&copy; 2023 Calayag Farm. All rights reserved.</p>
    </div>

        <div class="container alert alert-default">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                echo build_calendar($month, $year);
                ?>
            </div>
        </div>
		</div>

    </div>
</body>
</html>
