<?php

include 'includes/db.php';       // Include the database file
include 'includes/header.php';  // Include the header file

session_start();                // Start the session


//Ensure that the user is logged in

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user'){  // Check if the user is logged in
    header('Location: login.php');  // Redirect to login if the user is not logged in
    exit;
}

//Get the movie id from the query string

if(isset($_GET['movie_id'])){  // Check if the movie id is set in the query string
   echo "<div class='container'><p class='alert alert-danger'>Invalid movie selection</p></div>";
   include 'includes/footer.php';   // Include the footer file  
   exit;
}

$movie = $result->fetch_assoc();  // Fetch the movie details

if($_SERVER['REQUEST_METHOD'] == 'POST'){  // Check if the form is submitted
    $user_id  = $_SESSION['user_id'];  // Get the user id from the session
    $show_date = $_POST['show_date'];  // Get the show date from the form
    $show_time = $_POST['show_time'];  // Get the show time from the form

    $sql = "INSERT INTO bookings (user_id, movie_id, show_date, show_time, status) 
    VALUES ($user_id, $movie_id, '$show_date', '$show_time', 'pending')"  // Create the SQL query

    if($conn->query($sql) == TRUE){  // Execute the query
        echo "<div class='container'><p class='alert alert-success'>Booking successful! Your booking is pending to be approved</p></div>";  // Display success message

    }else{
    echo "<div class='container'><p class = 'alert alert-danger'>Error: ".$conn->error."</p></div>";
    }
}



?>

<div class="container">
    <h1 class="text-center">Book Movie</h1>
    <div class="card">
        <h3><?php echo $movie['title']?></h3>
        <p><?php echo $movie['description']?></p>
        <p><strong>Genre:</strong><?php echo $movie['genre']?></p>
        <p><strong>Languuage</strong><?php echo $movie['language']?></p>
        <p><strong>Duration:</strong><?php echo $movie['duration']?></p>
    </div>
</div>

<form method="post" class="mt-4">
    <div class="mb-3">
        <label for="show_date" class="form-label">Show Date</label>
        <input type="date" name="show_date" id="show_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="show_time" class="form-label">Show Time</label>
        <input type="time" name="show_time" id="show_time" class="form-control" required>

        <button type="submit" class="btn btn-primary">Confirm Booking</button>
    </div>
</form>

<?php
    include 'includes/footer.php';  
?>