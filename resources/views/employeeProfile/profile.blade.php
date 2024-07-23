<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile page</title>
    <link rel="stylesheet" href="{{ asset('build/assets/css/profileCssPage.css') }}">
    <link rel="website icon" type="png" href="{{ asset('images/perfume.png') }}" >
</head>
<body >
    {{-- @if(session()->has('empId')) --}}
    @if (Cookie::get('empId') !== false)
        <div class="items">
        <div class="title" >
            <p class="awtar">{{ $emp->user->araName }}</p>
            <p class="awtar">{{ $emp->user->engName }}</p>  
            <p class="awtar"> &nbsp;</p>
        </div>
        <aside class="profile-card">
            <header>
              <!-- here’s the avatar -->
              <a target="_self" href="#">
                <img src="{{ $emp->img }}" alt="no img" class="hoverZoomLink">
              </a>
              <!-- the username -->
                <h1>{{ $emp->firstName }} {{ $emp->lastName }}</h1>
                <h2>{{ $emp->phone }}</h2>
            </header>
            <div class="profile-bio">
              <p class="info" dir="rtl">مكان العمل <i style="color: rgb(248, 164, 164);"> {{ $emp->address }}</i></p>     
              <p class="info"dir="rtl">العمر <i style="color: rgb(248, 164, 164);"> {{ $emp->age }}</i></p>     
              <p class="info"dir="rtl">عدد مرات أستخدام الكرت <i style="color: rgb(248, 164, 164);"> {{ $emp->numUsedCard }}</i></p>
              <p class="info"><button class="info" id="b1" onclick="logout(this)" >نسجيل الخروج</button></p>
              <form class="info" action="{{ route('empLogout') }}" method="post">
                @csrf
                @method('GET')
                <input  style="background-color: rgb(211, 92, 92);visibility: hidden;" id="i1" type="submit" value="هل متأكد" />
              </form>
            </div>
            <!-- some social links to show off -->
            <!-- <ul class="profile-social-links">
              <li>
                <a target="_blank" href="https://www.facebook.com/creativedonut">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li>
                <a target="_blank" href="https://twitter.com/dropyourbass">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
              <li>
                <a target="_blank" href="https://github.com/vipulsaxena">
                  <i class="fa fa-github"></i>
                </a>
              </li>
              <li>
                <a target="_blank" href="https://www.behance.net/vipulsaxena">
                 
                  <i class="fa fa-behance"></i>
                </a>
              </li>
            </ul> -->
          </aside>
        </div>
        @else
    <h1>please login to countinue</h1>
    @endif
    <script>
      function logout(b1){
           b1.style.display='none';
           document.getElementById('i1').style.visibility='visible';
      }
    </script>
  </body>
</html>