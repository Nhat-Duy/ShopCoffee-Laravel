<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="apple-touch-icon" sizes="76x76" href="public/backend/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="public/backend/img/favicon.png" />
    <title>Đăng nhập Auth</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="public/backend/css/nucleo-icons.css" rel="stylesheet" />
    <link href="public/backend/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="public/backend/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <!-- component -->
    <div class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
      <div class="relative py-3 sm:w-96 mx-auto text-center">
        <span class="text-2xl font-light ">Đăng nhập Auth</span>
        <br>
        <?php
        $message = Session::get('message');
        if($message){
          echo $message;
          Session::put('message', null);
        } 
        ?>
        <form action="{{URL::to('/dangnhap_auth')}}" method="post">
          {{ csrf_field() }}
          <div class="mt-4 bg-white shadow-md rounded-lg text-left">
            <div class="h-2 bg-purple-400 rounded-t-md"></div>
            <div class="px-8 py-6 ">
              <label class="block font-semibold"> Email </label>
              <input type="text" name="admin_email" placeholder="abc@gmail.com" value="{{old('admin_email')}}" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md">
              <label class="block mt-3 font-semibold"> Mật khẩu </label>
              <input type="password" name="admin_password" placeholder="Password" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md">
                <div class="flex justify-between items-baseline">
                  <button type="submit" class="mt-4 bg-purple-400 text-black py-2 px-6 rounded-md hover:bg-purple-600">Đăng nhập</button>
                  <a href="#" class="text-sm hover:underline">Quên mật khẩu</a>
                </div>
                <a href="{{url('/login_google')}}" class="text-sm hover:underline">Login GG</a> |
                <a href="{{url('/show_dangky_admin')}}" class="text-sm hover:underline">Đăng ký Admin</a>
            </div>
        </form>
      </div>
    </div>
  </body>
</html>