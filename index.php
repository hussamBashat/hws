<?php
session_start(); 
$Title = "الصفحة الرئيسية";
include "include/Functions.php";
include "include/header.php"; ?>
    <!-- Start Hrader -->
    <header class="main-header">
      <!-- Start Navbar -->
      <?php include "include/navbar.php"; ?>
      <div class="container">
        <div class="row row-header">
          <div class="col s12 m6 p-0">
            <div class="header-box">
              <div class="header-text">
                <p>We have <span class="red-text lighten-2">2,000</span> great job offers you deserve!</p>
                <h1>Largest Job Site In The World.</h1>
              </div>
            </div>
          </div>
          <div class="col s12 m6 p-0">
            <img src="images/header-img.svg" alt="Header image" class="responsive-img">
          </div>
        </div>
        <!-- Start Filter -->
        <div class="row filter">
          <div class="col s12 p-0">
            <ul class="tabs">
              <li class="tab col s3"><a href="#job" class="active">Find a Job</a></li>
              <li class="tab col s3"><a href="#candidate">Find a Candidate</a></li>
            </ul>
          </div>
          <div id="job" class="col s12 tab-content">
            <form method="POST" action="" class="m-0">
              <div class="flex-between">
                <div class="input-field custom">
                  <i class="material-icons prefix">work</i>
                  <input id="icon_work" type="text" class="validate">
                  <label for="icon_work">eg. Web Developer</label>
                </div>
                <div class="input-field custom">
                  <select>
                    <option value="" disabled selected>Category</option>
                    <option value="1">Full Time</option>
                    <option value="2">Part Time</option>
                    <option value="3">Freelance</option>
                    <option value="4">Internship</option>
                    <option value="5">Temporary</option>
                  </select>
                </div>
                <div class="input-field custom">
                  <i class="material-icons prefix">location_on</i>
                  <input id="icon_location_on" type="text" class="validate">
                  <label for="icon_location_on">Location</label>
                </div>
                <button class="btn-floating circle waves-effect waves-light"><i class="material-icons">search</i></button>
              </div>
            </form>
          </div>
          <div id="candidate" class="col s12 tab-content">
            <form method="POST" action="" class="m-0">
              <div class="flex-between">
                <div class="input-field custom">
                  <i class="material-icons prefix">person</i>
                  <input id="icon_person" type="text" class="validate">
                  <label for="icon_person">eg. hussam bashat</label>
                </div>
                <div class="input-field custom">
                  <select>
                    <option value="" disabled selected>Category</option>
                    <option value="1">Full Time</option>
                    <option value="2">Part Time</option>
                    <option value="3">Freelance</option>
                    <option value="4">Internship</option>
                    <option value="5">Temporary</option>
                  </select>
                </div>
                <div class="input-field custom">
                  <i class="material-icons prefix">location_on</i>
                  <input id="icon_location_on2" type="text" class="validate">
                  <label for="icon_location_on2">Location</label>
                </div>
                <button class="btn-floating circle waves-effect waves-light"><i class="material-icons">search</i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>
    <!--  Wht Us Section -->
    <section class="why-our">
      <div class="container">
        <div class="row m-0">
          <div class="col s12 m6 l4">
            <div class="card m-0">
              <div class="icon">
                <i class="material-icons prefix">assignment</i>
                <h5>Search Millions of Jobs</h5>
              </div>
              <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card m-0">
              <div class="icon">
                <i class="material-icons prefix">touch_app</i>
                <h5>Easy To Manage Jobs</h5>
              </div>
              <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card m-0">
              <div class="icon">
                <i class="material-icons prefix">trending_up</i>
                <h5>Top Careers</h5>
              </div>
              <div class="card-content">
                <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Top Category Section -->
    <section class="category">
      <div class="container">
        <h2 class="center-align">Top Category</h2>
        <div class="row">
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Web Development</h6>
                  <div><span class="badge">201</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Education & Training</h6>
                  <div><span class="badge">75</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>PHP Programming</h6>
                  <div><span class="badge">120</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Web Designer</h6>
                  <div><span class="badge">230</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Graphic Designer</h6>
                  <div><span class="badge">143</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>English</h6>
                  <div><span class="badge">200</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Project Management</h6>
                  <div><span class="badge">20</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Customer Service</h6>
                  <div><span class="badge">306</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>Marketing & Sales</h6>
                  <div><span class="badge">157</span> <span>Open Option</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_right</i>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Search Job Section -->
    <section class="search-job">
      <div class="container">
        <div class="row m-0">
          <div class="col s12 m10 l7">
            <div class="card">
              <i class="material-icons prefix">search</i>
              <div class="content">
                <h6>Search Job</h6>
                <h2>Browse Job by Specialism</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Hot Jobs Section -->
    <section class="hot-jobs">
      <div class="container">
        <div class="row">
          <div class="col s12 m8">
            <h2>Hot Jobs</h2>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Frontend Development</h6>
                  <span class="badge">Partime</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> FACEBOOK, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Full Stack Developer</h6>
                  <span class="badge">Fulltime</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> GOOGLE, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Open Source Interactive Developer</h6>
                  <span class="badge">Freelance</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i>  NEW YORK TIMES, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Frontend Development</h6>
                  <span class="badge">Partime</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> FACEBOOK, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Full Stack Developer</h6>
                  <span class="badge">Fulltime</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> GOOGLE, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>Open Source Interactive Developer</h6>
                  <span class="badge">Freelance</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i>  NEW YORK TIMES, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> WESTERN CITY, UK</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">Apply</a>
            </div>
          </div>
          <div class="col s12 m4">
            <h2>Top Agencies</h2>
            <div class="card">
              <a href="#">
                <div class="icon flex-between">
                  <i class="material-icons prefix">facebook</i>
                </div>
                <div class="card-footer">
                  <h6>Facebook Company</h6>
                  <div><span class="badge">200</span> <span>Open Option</span></div>
                </div>
              </a>
            </div>
            <div class="card">
              <a href="#">
                <div class="icon flex-between">
                  <i class="material-icons prefix">surround_sound</i>
                </div>
                <div class="card-footer">
                  <h6>Surround Company</h6>
                  <div><span class="badge">125</span> <span>Open Option</span></div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial Section -->
    <section class="testimonial">
      <h2 class="center-align">Happy Clients</h2>
      <div class="carousel">
        <div class="container">
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/1" class="responsive-img">
            </div>
            <h6>Hussam Bashat</h6>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum, optio dolor? Repellendus eos, cum, dolorem recusandae a deleniti minus eveniet provident tenetur eligendi accusantium dicta itaque sapiente. Assumenda, sunt quod?</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/2" class="responsive-img">
            </div>
            <h6>Wael Damlakhi</h6>
            <p>Repellendus eos, cum, dolorem recusandae a deleniti minus eveniet provident tenetur eligendi accusantium dicta itaque sapiente. Assumenda, sunt quod?</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/3" class="responsive-img">
            </div>
            <h6>Saaid AL-Haddad</h6>
            <p>Coptio dolor? Repellendus eos, cum, dolorem recusandae a deleniti minus eveniet provident tenetur eligendi accusantium dicta itaque sapiente. Assumenda, sunt quod?</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/4" class="responsive-img">
            </div>
            <h6>Amer AL-Ahmad</h6>
            <p>Ctenetur eligendi accusantium dicta itaque sapiente. Assumenda, sunt quod?</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/5" class="responsive-img">
            </div>
            <h6>Khaled Homs</h6>
            <p>Coptio dolor?  tenetur eligendi accusantium dicta itaque sapiente dicta itaque sapiente. Assumenda, sunt quod?</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Subcribe Section -->
    <section class="subcribe center-align">
      <div class="container">
        <h5>Subcribe to our Newsletter</h5>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
        <form method="POST" action="">
          <div class="input-field m-0">
            <input id="email" type="email" class="validate">
            <label for="email">Enter email address</label>
          </div>
          <button class="btn waves-effect waves-light">Subcribe</button>
        </form>
      </div>
    </section> 
    <!-- Footer -->
    
<?php
include "include/footer-design.php";
include "include/footer.php";
?>
