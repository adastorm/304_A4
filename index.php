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

        $term = $_POST["searchTerm"];
        echo "Search results for: ".$term;
        $results = "";
        $book = "";

        while (!feof($file)) {
            $line = fgets($file);

            $switch = false;

            if(strpos("Book",substr($line,0,3)) !== false) $book = substr($line,7,strlen($line));
            for ($i=0; $i < strlen($line) ; $i++) { 
                if(stripos($term, substr($line,$i,strlen($term))) !== false) $switch = true;
            }
            if($switch)
                $results = $results . '<br><br><div id="Book">' . $book . "</div> " . $line;
        }
        echo $results;
        echo "<br><br>"."End of results for ".$term;
    }
    fclose($file);

    ?>



</body>

</html>