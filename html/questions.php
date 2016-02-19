<?php

session_start();
echo "file called";



  $questions[0] = <<<html
      <span id='identifier' hidden>0</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Hacker Heaven</span>
                <p>Welcome to Hacker Heaven. Enter the password </p>
              </div>
              <div class="card-action green-text">
                <form id='answerForm'>
                  <input hidden name='qn' value='4bt65b6fc5a67a'>
                  <div class="input-field col s12 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
html;

  $questions[1] = <<<html
      <script>
        function checkPassword(){
          if($('#password').val() == 'techolympics'){
            return true;
          }
          else{
           alert('not correct');
            return false;
          }
        }
      </script>
      <span id='identifier' hidden>1</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Question 1</span>
                <p>Aight. Not Bad. One down.</p>
              </div>
              <div class="card-action green-text">
                <form id='answerForm' onsubmit='return checkPassword()'>
                 <input hidden name='qn' value='4bt65b6fc5a67r'>
                  <div class="input-field col s12 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
html;

  $questions[2] = <<<html
        <script>

        function deencrypt(input){//hex
          return hex2ascii(input);
        }

        function checkPassword(){
          if($('#password').val() == deencrypt('77656c636f6d65746f686578')){
            return true;
          }
          else{
           alert('not correct');  
            return false;
          }
        }

        function hex2ascii(pStr) {
          tempstr = '';
          for (b = 0; b < pStr.length; b = b + 2) {
              tempstr = tempstr + String.fromCharCode(parseInt(pStr.substr(b, 2), 16));
          }
          return tempstr;
        }

      </script>
      <span id='identifier' hidden>2</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Hey you're pretty smart.</span>
                <p>Hint: What's two less than a octagon?</p>
              </div>
              <div class="card-action green-text">
                <form id='answerForm' onsubmit='return checkPassword()'>
                  <input hidden name='qn' value='4bt65b6fc5a67s'>
                  <div class="input-field col s12 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
html;

  $questions[3] = <<<html
      <script>
        var hasPermission = false;
        function permission(){
          if (!hasPermission) alert ("You do not have the sufficient priveleges to complete this task. Noob.");
          return hasPermission;
        }
      </script>
      <span id='identifier' hidden>3</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">The password is 'noob'</span>
                <p>Really, it is.</p>
              </div>
              <div class="card-action green-text">
                <form id='answerForm' onsubmit ='return permission()'>
                  <input hidden name='qn' value='4bt65b6fc5a67t'>
                  <div class="input-field col s12 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
html;

  $questions[4] = <<<html
      <span id='identifier' hidden>4</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Objective: Login as an administrator</span>
                <p>Hint: What users are Located in the zipcode where INTERalliance's Office is Located?</p>
              </div>              
                <div class="card-action green-text">
                  <form id='question4'>

                    <div class="input-field col s12 green-text">
                      <input id="zipcode" name = "zipcode" type="text" class="validate">
                      <label for="zipcode">Zipcode</label>
                    </div>
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Search For Users
                      <i class="mdi-content-send right"></i>
                    </button>
                    <div id='question4response'></div>
                  </form>
                  <script>
                  $('#question4').ajaxForm({
                    url: "question4.php",
                    type: "post",
                    success: function(result){
                      //alert(result);
                      $('#question4response').html(result);
                    }
                  });
                  </script>
                </div>

              
              <div class="card-action green-text">
                <form id='answerForm'>
                  <input hidden name='qn' value='4bt65b6fc5a67d'>
                  <div class="input-field col s6 green-text">
                    <input id="username" name = "username" type="text" class="validate">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field col s6 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="password">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
              
            </div>
          </div>
        </div>
html;

  $questions[5] = <<<html
      <span id='identifier' hidden>4</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Welcome to the Admin Panel.</span>
                <p>Below is a search form to see who's favorite number is what in our very secure secure_users table. Your objective: login to the Pentagon. This is your final objective.</p>
              </div>              
                <div class="card-action green-text">
                  <form id='question5'>
                    <div class="input-field col s12 green-text">
                      <input id="fav_number" name = "fav_number" type="text" class="validate">
                      <label for="fav_number">Favorite Number</label>
                    </div>
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Search For Users
                      <i class="mdi-content-send right"></i>
                    </button>
                    <div id='question5response'></div>
                  </form>
                  <script>
                  $('#question5').ajaxForm({
                    url: "question5.php",
                    type: "post",
                    success: function(result){
                      //alert(result);
                      $('#question5response').html(result);
                    }
                  });
                  </script>
                </div>

              
              <div class="card-action green-text">
                <form id='answerForm'>
                  <input hidden name='qn' value='4bt65b6fc5a67h'>
                  <div class="input-field col s6 green-text">
                    <input id="username" name = "username" type="text" class="validate">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field col s6 green-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="password">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light green" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </form>
              </div>
              
            </div>
          </div>
        </div>
html;





  $questions['nothing'] = <<<html

      <span id='identifier' hidden>nothing</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">CONGRATULATIONS! </span>
               <p>YOU HAVE WON! Please contact your competition manager so that they can mark the time at which you finished.</p>
          
		 </div>
             <div class="card-action purple-text">
             <span style='align:right'><a href='unsetSession.php'>Play Again</a></span>
		 </div> 
            </div>
          </div>
        </div>

html;



if(isset($_POST['action']) && $_POST['action'] == 'goToFirstUncompleteQuestion'){
 // echo "post set";
  echo determineWhichQuestionToGoTo($questions);
//echo $firstUncompleteQuestion;
}


function findFirstUncompleteQuestion(){
  $response = '';
  $first = 0;
  for($i = 0; $i < count($_SESSION['correct']); $i++){
    if (isset($_SESSION['correct'][$i]) || $_SESSION['correct'][$i] == true){
      $lastCompleteQuestion = $i;
    }
  }
  return $lastCompleteQuestion + 1;
}

/*
function determineWhichQuestionToGoTo($questions){

  if(isset($_SESSION['correct'])){

    $firstUncompleteQuestion = findFirstUncompleteQuestion();

    if (is_int($firstUncompleteQuestion) && isset($questions[$firstUncompleteQuestion])){
      return $questions[$firstUncompleteQuestion];
    }
    else {
      return $questions['nothing'];
    }

  }

  else return $questions[0];

} */

function goToQ($qNum){
  return $questions[$qNum];
}
