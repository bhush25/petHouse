<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['loggedin'] = false;
    echo $_SESSION['loggedin'];
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PetHouse - About</title>
    <link rel="stylesheet" href="style.css" />
    <style>

    </style>
</head>

<body>
    <div class="nav">
        <div class="nav_img">
            <img src="images/Logo-removedBG.png" alt="" />
        </div>
        <div class="nav_content">
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="services.php">Services</a>
            <a href="about.php">About Us</a>
        </div>
        <?php

        if (!$_SESSION['loggedin']) {
            echo '<div class="nav_buttons"><a href="login.php">LOG IN</a></div>';
        } else {
            echo '<div class="nav_buttons"><a href="logout.php">LOG OUT</a></div>';
        }



        ?>
    </div>

    <div>
        <h1 class="heading">About Us</h1>
        <div class="content_about">
            <p>
                We are a team consisting of 4 members deeply passionate about pets . Our webpage aims at spreading awareness and educating people on how to treat their pets the right way and care for them as they deserve to be.</p>
            <p> Pets are a great blessing in anyone's life. They are the only ones who love us unconditionally. Pets always offer us everything they have without asking for anything in return. The main aim of any pet's life is to make their owner happy.And here is our website
                Which gives information regarding pet care which includes maily</p>
            <p> 1. Feed your pet a good and high-quality foods.</p>
            <p> 2. Take them for a walk every day for at least half an hour.</p>
            <p> 3. Provide them with the needed vaccination on time.</p>
            <p> 4. Keep a clean and hygienic environment for them.</p>
            <p> 5. Visit Vet on a weekly/monthly basis.</p>
            <p> 6. Engage and do not leave them alone for a long time.</p>
        </div>

        <h1 class="heading">Our Team</h1>
        <div class="first">
            <h2>Sharvil M - 20191CSE0553</h2>
            <h2>Shivaraj P S - 20191CSE0559</h2>
        </div>
        <div class="first">
            <h2>Sarojini T Habbli - 20191CSE0534</h2>
            <h2>Bushan V- 20191CSE0796</h2>
        </div>


    </div>
    </div>
</body>

</html>