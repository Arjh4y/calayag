<?php
$counter_file = 'counter.txt';

$current_count = (file_exists($counter_file)) ? (int)file_get_contents($counter_file) : 0;

$current_count++;

file_put_contents($counter_file, $current_count);
?>



<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=UTF-8>
    <meta name=viewport content=width=device-width, initial-scale=1.0>
    <title>Calayag Farm Online Reservation</title>
    <link rel=stylesheet href=styles/homes.css>
</head>

<body>
    <div class=bg>
        <div class=header>
        <?php
            echo '<div class="visitor-count">NO. OF SITE VISITORS: <strong>' . $current_count . '</strong></div>';
        ?>
            <nav class=menu>
                <ul>
                    <li><a href=home.php>HOME</a></li>
                    <li><a href=index.php>RESERVATION</a></li>
                    <li><a href=contact.html>CONTACT</a></li>
                    <li><a href=about.html>ABOUT</a></li>
                </ul>
            </nav>
            <div class="visitor-count">NO. OF SITE VISITORS: <strong><?php echo $current_count; ?></strong></div>
        </div>
			<div class=carousel-text>
				<p class=h-first-line>Welcome To</p>
				<p class=h-second-line>Calayag Farm House</p>
            </div>
        <div class=slider>
            <div class=slide-img>
                <!-- Slide 1 -->
                <div class=slide>
                    <img src='img/img13.jpg'>
                </div>
    
                <!-- Slide 2 -->
                <div class=slide>
                    <img src='img/img2.jpg'>
                </div>
                
                <!-- Slide 3 -->
                <div class=slide>
                    <img src='img/img3.jpg'>
                </div>
    
                <!-- Slide 4 -->
                <div class=slide>
                    <img src='img/img5.jpg'>
                </div>
    
                <!-- Slide 5 -->
                <div class=slide>
                    <img src='img/img9.jpg'>
                </div>
    
                <!-- Slide 6 -->
                <div class=slide>
                    <img src='img/img10.jpg'>
                </div>
    
                <!-- Slide 7 -->
                <div class=slide>
                    <img src='img/img11.jpg'>
                </div>
    
                <!-- Slide 8 -->
                <div class=slide>
                    <img src='img/img12.jpg'>
                </div>
    
                <!-- Slide 9 -->
                <div class=slide>
                    <img src='img/img15.jpg'>
                </div>

                <!-- 2nd slide to HAHAHA-->


                <!-- Slide 1 -->
                <div class=slide>
                    <img src='img/img13.jpg'>
                </div>
    
                <!-- Slide 2 -->
                <div class=slide>
                    <img src='img/img2.jpg'>
                </div>
    
                <!-- Slide 3 -->
                <div class=slide>
                    <img src='img/img3.jpg'>
                </div>
    
                <!-- Slide 4 -->
                <div class=slide>
                    <img src='img/img5.jpg'>
                </div>
    
                <!-- Slide 5 -->
                <div class=slide>
                    <img src='img/img9.jpg'>
                </div>
    
                <!-- Slide 6 -->
                <div class=slide>
                    <img src='img/img10.jpg'>
                </div>
    
                <!-- Slide 7 -->
                <div class=slide>
                    <img src='img/img11.jpg'>
                </div>
    
                <!-- Slide 8 -->
                <div class=slide>
                    <img src='img/img12.jpg'>
                </div>
    
                <!-- Slide 9 -->
                <div class=slide>
                    <img src='img/img15.jpg'>
                </div>
                
        </div>

    </div>
    <div class=footer>
        <p>&copy; 2023 Calayag Farm. All rights reserved.</p>
    </div>

    </div>
    
</body>

</html>
