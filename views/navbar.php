<link href='https://fonts.googleapis.com/css?family=Fugaz+One|Playball' rel='stylesheet' type='text/css'>
  <style type="text/css">
  .bluetop {
      width: 100%;
      height: 52px;
      background-color: #C0C0C0;
      color: #0062cc;
      position: relative;
      z-index: 1;
      border: 5px double black;
      padding-bottom: 50px;
  }
  /*.titlespace {
      position: absolute;
      top: 0px;
      width: 100%;
      height: 51px;
      border-top: 2px solid #0062cc;
      border-bottom: 2px solid #0062cc;
      background-color: #007bff;
      margin-bottom: ;
      color: #ffffff;
  }*/
  .sclogo {
      background-color: #007bff;
      height: 50px;
      width: 220px;
      display: inline-block;
      border: 5px double #0062cc;
      margin-top: -15px;
  }
  .lineheight1 {
      line-height: 5px;
      font-family: 'Fugaz One', cursive;
      color: #ffffff;
      text-shadow: 4px -3px 0px #0062cc;
  }
  #navig {
    color: white;
  }
  </style>
  <div class="bluetop">
            <div class="titlespace">
                <div class="row">
                  <!-- <nav class="navbar"> -->
                      <div class="container">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand" href="index.php">
                            <div class="col-md-3 text-center">
                                        <div class="sclogo">
                                            <h2 class="lineheight1">Spatula City</h2>
                                        </div>
                                    </div> <!-- End col-md-3 -->
                          </a>
                        </div>
                        <!-- <div id="navbar" class="collapse navbar-collapse"> -->
                          <ul id = "navig" class="nav navbar-nav">
                          	<li><a href="ads.index.php">Ad Index</a></li>
                            <li <?php if(!isset($_SESSION['Loggedinuser'])) {?>style="display:none"<?php }?>><a href = "users.show.php">Your Profile</a></li>
                            <li <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?>><a href ="auth.login.php">Members, Log In!</a></li>
                            <li <?php if(isset($_SESSION['Loggedinuser'])) {?>style = "display:none"<?php }?>><a href="users.create.php">Sign Up</a></li>
                            <li><a href="meet.php">About ZTR</a></li>
                          </ul>
                        <!-- </div> --><!--/.nav-collapse -->
                      </div>
                  </div>
                </div>
              </div>
                    <!-- </nav> -->