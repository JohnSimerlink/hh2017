<?php
session_start();

  $questions[0] = <<<html
      <span id='identifier' hidden>0</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title">Hacker Heaven</span>
		<h4> Challenge 1 </h4>
                <p>Welcome to Hacker Heaven. Use your hacking skills to find the first challenge's password.</p>
		<p style="font-size:10">Note: Use Chrome or Firefox </p>
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
        <!--

        Most common passwords used by users in 2013:
        123456
        password
        iloveyou
        12345678
        qwerty
        abc123
        123456789
        111111
        1234567
        adobe123
	interallianceisawesome (ok, maybe this isn't too common of a password . . .)

        -->
html;



$questions[1] = <<<html
    <span id='identifier' hidden>1</span>
    <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
        <div class="col s12 m6">
          <div class="card black darken-1">
            <div class="card-content red-text">
              <span class="card-title">Challenge 2</span>
              <p>Aight. Not Bad. One down.</p>
		<p> This challenge may require some knowledge of Javascript.</p>
            </div>
            <div class="card-action red-text">
	    <script>
	      function checkPassword(){
		if($('#password').val() == 'itcareerscamp'){
		  return true;
		}
		else{
		 alert('not correct');
		  return false;
		}
	      }
	    </script>
              <form id='answerForm' onsubmit='return checkPassword()'>
               <input hidden name='qn' value='4bt65b6fc5a67r'>
                <div class="input-field col s12 red-text">
                  <input id="password" name = "password" type="password" class="validate">
                  <label for="first_name">Password</label>
                </div>
                <button class="btn waves-effect waves-light red" type="submit" name="action">Submit
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
          if($('#password').val() == deencrypt('636173686d656f757473696465')){
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
              <div class="card-content yellow-text">
                <span class="card-title">Hey you're pretty smart.</span>
                <p>Hint: 2 is to binary as 16 is to . . . </p>
              </div>
              <div class="card-action yellow-text">
                <form id='answerForm' onsubmit='return checkPassword()'>
                  <input hidden name='qn' value='4bt65b6fc5a67s'>
                  <div class="input-field col s12 yellow-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light yellow" type="submit" name="action">Submit
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
              <div class="card-content white-text">
                <span class="card-title">The password is 'unitedairlines'</span>
                <p>Really, it is.</p>
              </div>
              <div class="card-action white-text">
                <form id='answerForm' onsubmit ='return permission()'>
                  <input hidden name='qn' value='4bt65b6fc5a67t'>
                  <div class="input-field col s12 white-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="first_name">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light white" type="submit" name="action">Submit
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
              <div class="card-content blue-text">
                <span class="card-title">Objective: Login as an administrator</span>
                <p>Hint: What users are Located in the zipcode where the millenium hotel's zip code is?</p>
		<!-- Extra Hint: This step requires a sql injection. To learn more about SQL injections go to http://www.w3schools.com/sql/sql_injection.asp -->
                <!-- To practice doing a sql injection go  to this link: http://52.10.39.98/practice.php  -->
                <!-- The name of the table that the users are stored in is "users" -->
              </div>              
                <div class="card-action blue-text">
                  <form id='question4'>

                    <div class="input-field col s12 blue-text">
                      <input id="zipcode" name = "zipcode" type="text" class="validate">
                      <label for="zipcode">Zipcode</label>
                    </div>
                    <button class="btn waves-effect waves-light blue" type="submit" name="action">Search For Users
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

              
              <div class="card-action blue-text">
                <form id='answerForm'>
                  <input hidden name='qn' value='4bt65b6fc5a67d'>
                  <div class="input-field col s6 blue-text">
                    <input id="username" name = "username" type="text" class="validate">
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field col s6 blue-text">
                    <input id="password" name = "password" type="password" class="validate">
                    <label for="password">Password</label>
                  </div>
                  <button class="btn waves-effect waves-light blue" type="submit" name="action">Submit
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
                <p>Hint: You may find the following link helpful for decrypting hashes: <a href='https://crackstation.net/'> https://crackstation.net/</a> </p>
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





  $questions[6] = <<<html

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

  $questions[7] = <<<html
      <span id='identifier' hidden>4</span>
      <div class="row" style='style="position: absolute; left: 200px; top: 200px; width:200px; height:100px;'>
          <div class="col s12 m6">
            <div class="card black darken-1">
              <div class="card-content green-text">
                <span class="card-title"><h4>Introduction to SQL injections</h4></span>
		<p>Web Programs often obtain data from a database using a <a href='http://www.w3schools.com/sql/sql_select.asp'>language called SQL.</a> In SQL you can select rows from a database table with the following syntax: `SELECT column1, column2 from table WHERE columnX = something;`. Each SQL statement ends with a semicolon. </p>
		<br>
		<p>To SELECT all rows in a table called people, where each row's value in the "age" column is over 14 we could type `SELECT username, age from people where age > 14;`</p>
		<br>
		<p>The above would only return certain columns for each row. To make the above query return all columns for each row we could type `SELECT * from people where age > 14;`</p>
		<br>
		<p>Most websites don't want users to be able to create such custom SQL queries. Rather what websites do is create SQL queries based on user input. For example a website could ask a user what minimum age they want to search for through the table of people. The website could then store the user's choice in a variable named "\$age". The website would then generate and run a SQL query with the following syntax: `SELECT * from people where age > \$age;`</p>
		<h4> How to hack SQL Queries </h4>
		<p>What if a user is creative in their input? Instead of typing in "15" for an age, a user could type in "15; SELECT * from people;". The website's server side code would then have \$age's value set to "15; SELECT * from people;", meaning the SQL query would become `SELECT username, age from people where age >15; SELECT * from people;`. This is two queries meaning first all usernames and ages for people over the age of 15 would be retrieved, and then after the second query was run, ALL columns for ALL rows of people would be retrieved. Injecting SQL into user input with the hope that the webserver will not filter out your injected SQL and rather run it is a practice called "SQL injection".</p>
		<br>
		<p> The below form is a replication of our example above. Upon the form being submitted to the webserver, the webserver stores the user's input in a variable called \$age and runs the following SQL: `SELECT username, age from people where age > \$age`;</p>
		<br>
		<p>Try typing some of the sample inputs we talked about above, and see how the returned results differ</p>
		<br>
              </div>              
                <div class="card-action green-text">
                  <form id='question7'>

                    <div class="input-field col s12 green-text">
                      <input id="age" name = "age" type="text" class="validate">
                      <label for="age">Age</label>
                    </div>
                    <button class="btn waves-effect waves-light green" type="submit" name="action">Search For Users
                      <i class="mdi-content-send right"></i>
                    </button>
                    <div id='question7response'></div>
                  </form>
                  <script>
                  $('#question7').ajaxForm({
                    url: "sampleQuestion.php",
                    type: "post",
                    success: function(result){
                      //alert(result);
                      $('#question7response').html(result);
                    }
                  });
                  </script>
                </div>
              
            </div>
          </div>
        </div>
html;

