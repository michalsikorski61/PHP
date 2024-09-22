<?php
    // Set the content type to HTML
    header("Content-type: text/html");
    
    // Disable browser caching
    header("Cache-Control: no-cache, must-revalidate");
    
    // Set an expiration date in the past to ensure no caching
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    
    // Enable implicit flushing of output buffers
    ob_implicit_flush(true);
    
    // End output buffering and flush all output
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set the character encoding to UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Set the viewport for responsive design -->
    <title>Document</title> <!-- Set the title of the document -->
</head>
<body>
    <!-- Create a form that submits to the same PHP script -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" name="stop" value="stop"> <!-- Submit button to stop the loop -->
    </form>
<?php
    // Initialize a counter for seconds
    $seconds = 0;
    
    // Set a flag to control the loop
    $running = true;
    
    // Start an infinite loop controlled by the $running flag
    while ($running) {
        // Output 'running...' to the browser
        echo 'running...<br>';
        
        // Force the output to be sent to the browser
        flush();
        
        // Check if the stop button was pressed
        if (isset($_POST['stop'])) {
            // Set the flag to false to stop the loop
            $running = false;
            echo "The loop has been stopped.";
            exit();
        } else {
            // Output the current value of $seconds
            echo $seconds . "<br>";
            
            // Wait for 1 second
            sleep(1);
            
            // Increment the seconds counter
            $seconds++;
            
            // Force the output to be sent to the browser again
            flush();
        }
    }
?>
</body>
</html>
