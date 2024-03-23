<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">

 <!--   priceEdit.php - Allows client to edit JSON data
  Class: CSC 235 Server Side Development
  Week 6
  Student Name: Brittany Schaefer
  Written: 4/22/22
  Revised: 
  -->
  <title>Great Cinema</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<?php

    if(array_key_exists('hidIsReturning',$_POST)){
        $thisMovie = unserialize(urldecode($_SESSION['sessionThisMovie']));
    }else{
        $thisMovie=array();
    }
    //gets info from json file
    $jsonInfo = file_get_contents("priceData.json");
    //inserts json information to an array
    $movies = json_decode($jsonInfo, true); 
    $x=0;
         
    //check if info is an array
    if(!is_array($movies)){
        die("ERROR: Input is not an array");
    }else{
        foreach($movies as $key=>$value){
            $name = $movies[$key]['mName'];
            $description = $movies[$key]['mDescription'];
            $genre = $movies[$key]['mGenre'];
            $rating = $movies[$key]['mRating'];
            $runTime = $movies[$key]['mRunTime'];
            $showTimes = $movies[$key]['mShowTimes'];
             
            $thisMovie[$x]= array("mName"=>$name, "mDescription"=>$description, "mGenre"=>$genre, "mRating"=>$rating, "mRunTime"=>$runTime, "mShowTimes"=>$showTimes);
            $x++;
        }//end of foreach
        $_SESSION['sessionThisMovie'] = urlencode(serialize($thisMovie));
    }//end of else
       
    if(isset($_POST['btnSubmit'])){
        $thisMovie = unserialize(urldecode($_SESSION['sessionThisMovie']));
        $count=0;
        foreach($_POST['item'] as $array){
            foreach($array as $key=>$value){
                $thisMovie[$count][$key]=$value;
            }
            $count++;
        }
        $_SESSION['sessionThisMovie'] = urlencode(serialize($thisMovie));
        $jsonData = json_encode($thisMovie);
        file_put_contents('priceData.json', $jsonData);
        
    }
function displayMovieData($thisMovie) {
    //echo "<pre>";
    //print_r($thisMovie);
    //echo "</pre>";
    for($i=0;$i<5;$i++){
        echo "<div class='movieSpot'>";
            echo "<div class='one'><h4>{$thisMovie[$i]['mRating']}</h4></div>";
            echo "<div class='two'><h4>{$thisMovie[$i]['mGenre']}</h4></div>";
            echo "<div class='three'><h4>{$thisMovie[$i]['mRunTime']}</h4></div>";
            echo "<div class='four'><h4>{$thisMovie[$i]['mName']}</h4></div>";
            echo "<div class='five'><h4>{$thisMovie[$i]['mDescription']}</h4></div>";
            echo "<div class='six'><h4>{$thisMovie[$i]['mShowTimes']}</h4></div>";
        echo "</div>";
    }
    
}
?>
</head>
<body>
<div id="frame">
    <div id="displayMovies">
        <div id="dispHeader">
            <h1>Movie Times</h1>
        </div>
        <!--Display Movies-->
        <div id="movieContainer">
            <?php displayMovieData($thisMovie); ?>
        </div>
    </div>
    <div id="editMovies">
        <h1>Edit Movie information</h1>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>"
            method="POST"
            name= "frmMovies"
            id= "frmMovies">

            <table>
                <tr>
                    <th class="name"><label>Movie Name</label></th>
                    <th class="description"><label>Description</label></th>
                    <th class="genre"><label>Genre</label></th>
                    <th class="rating"><label>Rating</label></th>
                    <th class="runTime"><label>Run Time</label></th>
                    <th class="showTime"><label>Show Times</label></th>
                </tr>
            
                <tr>
                    <td><input class="nameIN" type="text" id="txtName1" name= "item[0][mName]" value="<?php echo $thisMovie[0]['mName']; ?>"></td>
                    <td><input class="descriptionIN" type="text" id="txtDescription1" name="item[0][mDescription]"  value="<?php echo $thisMovie[0]['mDescription']; ?>"></td>
                    <td><input class="genreIN" type="text" id="txtGenre1"  name="item[0][mGenre]" value="<?php echo $thisMovie[0]['mGenre']; ?>"></td>
                    <td><input class="ratingIN" type="text" id="txtRating1" name="item[0][mRating]" value="<?php echo $thisMovie[0]['mRating']; ?>"></td>
                    <td><input class="runTimeIN" type="text" id="txtRunTime1" name="item[0][mRunTime]" value="<?php echo $thisMovie[0]['mRunTime']; ?>"></td>
                    <td><input class="showTimeIN" type="text" id="txtShowTimes1" name="item[0][mShowTimes]" value="<?php echo $thisMovie[0]['mShowTimes']; ?>"></td>
                </tr>
                <tr>
                    <td><input class="nameIN" type="text" id="txtName2" name= "item[1][mName]" value="<?php echo $thisMovie[1]['mName']; ?>"></td>
                    <td><input class="descriptionIN" type="text" id="txtDescription2" name="item[1][mDescription]" value="<?php echo $thisMovie[1]['mDescription']; ?>"></td>
                    <td><input class="genreIN" type="text" id="txtGenre2" name="item[1][mGenre]" value="<?php echo $thisMovie[1]['mGenre']; ?>"></td>
                    <td><input class="ratingIN" type="text" id="txtRating2" name="item[1][mRating]" value="<?php echo $thisMovie[1]['mRating']; ?>"></td>
                    <td><input class="runTimeIN" type="text" id="txtRunTime2" name="item[1][mRunTime]" value="<?php echo $thisMovie[1]['mRunTime']; ?>"></td>
                    <td><input class="showTimeIN" type="text" id="txtShowTimes2" name="item[1][mShowTimes]" value="<?php echo $thisMovie[1]['mShowTimes']; ?>"></td>
                </tr>
                <tr>
                    <td><input class="nameIN" type="text" id="txtName3" name= "item[2][mName]" value="<?php echo $thisMovie[2]['mName']; ?>"></td>
                    <td><input class="descriptionIN" type="text" id="txtDescription3" name="item[2][mDescription]" value="<?php echo $thisMovie[2]['mDescription']; ?>"></td>
                    <td><input class="genreIN" type="text" id="txtGenre3" name="item[2][mGenre]" value="<?php echo $thisMovie[2]['mGenre']; ?>"></td>
                    <td><input class="ratingIN" type="text" id="txtRating3" name="item[2][mRating]" value="<?php echo $thisMovie[2]['mRating']; ?>"></td>
                    <td><input class="runTimeIN" type="text" id="txtRunTime3" name="item[2][mRunTime]" value="<?php echo $thisMovie[2]['mRunTime']; ?>"></td>
                    <td><input class="showTimeIN" type="text" id="txtShowTimes3" name="item[2][mShowTimes]" value="<?php echo $thisMovie[2]['mShowTimes']; ?>"></td>
                </tr>
                <tr>
                    <td><input class="nameIN" type="text" id="txtName4" name= "item[3][mName]" value="<?php echo $thisMovie[3]['mName']; ?>"></td>
                    <td><input class="descriptionIN" type="text" id="txtDescription4" name="item[3][mDescription]" value="<?php echo $thisMovie[3]['mDescription']; ?>"></td>
                    <td><input class="genreIN" type="text" id="txtGenre4" name="item[3][mGenre]" value="<?php echo $thisMovie[3]['mGenre']; ?>"></td>
                    <td><input class="ratingIN" type="text" id="txtRating4" name="item[3][mRating]" value="<?php echo $thisMovie[3]['mRating']; ?>"></td>
                    <td><input class="runTimeIN" type="text" id="txtRunTime4" name="item[3][mRunTime]" value="<?php echo $thisMovie[3]['mRunTime']; ?>"></td>
                    <td><input class="showTimeIN" type="text" id="txtShowTimes4" name="item[3][mShowTimes]" value="<?php echo $thisMovie[3]['mShowTimes']; ?>"></td>
                </tr>
                <tr>
                    <td><input class="nameIN" type="text" id="txtName5" name= "item[4][mName]" value="<?php echo $thisMovie[4]['mName']; ?>"></td>
                    <td><input class="descriptionIN" type="text" id="txtDescription5" name="item[4][mDescription]" value="<?php echo $thisMovie[4]['mDescription']; ?>"></td>
                    <td><input class="genreIN" type="text" id="txtGenre5" name="item[4][mGenre]" value="<?php echo $thisMovie[4]['mGenre']; ?>"></td>
                    <td><input class="ratingIN" type="text" id="txtRating5" name="item[4][mRating]" value="<?php echo $thisMovie[4]['mRating']; ?>"></td>
                    <td><input class="runTimeIN" type="text" id="txtRunTime5" name="item[4][mRunTime]" value="<?php echo $thisMovie[4]['mRunTime']; ?>"></td>
                    <td><input class="showTimeIN" type="text" id="txtShowTimes5" name="item[4][mShowTimes]" value="<?php echo $thisMovie[4]['mShowTimes']; ?>"></td>
                </tr>
            
                
            </table>
                <button name="btnSubmit"
                    value="save"
                    onclick="this.form.submit();">
                    Save
                </button>
                <input type= "hidden" name="hidIsReturning" value="true" />
        </form>
    </div> 
    <div id="ajaxContent">
        <!--What is AJAX? What does it do? What are its advantages?
            How can PHP be used to create JSON data from database 
                instead of the static .json file?
            Based on the learning activities, write an algorithm and 
                develop a flow chart showing the steps involved using a 
                JSON Server getting data from a DBF and responding with 
                JSON data to a web page using AJAX.
        -->
        <h1>AJAX</h1>
        <h2>What is AJAX? What does it do? What are its advantages?</h2>
        <p>
            AJAX stands for Asynchronous JavaScript And XML and is a programming 
            concept that is used to create asynchronous websites. It decouples the 
            interchange layer from the presentation layer in order to exchange data 
            from the server side without reloading the page. It utilizes a XMLHttpRequest 
            object to retrieve the data from the server and then updates only the data 
            eliminating the need for the page to reload. This increases the speed and 
            efficiency of the application by reducing server traffic and bandwidth. Another 
            important advantage is AJAX's ability to immediately validate form data.
        </p>
        <h2>How can PHP be used to create JSON data from database instead of the static .json file?</h2>
        <p>
            In order to create JSON data from a database PHP is used to preform a query to access information 
            from the database. That information is then converted to a PHP array. Once the PHP array is set it 
            can then be converted to JSON. The PHP code to convert the data into JSON data is "json_encode($phpArray);".
        </p>
        <h2>Getting data from a database using AJAX and a JSON server</h2>
        <h3>Flowchart</h3>
            <div id="fchartThumb">
                <a href="graphic/flowchart.png"  target="_blank">
                    <img src="graphic/flowchart.png" alt="Flowchart of Algorithm" height="400px">
                </a>
            </div>
        <h3>Algorithm</h3>
        <ul>
            <li>Create a AJAX call with an XMLHttpRequest object on the client side webpage</li>
            <li>Open the connection to the JSON server with XMLHttpRequest.open</li>
            <li>Set the XMLHttpRequest header to determine when the request is fulfilled</li>
            <li>The JSON server recieves the AJAX call from the client side webpage</li>
            <li>The JSON server opens a connection to the database on the server side</li>
            <li>The JSON server preforms an sql query to fetch data from the database</li>
            <li>The JSON server recieves the results from the database and then parses it into a PHP array</li>
            <li>The PHP array is then converted to JSON data with json_encode()</li>
            <li>The XMLHttpRequest.onreadystatechange is fulfilled with the JSON data</li>
            <li>The JSON data is then parsed on the client side webpage and used as necessary</li>
        </ul>
    </div>
</div>
</body>
</html>
