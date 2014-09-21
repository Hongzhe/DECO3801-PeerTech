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
     </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
     <li class="toggle-topbar menu-icon"><a href="index.html"><span>Menu</span></a></li>
   </ul>
   <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="profile" id="welcome">Welcome {{{ $data['userfname'] or "" }}}</a></li> 
      <li><a href="logout">Logout</a></li>

    </ul>
  </section>
</nav>


<div class="row">
  <div class="large-12 columns">

    <! tab titles -->
    <ul class="tabs" data-tab role="tablist">
      <li class="tab-title active" role="presentational"><a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" controls="panel2-1">Edit Profile</a></li>
    </ul>

    <div class="tabs-content"  id="main_tab">

      <! edit profile page -->
      <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
        <div class="large-12 columns">
          <p>Please complete your profile.</p>
          <!-- <form> -->
          {{ Form::open(array('action'=>'UserProfileController@saveProfile','name'=>'regForm','id'=>'ProfileForm')) }} 
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">First Name:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('fname', $data['userfname'] ,array('id'=>'right-label','class'=>'large-5 column','minlength'=>'3')) }}
                    <!-- <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>


            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Last Name:</label>
                  </div>
                  <div class="large-5 columns">
                  {{ Form::text('lname',$data['userlname'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'5')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Date of Birth:</label>
                  </div>
                  <!-- <div class="large-1 columns"id="space">n
                  </div> -->
                  <div class="large-1 columns">
                    <!-- <input type="text" id="right-label"> -->
                     {{ Form::text('day_dob', $data['day_dob'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                  </div>
                  <!-- <div class="large-1 columns"id="space">n
                  </div> -->
                  <div class="large-2 columns">
                    <!-- <input type="text" id="right-label"> -->
                     {{ Form::select('month_dob', array('1'=>'January','2'=>'Febuary','2'=>'Febuary','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'), $data['month_dob']) }}
                  </div>
                  <!-- <div class="large-1 columns"id="space">n
                  </div> -->
                  <div class="large-2 columns">
                    <!-- <input type="text" id="right-label"> -->
                     {{ Form::text('year_dob', $data['year_dob'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Gender:</label>
                  </div>
                  <div class="large-2 columns">
                   {{ Form::select('gender',array('M'=>'Male','F'=>'Female'), $data['usergender']) }}
                   <!-- <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>            
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Phone Number:</label>
                  </div>
                  <div class="large-5 columns">
                    {{ Form::text('phone', $data['userphone'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                    <!-- <input type="text" id="right-label"> -->
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class=" right inline">Unit/Number:</label>
                  </div>
                  <!-- <div class="large-1 columns"id="space">n
                  </div> -->
                  <div class="large-1 columns">
                  {{ Form::text('streetno',$data['userstreetno'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
                  <div class="large-1 columns">
                    <label for="right-label" class="right inline">Street:</label>
                  </div>
                  <div class="large-3 columns">
                   {{ Form::text('street', $data['userstreet'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                  <!--   <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class=" right inline">City:</label>
                  </div>
                  <!-- <div class="large-1 columns" id="space">n
                  </div> -->
                  <div class="large-5 columns">
                  {{ Form::text('suburb', $data['usersuburb'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class=" right inline">State:</label>
                  </div>
                  <!-- <div class="large-1 columns" id="space">n
                  </div> -->
                  <div class="large-2 columns">
                  {{ Form::select('state',array('ACT'=>'Australia Capital Territory',
                  'NSW'=>'New South Wales', 'NT'=> 'North Territory', 'SA'=> 'South Australia', 
                  'TAS'=>'Tasmania', 'WA'=> 'Western Australia','QLD'=> 'Queensland', 'VIC'=>'Victoira'), $data['userstate']) }}

                   <!--  <input type="text" id="right-label"> -->
                  </div>
                  <div class="large-1 columns">
                    <label for="right-label" class=" right inline">Postcode:</label>
                  </div>
                  <div class="large-2 columns">
                   {{ Form::text('postcode',$data['userpostcode'], array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">TFN:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('tfn', $data['usertfn'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Occupation:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('occupation', $data['useroccuptaion'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Primary ID type:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('pidtype', $data['userpidtype'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                   <!--  <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Primary ID Number:</label>
                  </div>
                  <div class="large-5 columns">
                   <!--  <input type="text" id="right-label"> -->
                   {{ Form::text('pidnum', $data['userpidnum'],array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Secondary ID type:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('sidtype', $data['usersidtype'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                    <!-- <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Secondary ID Number:</label>
                  </div>
                  <div class="large-5 columns">
                   {{ Form::text('sidnum', $data['usersidnum'] ,array('id'=>'right-label','class'=>'required username','minlength'=>'3')) }}
                 <!--    <input type="text" id="right-label"> -->
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="large-9 columns">
                  <div class="large-7 columns">
                    <label for="right-label" class="right inline">Self Introduction:</label>
                  </div>
                  <div class="large-5 columns">
                  {{ Form::textarea('description', $data['userdes'], array('id'=>'right-label', 'size'=> '30x5')) }}
                    <!-- <textarea type="text" id="right-label"></textarea> -->
                  </div>
              </div>
            </div>
            <!-- </form> -->
           
           {{ Form::close() }}
           <div class="row">
             <div class="large-8 columns">
             
           <div class="right" id="submit_button"> 
                <a href="#" id='saveProfileBtn' class="secondary small button">Submit</a>
<!--                 {{ Form::submit('saveProfile',null,array('id'=>'saveProfile','class'=>'secondary small button','value'=>'save','type'=>'submit')) }}
 -->            </div>

            <div class="right" id="cancel_button"> 
           <a href="#" class="secondary small button">Cancel</a>
         </div>
           
             </div>
           </div>
          </div>
        </section>
      </div>
    </div>
  </div>




  <footer class="row">
    <div class="large-11 columns">
      <div class="row">
        <div class="large-6 columns">
          <p><img id="logo" src="../foundation-5.4.0/img/logos.png">
           <img id="font" src="../foundation-5.4.0/img/font.png"></p>
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
    </div> 
  </footer>

  <script src="/foundation-5.4.0/js/vendor/jquery.js"></script>
  <script src="/foundation-5.4.0/js/foundation/foundation.js"></script>
  <script src="/foundation-5.4.0/js/loanApp.js"></script>
  <script src="/foundation-5.4.0/js/foundation/foundation.topbar.js"></script>
  <script src="/foundation-5.4.0/js/foundation/foundation.tab.js"></script>
  <script>
  $(document).foundation();
  getStep();
  enableBtns();
  </script>   
</body>
</html>
