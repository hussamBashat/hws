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
                <p>لدينا <span class="red-text lighten-2">2,000</span> عرض عمل رائع تستحقه!</p>
                <h1>هل تعاني من إيجاد عمل خارج بلدك؟</h1>
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
              <li class="tab col s3"><a href="#job" class="active">ابحث عن وظيفة</a></li>
              <li class="tab col s3"><a href="#candidate">ابحث عن مرشح</a></li>
            </ul>
          </div>
          <div id="job" class="col s12 tab-content">
            <form method="POST" action="" class="m-0">
              <div class="flex-between">
                <div class="input-field custom">
                  <i class="material-icons prefix">work</i>
                  <input id="icon_work" type="text" class="validate">
                  <label for="icon_work">مثال. مطور ويب</label>
                </div>
                <div class="input-field custom">
                  <select>
                    <option value="" disabled selected>الفئة</option>
                    <option value="1">دوام كامل</option>
                    <option value="2">دوام جزئى</option>
                    <option value="3">عمل حر</option>
                    <option value="4">فترة تدريب</option>
                    <option value="5">مؤقت</option>
                  </select>
                </div>
                <div class="input-field custom">
                  <i class="material-icons prefix">location_on</i>
                  <input id="icon_location_on" type="text" class="validate">
                  <label for="icon_location_on">الموقع</label>
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
                  <label for="icon_person">مثال. حسام باشات</label>
                </div>
                <div class="input-field custom">
                  <select>
                  <option value="" disabled selected>الفئة</option>
                    <option value="1">دوام كامل</option>
                    <option value="2">دوام جزئى</option>
                    <option value="3">عمل حر</option>
                    <option value="4">فترة تدريب</option>
                    <option value="5">مؤقت</option>
                  </select>
                </div>
                <div class="input-field custom">
                  <i class="material-icons prefix">location_on</i>
                  <input id="icon_location_on2" type="text" class="validate">
                  <label for="icon_location_on2">الموقع</label>
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
                <h5>وظائف مناسبة للجميع</h5>
              </div>
              <div class="card-content">
                <p>ابدأ بتحقيق حلمك معنا واختر الوظيفة التي تناسبك من بين ألاف الوظائف المتاحة بسهولة تامة.</p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card m-0">
              <div class="icon">
                <i class="material-icons prefix">touch_app</i>
                <h5>لا تجعل المسافة توقفك</h5>
              </div>
              <div class="card-content">
                <p>اعلم أننا سنؤمن لك كافة اللوازم لكي تصل إلى مكان عملك بأفضل و أسرع الطرق بغض النظر عن مكانك الحالي.</p>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l4">
            <div class="card m-0">
              <div class="icon">
                <i class="material-icons prefix">trending_up</i>
                <h5>لا تخف فأنت في أمان.</h5>
              </div>
              <div class="card-content">
                <p>لا يرتابك الشك أنك في المكان الخاطئ .كل معاملاتنا خاضعة للرقابة القانونية و سنكون مسؤولون عن أي خطأ يحدث.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Top Category Section -->
    <section class="category">
      <div class="container">
        <h2 class="center-align">الأكثر طلباً</h2>
        <div class="row">
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مطور ويب</h6>
                  <div><span class="badge">201</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>التعليم والتدريب</h6>
                  <div><span class="badge">75</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مبرمج PHP</h6>
                  <div><span class="badge">120</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مصمم ويب</h6>
                  <div><span class="badge">230</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مصمم جرافيك</h6>
                  <div><span class="badge">143</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مدرس لغة إنجليزية</h6>
                  <div><span class="badge">200</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>مدير مشاريع</h6>
                  <div><span class="badge">20</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>خدمة العملاء</h6>
                  <div><span class="badge">306</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
              </div>
            </a>
          </div>
          <div class="col s12 m6 l4">
            <a href="#">
              <div class="cat-box flex-between">
                <div class="cat-text">
                  <h6>تسويق ومبيعات</h6>
                  <div><span class="badge">157</span> <span>معرقة المزيد</span></div>
                </div>
                <i class="material-icons prefix">keyboard_arrow_left</i>
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
                <h6>ابحث عن وظيفة</h6>
                <h2>اسأل خبير</h2>
                <p>لا تكن في حيرة في أمرك ، إن لم تجد سؤالك في <a href="faq.php" class="custom-link">الأسئلة الشائعة</a> فيمكنك استشارة خبير لدينا مباشرة و اربح الوقت فلدينا خدمة على مدى 24 ساعة للرد على العملاء ضمن نظام مراقبة للجودة كل ما عليك ارسال رسالة و الانتظار لدقائق قليلة ليأتيك الرد.</p>
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
            <h2>أُضيفت حديثاً</h2>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>مطور الواجهة الأمامية</h6>
                  <span class="badge">دوام جزئي</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> CODEZONE, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> السعودية, الرياض</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>مهندس برمجيات</h6>
                  <span class="badge">دوام كامل</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> NOPUG, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> ويسترين سيتي, المملكة المتحدة</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>تسويق إلكتروني</h6>
                  <span class="badge">عن بعد</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i>  ONE TIMES, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> المانيا, كولونيا </span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>مترجم لغة إنجليزية</h6>
                  <span class="badge">دوام جزئي</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> MOON, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> العراق, بغداد</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>مطور أندرويد</h6>
                  <span class="badge">تدريب</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i> GOOGLE, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> ويسترين سيتي, المملكة المتحدة</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
            <div class="job-box flex-between">
              <div class="job-text">
                <div class="flex-between">
                  <h6>مصمم موشن جرافيك</h6>
                  <span class="badge">Freelance</span>
                </div>
                <div class="info">
                  <a href="#"><i class="material-icons prefix">layers</i>  MOTION, INC.</a>
                  <span><i class="material-icons prefix">gps_fixed</i> الصين, شينزين</span>
                </div>
              </div>
              <a href="#" class="btn waves-effect waves-light">تقديم</a>
            </div>
          </div>
          <div class="col s12 m4">
            <h2>كبار الشركات</h2>
            <div class="card">
              <a href="#">
                <div class="icon flex-between">
                  <i class="material-icons prefix">facebook</i>
                </div>
                <div class="card-footer">
                  <h6>شركة فيسبوك</h6>
                  <div><span class="badge">200</span> <span>عرض المزيد</span></div>
                </div>
              </a>
            </div>
            <div class="card">
              <a href="#">
                <div class="icon flex-between">
                  <i class="material-icons prefix">surround_sound</i>
                </div>
                <div class="card-footer">
                  <h6>شركة ساوند</h6>
                  <div><span class="badge">125</span> <span>عرض المزيد</span></div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonial Section -->
    <section class="testimonial">
      <h2 class="center-align">عملاء سعداء</h2>
      <div class="carousel">
        <div class="container">
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/1" class="responsive-img">
            </div>
            <h6>ناظم أبو الخل</h6>
            <p>من أفضل التجارب التي خضتها في حياتي و كانت نقطة فصل بين حياتي بلا عمل إلى حياة جديدة بعمل مناسب و براتب مناسب، كم جعلت الحياة أبسط مما أتخيل.</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/2" class="responsive-img">
            </div>
            <h6>محمد وليد</h6>
            <p> لم أكن أتخيل وجود مثل هذه الخدمة التي سارعت و التسجيل فيها فور معرفتي بوجودها و كانت النتيجة أن تحقق حلمي و العمل كممرض في مشفى الرياض في السعودية.</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/3" class="responsive-img">
            </div>
            <h6>شمس الصباح</h6>
            <p>الحمدلله الذي منحني بعد عناء بحث لمدة سنين أن أحظى بوظيفة براتب جيد و كل هذا بفضل الله ثم هذه الخدمة.</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/4" class="responsive-img">
            </div>
            <h6>احمد الاحمد</h6>
            <p> خدمة رائعة بالفعل ، و الأروع من ذلك المعاملة الطيبة لمختلف موظفي الشركة المقدمة للخدمة ، كل التوفيق لهم.</p>
          </div>
          <div class="carousel-item">
            <div class="img-container">
              <img src="https://lorempixel.com/250/250/nature/5" class="responsive-img">
            </div>
            <h6>قمر المساء</h6>
            <p> أنصح و بشدة لكل من لا يجد عمل المسارعة و التسجيل في الخدمة و إن شاء الله ستجد نفسك في المكان المناسب.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Subcribe Section -->
    <section class="subcribe center-align">
      <div class="container">
        <h5>اشترك في نشرتنا الإخبارية</h5>
        <p>سارع في الاشتارك في النشرة الإخبارية لتصلك كل الوظائف الجديدة على بريدك الإلكتروني.</p>
        <form method="POST" action="">
          <div class="input-field m-0">
            <input id="email" type="email" class="validate">
            <label for="email">أدخل البريد الإلكتروني</label>
          </div>
          <button class="btn waves-effect waves-light">اشتراك</button>
        </form>
      </div>
    </section> 
    <!-- Footer -->
    
<?php
include "include/footer-design.php";
include "include/footer.php";
?>
