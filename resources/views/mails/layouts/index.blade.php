<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
  <style>
    * {
      font-style: Arial, sans-serif;
    }  
  </style>
  <table width="100%" bgcolor="#fff" style="padding: 20px;">
    <tr>
      <td>
        <table style="width:640px; margin: 0 auto; background: #fff;">
          <tr>
            <td>
              <div style="color:rgba(0,0,0,0.54);padding: 0 20px">
                <a href="#">
                  <img src="{{ asset('/assets/mails/logo.png') }}" alt="">
                </a>
              </div>
              <div style="height:2px;border-bottom:1px solid #e5e5e5"></div>
            </td>
          </tr>
          <tr>
            <td>
              <div style="padding:20px">
                  @yield('content')
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div style="background-color: #000a1e; padding: 15px 43px; text-align: center;">
                <a href="{{ route('site.home') }}">
                  <img width="30px" style="filter: grayscale(1);" src="{{ asset('/assets/mails/logo-grayscale.png') }}" alt="">
                </a>
                <p style="font-size: 12px;color: #a3a3a3;letter-spacing: .64px; text-align: center;"> © 2020 Event Outlet – информационный портал по поиску исполнителей на мероприятия. </p>
                <div style="height:2px;border-bottom:1px solid #4f4f4f;"></div>
                <div>
                  <a href="{{ route('site.home') }}" style="color:#fff; font-size: 12px;">Главная</a> |
                  <a href="{{ route('site.offers.index') }}" style="color:#fff; font-size: 12px;">Каталог</a> |
                  <a href="{{ route('site.process') }}" style="color:#fff; font-size: 12px;">Как работает портал</a>
               </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    
  </table>

</body>
</html>