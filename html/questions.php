<?php

session_start();

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
