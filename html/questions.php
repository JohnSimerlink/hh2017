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
