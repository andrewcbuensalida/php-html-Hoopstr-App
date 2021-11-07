<?php
    // starting a session, dont need if on host
    if(session_status()!=PHP_SESSION_ACTIVE) {
        session_start();
    };
    
    include('config/db_connect.php');

    //ADDING a game
    if(isset($_GET['new_game_title'])){

        // escape sql chars
        $new_game_title = mysqli_real_escape_string($conn, $_GET['new_game_title']);

        // escape sql chars
        $new_game_date = mysqli_real_escape_string($conn, $_GET['new_game_date']);

        // create sql
        $sql_games_insert = "INSERT INTO games(game_title,game_date) VALUES('$new_game_title','$new_game_date')";

        // save to db and check
        if(mysqli_query($conn, $sql_games_insert)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        };
        // mysqli_insert_id($conn) returns the last auto-generated id 
        $_SESSION['selected_game'] = mysqli_insert_id($conn);

    };

    // assigning session selected game
    if(isset($_GET['selected_game'])){
        $_SESSION['selected_game'] = $_GET['selected_game']; 
    };

$must_select_game = NULL;

// write query for all games
$sql_games = 'SELECT * FROM games';

// write query for all activity_log
$sql_activity_log = 'SELECT * FROM activity_log';

// get the result set (set of rows)
$result_games = mysqli_query($conn, $sql_games);

// get the result set (set of rows)
$result_activity_log = mysqli_query($conn, $sql_activity_log);

// fetch the resulting rows as an array....$games = all games = array of arrays mysqli version
while($i = mysqli_fetch_assoc($result_games)){
    $games[] = $i;
};

// fetch the resulting rows as an array....$games = all games = array of arrays mysqlnd version
// $games = mysqli_fetch_all($result_games, MYSQLI_ASSOC);

// // fetch the resulting rows as an array....$activity_log = all activities = array of arrays mysqli version
while($i = mysqli_fetch_assoc($result_activity_log)){
    $activity_log[] = $i;
};

// fetch the resulting rows as an array....$activity_log = all activities = array of arrays mysqlnd version
// $activity_log = mysqli_fetch_all($result_activity_log, MYSQLI_ASSOC);

 
    // ADDING a new activity
    if(isset($_GET['new_activity']) and intval ($_SESSION['selected_game']) != 0 ){

        // escape sql chars
        $new_activity = mysqli_real_escape_string($conn, ' '.$_GET['new_activity']);

        $new_game_fk = $_SESSION['selected_game'];

        // create sql
        $sql_activity_log_insert = "INSERT INTO activity_log(activity,game_fk) VALUES('$new_activity','$new_game_fk')";

        // save to db and check
        if(mysqli_query($conn, $sql_activity_log_insert)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
    }elseif (isset($_GET['new_activity'])){
        $must_select_game = 'Must select a game first' ;
    };


// free the $result_games from memory (good practise)
mysqli_free_result($result_games);

// free the $result_games from memory (good practise)
mysqli_free_result($result_activity_log);

// close connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Stats Tracker</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" type="image/jpg" href="img/score.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Compiled and minified CSS -->
         <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    </head>
    <body>
        <header>
        <!-- <div>
            <h1>test</h1>
        </div> -->

            <!-- button to open new game create -->
            <button class="open-button" onclick="openForm()">Create new game</button>

            <!-- w3 pop up form to create a new game-->
            <div class="form-popup" id="myForm">
                <form action="index.php" class="form-container" method="get">
                    <h1>Create a new game</h1>

                    <label for="new_game_title"><b>Game title</b></label>
                    <input type="text" placeholder="Enter game title" name="new_game_title" required>

                    <label for="new_game_date"><b></b></label>
                    <input type="date" placeholder="Enter date" name="new_game_date" required>
                    <br><br><br>

                    <button type="submit" class="btn">Create</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
                </form>
            </div>

            <script>
                function openForm() {
                    document.getElementById("myForm").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                }
            </script>


    <!-- drop down to select game -->
            <form action="index.php" method="get">
                <select name="selected_game" class="dropdown">
                    <option value="select_game">Select game</option>
                    <!-- <option value="create_new_game">Create a new game...</option> -->
                    <?php foreach( array_reverse($games) as $game){ ?>
                        <option value="<?php echo $game['id']?>" <?php if(isset($_SESSION['selected_game'])){
                                                                            if($game['id']==$_SESSION['selected_game']){
                                                                                echo 'selected';
                                                                            };
                                                                        };?>
                        >
                            <?php echo htmlspecialchars($game['game_title']);?>
                            <?php echo htmlspecialchars($game['game_date']);?>
                        </option>
                    <?php }?>   
                </select>
                <input type="submit" value="Submit">
            </form>


        </header>

<!-- when drop down is changed, even without submitting, it will alert
<script type="text/javascript">
   function changeFunc() {
        var selectBox = document.getElementById("selectBox");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        if(selectedValue==2){
            alert('alertttttt');
            alert(document.getElementById("selected").value);
        };
   }

</script>

<select id="selectBox" onchange="changeFunc();">
   <option value="1">Option #1</option>
   <option value="2">Option #2</option>
</select> -->

<!-- buttons with links
<a href="create_new_game.php">hhhhhhhhhhhhhhhh</a>
<button onclick="location.href='create_new_game.php';">go to create new game</button>
<input type="button" onclick="location.href='https://google.com';" value="Go" /> -->

<!-- displays game_id when clicked on a drop down without pressing submit
onclick="selectGame();" id="gamename2" must be added in the select tag
<script>
    function selectGame(){
        var game_id = document.getElementById('gamename2').value;
        document.getElementById('poll').innerHTML = game_id;
    }
</script> 
<p id="poll">checking</p> -->

<!-- images -->
        <!-- <img src="img\edit.png" alt="history icon" height="100">
        <img src="img\create-vector-icon-260nw-564700609.webp" alt="history icon" height="100">
            <br><br>
        </p>
        <p class="top-right">
            <img src="img/graph.jpg" alt="history icon" height="120">
        </p>
        <header>
            <img src="img/microphone-3404243_960_720.webp" alt="microphone" height="120">
            <br>
            Say "I made a layup..."
        </header> -->
        <br>
        <hr>
        <br><br>
        <main class="stats" >


            <!-- Points -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $points = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'made') and (stripos($activity['activity'], '3'))){
                            $points += 2;
                        }
                        if(stripos($activity['activity'], 'made') and (stripos($activity['activity'], 'jump') or stripos($activity['activity'], 'lay'))){
                            $points +=1;
                        }
                    } 
                }
                echo $points;
            }?> points</li>


            <!-- FG% -->
            <li>
                <?php if(isset($_SESSION['selected_game'])){
                    $fg_made = 0;
                    $fg_missed = 0;
                    foreach( array_reverse($activity_log) as $activity){
                        if($activity['game_fk'] == $_SESSION['selected_game'] ){
                            if(stripos($activity['activity'], 'made') and (stripos($activity['activity'], '3') or stripos($activity['activity'], 'lay') or stripos($activity['activity'], 'jump'))){
                                ++$fg_made;
                            }
                            if(stripos($activity['activity'], 'missed') and (stripos($activity['activity'], '3') or stripos($activity['activity'], 'lay') or stripos($activity['activity'], 'jump'))){
                                ++$fg_missed;
                            }
                        } 
                    }
                    if($fg_made+$fg_missed!=0){
                        echo intval(($fg_made/($fg_made+$fg_missed))*100);
                    }

                }?>% FG
                <?php echo $fg_made . '/' . ($fg_made+$fg_missed);?>
            </li>


            <!-- 3 point percentage -->
            <li>
                <?php if(isset($_SESSION['selected_game'])){
                    $made_3 = 0;
                    $missed_3 = 0;
                    foreach( array_reverse($activity_log) as $activity){
                        if($activity['game_fk'] == $_SESSION['selected_game'] ){
                            if(stripos($activity['activity'], 'made') and (stripos($activity['activity'], '3') or stripos($activity['activity'], 'three'))){
                                ++$made_3;
                            }
                            if(stripos($activity['activity'], 'missed') and (stripos($activity['activity'], '3') or stripos($activity['activity'], 'three'))){
                                ++$missed_3;
                            }
                        } 
                    }
                    if($made_3+$missed_3!=0){
                        echo intval(($made_3/($made_3+$missed_3))*100);
                    }
                }?>% 3-point
                <?php echo $made_3 . '/' . ($made_3+$missed_3);?>
            </li>


            <!-- Rebounds -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $Rebounds = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'reb')){
                            ++$Rebounds;
                        }
                    } 
                }
                echo $Rebounds;
            }?> Rebounds</li>


            <!-- Steals -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $Steals = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'ste') or stripos($activity['activity'], 'stole')){
                            ++$Steals;
                        }
                    } 
                }
                echo $Steals;
            }?> Steals</li>



            <!-- Blocks -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $block = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'bl')){
                            ++$block;
                        }
                    } 
                }
                echo $block;
            }?> Blocks</li>



            <!-- Assists -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $assist = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'assist')){
                            ++$assist;
                        }
                    } 
                }
                echo $assist;
            }?> Assists</li>

            <!-- for blank space -->
            <li></li>


            <!-- Turnover -->
            <li><?php if(isset($_SESSION['selected_game'])){
                $turnover = 0;
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        if(stripos($activity['activity'], 'turn')){
                            ++$turnover;
                        }
                    } 
                }
                echo $turnover;
            }?> Turnovers</li>
 

        </main>
        <br><br>
        <hr>
        <br>


        <!--voice recognition  -->
        <img src="img/microphone-3404243_960_720.png" alt="microphone" id='btnGiveCommand' style="width:150px">
        <br><br>Press microphone, then say for example "I made a jumpshot"
        <br>
        <span id='message'></span>
        <br>
        
      
        <script>
            var message = document.querySelector('#message');

            var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
            var SpeechGrammarList = SpeechGrammarList || webkitSpeechGrammarList;

            var grammar = '#JSGF V1.0;';

            var recognition = new SpeechRecognition();
            var speechRecognitionList = new SpeechGrammarList();
            speechRecognitionList.addFromString(grammar, 1);
            recognition.grammars = speechRecognitionList;
            recognition.lang = 'en-US';
            recognition.interimResults = false;

            recognition.onresult = function(event) {
                var last = event.results.length - 1;
                var command = event.results[last][0].transcript;
                message.textContent = 'Voice Input: ' + command + '.';
                window.location.replace("index.php?new_activity=" + command);
 
            };

            recognition.onspeechend = function() {
                recognition.stop();
            };

            recognition.onerror = function(event) {
                message.textContent = 'Error occurred in recognition: ' + event.error;
            }        

            document.querySelector('#btnGiveCommand').addEventListener('click', function(){
                recognition.start();

            });


        </script>


        <main class="log">
            <li class="log1">Log:</li>
            <br>
            <!-- create new activity -->
            <form action="index.php" method="get">
                <input type="text" placeholder="Enter new activity" name="new_activity" required class="enteractivity">
                <input type="submit">
            </form>


            <p style="color:red"><?php echo $must_select_game ?></p>
            <br>

            <!-- outputting activity log-->
            <?php if(isset($_SESSION['selected_game'])){
                foreach( array_reverse($activity_log) as $activity){
                    if($activity['game_fk'] == $_SESSION['selected_game'] ){
                        echo htmlspecialchars($activity['activity']) . '<br />'. '<br />';                     
                    } 
                }
            }
            ?>   

        </main>
    </body>
</html>