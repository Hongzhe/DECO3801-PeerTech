<!DOCTYPE html>
<header>
  <link rel="stylesheet" href="/foundation-5.4.0/css/foundation.css">
  <link rel="stylesheet" href="/foundation-5.4.0/css/css_self.css">
</header>
<body>

  <! navigation bar -->
      <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
          <li class="name">
           <img id="logo" src="../foundation-5.4.0/img/logos.png">
           <img id="font" src="../foundation-5.4.0/img/font.png">
           <!--             <a href="/">MoneyLink</a></h1> -->
         </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
         <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
       </ul>
       <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="/">Home</a></li>
          <li><a href="about">About MoneyLink</a></li>
          <li><a href="hworks">How MoneyLink works</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </section>
    </nav>

<div class="row" id="row_height">
  <div class="large-12 columns">
    <div id="back_pic">
      <div class="large-4 columns right">
        <div id="login">


          <! login and register box -->

          <ul class="tabs" data-tab role="tablist">
            <li class="tab-title active" role="presentational"><a href="#panel2-1" id="login_title" role="tab" tabindex="0" aria-selected="true" controls="panel2-1">Member Login</a></li>
            <li class="tab-title" role="presentational"><a href="#panel2-2" id="login_title" role="tab" tabindex="0"aria-selected="false" controls="panel2-2">Register</a></li>
          </ul>

          <div class="tabs-content" id="login_tab">
            <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
              
              <!-- <form> -->
               {{ Form::open(array('action'=>'HomeController@doLogin','name'=>'logForm','id'=>'loginForm')) }}
                <div class="row">
                  <div class="large-12 columns">
                  {{ Form::label('Username','Username',array('id'=> 'label')) }}
                  {{ Form::text('Username',null,array('class'=>'required','id'=>'txtbox')) }}
                    <!-- <label id="label">Username:
                      <input type="text"/>
                    </label> -->
                  </div>
                </div>
                <div class="row">
                  <div class="large-12 columns">
                  {{ Form::label('Password','Password',array('id'=>'label')) }}
                  {{ Form::password('Password',null,array('class'=>'required password','id'=>'txtbox')) }}
                   <!--  <label id="label">Password:
                      <input type="text"/> 
                    </label> -->
                  </div>
                </div>
                <p id="label2">
                {{ Form::checkbox('remember_me') }} remember me
                <a href="password/reminder" id="pw">Forgot password?</a>
                  <a href="#" id='loginBtn' class="secondary small button expand">Login</a></p>
                  
               <!-- {{ Form::submit('Login',null,array('id'=>'doLogin3','class'=>'buttondetail')) }} -->
               {{ Form::close() }}
               <!--  </form> -->
              </section>

              <section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
                {{ Form::open(array('action'=>'HomeController@doRegister','name'=>'regForm','id'=>'regForm')) }}

                <!-- <form> -->
                  <div class="row">
                    <div class="large-12 columns">
                        {{ Form::label('Email Address*','Email Address*',array('id'=>'label')) }}
                          <!-- <input type="text" id="right-label"> -->
                           {{ Form::text('user_email',null,array('id'=>'right-label','size'=>'30','class'=>'required email')) }}
                          
                    </div>
                  </div>


                  <div class="row">
                    <div class="large-12 columns">
                        {{ Form::label('Password*','Password*',array('id'=>'label')) }}
                         <!--  <input type="text" id="right-label"> -->
                          {{ Form::password('pwd',null,array('id'=>'right-label','class'=>'required password','minlength'=>'5')) }}
                    </div>
                  </div>
                  

                  
                     <p id="label">{{ Form::checkbox('terms',null, false) }} 
                     <!-- <input id="checkbox1" type="checkbox"><label for="checkbox1" id="label"> -->
                     I have read and accept terms and conditions
                 
                   <!--   {{ Form::submit('Register',null,array('id'=>'doRegister','value'=>'Register','type'=>'submit')) }} -->
                       <a href="#" id='regBtn' class="secondary small button expand">Register</a></p>
                  
                   
                 {{ Form::close() }}
              <!--  </form> -->
             </section>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>


 <div class="row">

  <div class="large-8 columns">
    <h4>The real Peer-to-Peer finance hub:</h4>
    <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
    <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
  </div>

  <div class="large-4 columns">
    <h1 id="word1">MoneyLink</h1>
    <h4 id="word2">MOST TRUSTED</h4>
    <p id="word3">LOAN PROVIDER</p>
  </div>

</div>



<footer>
    <div class="row">
      <div class="large-6 columns">
        <img id="logo" src="../foundation-5.4.0/img/logos.png">
          <img id="font" src="../foundation-5.4.0/img/font.png">
      </div>
      <div class="large-6 columns">
        <ul class="inline-list right">
          <li><a href="#" id="bottom_links">Contact Us</a></li>
          <li><a href="#" id="bottom_links">Register</a></li>
          <li><a href="#" id="bottom_links">Privacy Policy</a></li>
          <li><a href="#" id="bottom_links">Term of Use</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <script src="../foundation-5.4.0/js/vendor/jquery.js"></script>
  <script src="../foundation-5.4.0/js/foundation/foundation.js"></script>
    <script src="../foundation-5.4.0/js/loanApp.js"></script>
  <script src="../foundation-5.4.0/js/foundation/foundation.topbar.js"></script>
  <script src="../foundation-5.4.0/js/foundation/foundation.tab.js"></script> 
  <script>
  $(document).foundation();
  getStep();
  enableBtns();
  </script>   
</body>
</html>
