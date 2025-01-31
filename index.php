<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پایگاه خبری</title>

    <!-------css link---->
    <link rel="stylesheet" href="style.css">


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vazir-font@2.1.0/dist/font-face.css">


	


</head>
<body>

    

    <div class="all">
     
        <!------ start navbar------------->
        <nav class="navbar navbar-dark fixed-top" style=" background-color: #f0f0f0; padding-top: 32px; padding-bottom: 18px;" >
            <div class="container-fluid">
                <a class="navbar-brand" style="color: rgb(143, 140, 140); margin-left: 20px;  font-weight: bold; font-size: 26px;" href="login1.php">
                    <i class="bi bi-person"></i>
                    login  
                </a>

                <div class="search">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        
                    </form>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle bttn-all " style="margin-left:20px" data-bs-toggle="dropdown">
                      اخبار
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" style="text-align: end; ">
                      <li><a class="dropdown-item text-secondary" href="#">سیاسی</a></li>
                      <li><a class="dropdown-item text-secondary" href="#"> اقتصادی</a></li>
                      <li><a class="dropdown-item text-secondary" href="#">فرهنگی</a></li>
                      <li><a class="dropdown-item text-secondary" href="#">علمی</a></li>
                      <li><a class="dropdown-item text-secondary" href="#">هنری</a></li>
                      <li><a class="dropdown-item text-secondary" href="#">ورزشی</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">اخبار مهم</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!------ end navbar------------->
       <!----------start carousel----------------------------->
        <div class="title"style=" margin-top: 110px;margin-right:35px; text-align:right; font-weight: bold; font-size: 26px;">
            اخبار داغ
        </div>
        


        <div class="row akbar-dagh" style="margin:35px 10px">
            <div class="col-md-6" >
            
                <div class="row">
                    <div class="col-md-6 khabar-4" style="width: 371px;">
                        <a href="">
                        <img src="img/جنگنده+سوخو+57.jpg" class="img-carosel d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block" >
                        سوخو ۵۷ پیشرفته ترین جنگنده روسیه در راه ایران 
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 khabar-4" style="width: 371px;">
                        <a href="">
                        <img src="img\/اقتصاد+چین.jpg" class="img-carosel d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          جنگ جهانی پنهان؛ چرا غرب نمی‌خواهد کریدورهای تجاری از ایران و ترکیه عبور کنند؟ 
                        </div>
                        </a>
                    </div>
                </div>
                <div class="row" style="margin-top:24px ;">
                    <div class="col-md-6 khabar-4" style="width: 371px;">
                        <a href="">
                        <img src="img/metro.jpg" class="img-carosel d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                          جزئیات احداث خط ۱۰ مترو و توسعه خط 7
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 khabar-4" style="width: 371px;">
                        <a href="">
                        <img src="img/javad.jpg" class="img-carosel d-block w-100" alt="..." style="    height: 196px;">
                        <div class="carousel-caption d-none d-md-block">
                          جواد نکونام: آقایان خدا خدا می‌کردند از استقلال بروم
                        </div>
                        </a>
                    </div>
                </div>
            </div>

            <!---------------------------->

            <div class="col-md-6">
                <div id="carouselExampleDark" class="carousel carousel-dark slide " >
                    <div class="carousel-indicators ">
                      <button type="button " data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-bs-interval="10000">
                        <img src="img/diplom.jpg" class=" d-block w-100" alt="..." style="    height: 449px;">
                        <div class="carousel-caption d-none d-md-block text-white"  style=" margin-bottom: 50px; padding-left: 40px;">
                          
                          <p class="bottom-right">مهلت معرفی مشمولان فارغ التحصیل دیپلم ۹۸ تا ۳۱ شهریو</p>
                        </div>
                      </div>
                      <div class="carousel-item" data-bs-interval="2000">
                        <img src="img/khodro.jpg" class="d-block w-100" alt="..." style="    height: 449px;">
                        <div class="carousel-caption d-none d-md-block text-white" style=" margin-bottom: 50px; padding-left: 40px;">
                          
                          <p >ورود خودرو به بورس منتفی شد/ احتمال افزایش قیمت خودرو وجود داشت</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img src="img/kargardan.jpg" class="d-block w-100" alt="..." style="    height: 449px;">
                        <div class="carousel-caption d-none d-md-block text-white"  style=" margin-bottom: 50px; padding-left: 140px;">
                          
                          <p>واکنش کارگردان «خرس» به قاچاق فیلمش</p>
                        </div>
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
    
            </div>



        </div>

        <!--------end carousel--------------------->

        <!--------start daste bandi-------------------------------->

        <div class="title" style=" margin-top: 110px;margin-right:35px; text-align:right; font-weight: bold; font-size: 26px;">
          دسته بندی 
        </div>

        <div class="container" style="margin-top: 25px;">
          <div class="row">
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/siasi.jpg" alt="">
                <div class="card-title text-white">سیاسی</div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/eghtesadi.jpg" alt="">
                <div class="card-title text-white">اقتصادی</div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/farhangi.jpg" alt="" style="height: 232px;">
                <div class="card-title text-white">فرهنگی</div>
              </a>
            </div>
          </div>



          <div class="row" style="margin-top: 15px; margin-bottom: 20px;">
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/elmi.jpg" alt="" style="height: 260px;">
                <div class="card-title text-white">علمی</div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/honary3.jpg" alt="" style="height: 260px;">
                <div class="card-title text-white">هنری</div>
              </a>
            </div>
            <div class="col-md-4">
              <a href="" class="card">
                <img src="img/varzeshi.jpg" alt="" style="height: 258px;">
                <div class="card-title text-white">ورزشی</div>
              </a>
            </div>
          </div>


        </div>


        <!--------------footer------------------------>
        
        <div class="d-flex flex-column min-vh-100">
          <div class="container mt-5">
              <!-- محتوای اصلی -->
          </div>
          <footer class="mt-auto">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-6">
                          <p>سایت خبری</p>
                          <div class="d-flex justify-content-center">
                              <a href="#" target="_blank" class="me-3">
                                  <i class="bi bi-instagram fs-4"></i>
                              </a>
                              <a href="#" target="_blank" class="me-3">
                                  <i class="bi bi-telegram fs-4"></i>
                              </a>
                              <a href="#" target="_blank">
                                  <i class="bi bi-whatsapp fs-4"></i>
                              </a>
                          </div>
      
                          <p>تمام حقوق مادی و معنوی به این سایت متعلق می‌باشد و استفاده از مطالب با ذکر منبع بلامانع است</p>
                      </div>
                  </div>
              </div>
          </footer>
      </div>
      
    </div>


        



  

</body>
</html>