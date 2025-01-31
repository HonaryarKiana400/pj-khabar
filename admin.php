<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
      body {
        margin: 0;
        padding: 0;
      }

      .main-content {
        padding: 20px;
      }

      .sidebar {
        padding: 20px;
        background-color: #f0f0f0;
        height: 100vh;
        position: fixed;
        right: 0;
        top: 0;
      }

      .sidebar .navbar {
        padding: 0;
      }

      .sidebar .nav-link {
        padding: 10px;
        border-bottom: 1px solid #ccc;
      }

      .sidebar .nav-link:hover {
        background-color: #ddd;
      }

      .scrollable-field {
        margin-right: 431px;
        margin-left: -352px;
        height: 200px;
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .link-containe{
        bottom: 0;
        left: 0;
        position: fixed;
        margin-bottom: 25px;
        margin-left: 10px;
        background-color: #ccc;
        text-decoration: none;
        border-radius: 10px;
        padding: 5px;
        color: black;
        
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9 main-content">
          
          <h2 style="text-align: center; ;padding: 15px;">اطلاعات همه خبرها</h2>

          <div class="scrollable-field">
            
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یکظ متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
            <p>این یک متن طولانی است.</p>
          </div>

          <a class="link-containe" href="">بازگشت به صفحه اصلی</a>
        </div>
        <div class="col-md-3 sidebar">
          <h1 style="text-align: start">
            <i class="bi bi-person"></i>
            پنل مدیریت</h1>
          <p style="text-align: start;font-size: 22px;">به پنل مدیریت خوش آمدید</p>
          <nav
            class="navbar navbar-expand-lg navbar-light"
            style="
              margin-right: 55px;
              height: 651px;
              text-align: center;
              margin-left: 95px;
            "
          >
            <ul
              class="navbar-nav flex-column"
              style="gap: 181px; font-weight: bold; font-size: 20px"
            >
              <li class="nav-item">
                <a class="nav-link" href="#">همه اخبار</a>
              </li>
    
              <li class="nav-item">
                <a class="nav-link" href="#">لیست کاربران</a>
              </li>


            </ul>
          </nav>
        </div>
      </div>
    </div>
  </body>
</html>
