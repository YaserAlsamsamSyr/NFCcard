<!DOCTYPE html>
<html lang="en">
<head>
    <title>add employee</title>
    @include('components.part1')
    <link href="{{ asset('build/assets/css/addEmployee.css') }}" rel="stylesheet">
</head>
<body >
    <header class="body-header">
        <nav class="navbar navbar-light shadow">
            <a class="navbar-brand ms-auto" href="{{ route('home') }}">عودة</a>
        </nav>
    </header>     
    <section class='error-message'> 
        <div class="container w-50 error-container" dir="rtl">
            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} .<br>
                    @endforeach
            </div>
            @endif
            @if($created==true)
                <div class="alert alert-success">
                    تمت الأضافة
                </div>
            @endif
        </div>
    </section>
    <br><br>
    <section class="form-section">
        <div class="container container-form shadow">
                    <div class="container-fluid" dir="rtl">
                        <h2>اضافة موظف جديد</h2>
                             <form class="form-signup" method="POST" action="/employee" enctype="multipart/form-data">
                                @csrf
                                 <div class="form-group">
                                     <p>أختر صورة</p>
                                     <input type="file" class="form-control border border-success" name="img" required />
                                 </div>
                                 <div class="form-group">
                                     <p>الأسم</p>
                                     <input type="text"name="firstName" class="form-control border border-success" value="{{ old('firstName') }}" required autofocus/>
                                 </div>
                                 <div class="form-group">
                                     <p>الكنية</p>
                                     <input type="text" class="form-control border border-success" name="lastName" value="{{ old('lastName') }}" required />
                                 </div>
                                 <div class="form-group">
                                     <p>عنوان مكان العمل</p>
                                     <input type="text" class="form-control border border-success"name="address" value="{{ old('address') }}" required />
                                 </div>
                                 <div class="form-group">
                                     <p>العمر</p>
                                    <input class="form-control border border-success" type="number" name="age" value="{{ old('age') }}" required />
                                </div>
                                 <div class="form-group">
                                     <p>رقم الهاتف</p>
                                     <input class="form-control border border-success" type="number" name="phone" value="{{ old('phone') }}" required />
                                 </div>
                                 <div class="form-group">
                                    <p>كلمة سر</p>
                                    <input class="form-control border border-success" type="password" name="password" value="{{ old('password') }}" required />
                                </div>
                                 <div class="button-align">
                                    <button  type="submit" class="btn btn-success w-50">submit</button>
                                 </div>
                             </form>
                    </div>
        </div>
    </section>
    @if($errors->any() || $created==true)
        <script>
                setTimeout(function() {
                          let s=document.getElementsByClassName('alert');
                          for(i=0;i<s.length;i++)
                              s[i].style.visibility="hidden";
                }, 3000);
        </script>
    @endif
@include('components.part2')