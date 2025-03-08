<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wesleyan Landing Page.">
    <title>Wesleyan University</title>

    <link href="style.css" rel="stylesheet">
</head>


<body>
    <header id ="Wesleyan Title">
       
        <div class="navbar">
            <nav>
                <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                <a class="nav-link active" aria-current="page" href="#Aboutme">About</a>
                <a class="nav-link active" aria-current="page" href="#MajorPage">Majors and Minors</a>
                <a class="nav-link active" aria-current="page" href="#NotableAlum">Alumni</a>
                <a class="nav-link active" aria-current="page" href="#Affordable">Cost</a>
                <a class="nav-link active" aria-current="page" href="#Clubs">Clubs </a>
                <a class="nav-link active" aria-current="page" href="#Photos">Photos</a>

                <a class="nav-link active" aria-current="page" href="page2.html">Contact</a>
              </nav>
          </div>

          <h2>Wesleyan University</h2>

          <h3 class="float-md-start mb-0 title1"><i>Vincit Qui Patitur - "Those who persevere, conquer"</i></h3>
  
    </header>
<hr />

<section>
        
      
    <div class ="box1" id="Aboutme">
        <h2>About Wesleyan:</h2>
        <iframe id="flex"
        src="https://en.wikipedia.org/wiki/John_Wesley" 
        width="300" 
        height="280" 
        frameborder="10" 
        allowfullscreen
        title="Wikipedia of John Wesley">
        
        </iframe>
        
      
        <p>...
       

            <a href="https://www.wesleyan.edu/about/" target="Wesleyan Page">Wesleyan Main Page</a>
        </p>
    </div>
    <?php if(isset($_SESSION['username'])) ?>
     <div style="padding: 10px; border-bottom: 1px solid #ccc;">
        Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 
        | <a href="logout.php">Logout</a>
    </div>
    </section>

    <div class="flex-container">
        <div class="box" id="MajorPage">
            <h2>Wesleyan Majors and Minors Offered</h2>
            <p>...  Wesleyan offers a diverse list of majors and minors to choose from, in which students can choose from multiple majors and easily double and even triple major in some cases.
                <a href="https://catalog.wesleyan.edu/majors/" target="_blank">Majors</a>
                <a href="https://catalog.wesleyan.edu/minors/" target="_blank">Minors</a>
            </p>
        </div>

        <div class="box" id="NotableAlum">
            <h2>Notable Alumni</h2>
            <p>... Wesleyan is home to many talented alumni. Some notable ones include Bill Bellicheck, Michael Bay, Lin Manuel Miranda, etc.
                <a href="https://www.wesleyan.edu/admission/academics/featured-alumni.html" target="Wesleyan Alumni Page">Notable Alumni</a>
            </p>
        </div>

        <div class="box" id="Affordable">
            <h2>Cost of Attendance</h2>
            <p>...  The cost of attendance with room, board, and tuition is around 90k. However, Wesleyan attempts to make the Wesleyan experience affordable, providing full need based aid.
                <a href="https://www.wesleyan.edu/admission/admittedstudents/financing/cost.html" target="Cost of Attance of Wesleyan University">Cost of Attendance</a>
            </p>
        </div>

        <div class="box" id="Clubs">
            <h2>Clubs and Organizations</h2>
            <p> A various amount of clubs and organizations are offered at Wesleyan University. Popular ones being the Wesleyan Investment Group, Wesleyan Entrepreneurship Society, and the Wesleyan Film Series.
                <a href="https://wesleyan.campuslabs.com/engage/organizations" target="Club Page of Wesleyan University">Clubs and Organizations</a>
            </p>
        </div>

        <div class="box" id="Photos">
            <h2>Around Campus</h2>
            <p>
                <img src="https://www.architecturalrecord.com/ext/resources/Issues/2024/11-November/Pruzan-Arts-Center-02.webp" width="300px" height="200px" alt="Olin">
                <img src="https://ctmirror-images.s3.amazonaws.com/wp-content/uploads/2023/05/Wesleyan-2-1200x800.webp" width="300px" height="200px" alt="Usdan">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAQJbif-DvLh35ZxD4rGZWczJA6lqfWpwdfQ&s" width="300px" height="200px" alt="Exley Science Center">
            </p>
        </div>
    </div>
