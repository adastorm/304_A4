<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>🙏Bible Search™️</title>
</head>


<body>

    <h1>🙏Bible Search™️</h1>
    <h2>Please enter a word to find in the Bible:</h2>
    <form action="index.php" method="post">
        <label for="Search">Enter a word to search: </label>
        <input type="text" name="searchTerm" id="searchTerm">
        <input type="submit" value="YES!!">
    </form>



    <?php

    $file = fopen("Text_Files/KJV12.TXT", "r");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        echo "Search results for: ".$_POST["searchTerm"];


        while (!feof($file)) {
            $line = fgets($file);
        }
    }
    fclose($file);

    ?>



</body>

</html>