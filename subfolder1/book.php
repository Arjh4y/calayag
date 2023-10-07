<?php
if(isset($_GET['date'])){
    $date = $_GET['date'];
}

if(isset($_POST['submit'])){

        $fname =$_POST['FIRSTNAME'];
        $mname =$_POST['MIDDLENAME'];
        $lname =$_POST['LASTNAME'];
        $phone =$_POST['PHONE'];
        $email =$_POST['EMAIL'];
        $conn = new mysqli('localhost','root','','bookingsysystem');

        $sql ="INSERT INTO bookings_record(FIRSTNAME,MIDDLENAME,LASTNAME,PHONE,EMAIL,DATE)VALUES('$fname','$mname','$lname','$phone','$email','$date')";

        $check_sql = "SELECT * FROM bookings_record WHERE DATE = '$date'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        $message = "<div class='alert alert-danger'>The date is already booked.</div>";
    } else {
        $sql = "INSERT INTO bookings_record(FIRSTNAME, MIDDLENAME, LASTNAME, PHONE, EMAIL, DATE) 
                VALUES('$fname', '$mname', '$lname', '$phone', '$email', '$date')";

        if($conn->query($sql)){
            $message = "<div class='alert alert-success'>Booking Successful</div>";
        }else{
            $message = "<div class='alert alert-danger'>Booking was not Successful</div>";
        }
    }
}


?>
<?php 
$a = mt_rand(100000,999999); 

for ($i = 0; $i<6; $i++) 
{
$a .= mt_rand(0,9);
}?>

<!doctype html>
<lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">

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

.head, .footer {
    background-color: rgba(255, 211, 66, 0.5);
    color: antiquewhite;
    text-align: center;
    padding: 20px;
}

.menu {
    padding: 10px;
    border-radius: 10px;
    display: inline-block; 
}

.menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: center; 
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
    font-family: 'Times New Roman', Times, serif;
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


.form-group {
    color:antiquewhite;
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
    top: 15%;
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
.row {
    margin-top:12%;
}
    </style>
</head>

<div class="bg">

        <div class="carousel-text">
            <p class="h-first-line">Reservation Form</p>
        </div>

    
        <div class="container">
        <h1 class="text-center alert alert-danger" style="background-color: rgba(255, 211, 66, 0.5); border:none;color: antiquewhite;"> Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <div class="row">
            <div class="col-md-12">
                <?php echo isset($message) ? $message : '';?>
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for=""> FIRST NAME</label>
                        <input type="text" class="form-control" name="FIRSTNAME" placeholder="FIRST NAME" required>
                    </div>
                    <div class="form-group">
                        <label for=""> MIDDLE NAME</label>
                        <input type="text" class="form-control" name="MIDDLENAME" placeholder="MIDDLE NAME" required>
                    </div>
                    <div class="form-group">
                        <label for=""> LAST NAME</label>
                        <input type="text" class="form-control" name="LASTNAME" placeholder="LAST NAME"  required>
                    </div>
                    <div class="form-group">
                        <label for=""> PHONE NUMBER</label>
                        <input type="tel" pattern="^(09|\+639)\d{9}$" class="form-control" name="PHONE" placeholder="09** *** **** " required>
                    </div>
                    <div class="form-group">
                        <label for=""> EMAIL</label>
                        <input type="email" pattern="^[A-Z0-9._%+-]+@gmail\.com\.ph$" class="form-control" name="EMAIL" placeholder="example@gmail.com" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
                    <a href="index.php" class="btn btn-success">Back</a>
                    
                </form>
            </div>
        </div>
    </div>
    </div>

    

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
