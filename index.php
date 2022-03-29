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
    $file = fopen("KJV12.TXT", "r");
    $thesaurus = fopen("LinuxThesaurus.txt", "r");


    if (isset($_POST["searchTerm"])) {
        $term = $_POST["searchTerm"];
    } else if (isset($_GET["searchTerm"])) {
        $term = $_GET["searchTerm"];
    }

    $results = "";
    $book = "";
    $searchingString = "";
    $resultCounter = 0;

    //Search for terms in bible
    if (isset($_GET["searchTerm"]) || isset($_POST["searchTerm"])) {
        while (!feof($file)) {

            $line = fgets($file);

            if (strpos($line, "Book") !== false) $book = substr($line, 8, strlen($line));

            if (strlen($line) != 2) {
                $searchingString = $searchingString . $line;
            } else {
                if (strpos($searchingString, " " . $term . " ") !== false) {
                    $searchingString = preg_replace("/" . $term . "/", '<span style="background-color: chartreuse; color:black;">' . $term . '</span>', $searchingString);
                    $results = $results . '<br><br><div id="Book">' . $book . ": " . $searchingString . "</div> ";
                    $resultCounter++;
                }
                $searchingString = "";
            }
        }
        //Search for thesaurus terms
        echo "<h5>These are synonims for :  " . $term . "</h5>";
        while (!feof($thesaurus)) {
            $line = fgets($thesaurus);

            if (substr($line, 0, strlen($term) + 1) == $term . ",") {
                $exploded = explode(",", $line);
                for ($i = 1; $i < sizeof($exploded); $i++) {
                    echo '<a href="\index.php?searchTerm=' . $exploded[$i] . '">' . $exploded[$i] . ", </a>";
                }
            }
        }
    }
    //Print out thesaurus variable.

    //Print out all of the search results
    echo "<br>" . $resultCounter . " Results were found for the term " . $term;
    echo "<div class = 'results'>" . $results . "</div>";
    echo "<br><br>" . "End of results for " . $term;
    fclose($file);

    ?>



</body>

</html>