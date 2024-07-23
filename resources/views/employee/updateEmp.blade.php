<!DOCTYPE html>
<html lang="en">
<head>
    <title>update employee</title>
    @include('components.part1')
    <link href="{{ asset('build/assets/css/addEmployee.css') }}" rel="stylesheet">
    <style>
        .form-section .img{
            margin: 5%;
        }
    </style>
</head>
<body>

    <header class="body-header">
        <nav class="navbar navbar-light shadow">
            <a class="navbar-brand ms-auto" href="/employee">عودة</a>
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
            @if($isPassUsed===true)
            <div class="alert alert-danger">
                 كلمة سر مستخدمة من قبل موظف أخر
            </div>
            @endif
            @if($isUpdated===true)
                <div class="alert alert-success">
                    تم التعديل بنجاح
                </div>
            @endif
        </div>
    </section>
    <br><br>
    <section class="form-section">
        <div class="container container-form shadow">

<div class="row">
    <div class="col-sm-12 col-md-6">
        <img src="{{ $emp->img }}" alt="no image" class="img-fluid" class="img" />
    </div>
    <div class="col-sm-12 col-md-6">
        

                    <div class="container-fluid" dir="rtl">
                        <form class="form-signup" action="/employee/{{ $emp->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="oldImage" value="{{ $emp->img }}"/>
                            <input type="hidden" name="oldPassword" value="{{ $emp->password }}"/>
                                 <div class="form-group">
                                    <p>أختر صورة ( اذا لم يتم أختيار صورة ستبقى  كما هي )</p>
                                     <input type="file" class="form-control border border-success" name="img" accept="image/png, image/gif, image/jpeg, image/jpg"  />
                                 </div>
                                 <div class="form-group">
                                     <p>الأسم</p>
                                     <input type="text"name="firstName" class="form-control border border-success"  value="{{ $emp->firstName }}" required autofocus/>
                                 </div>
                                 <div class="form-group">
                                     <p>الكنية</p>
                                     <input type="text" class="form-control border border-success" name="lastName" value="{{ $emp->lastName }}" required />
                                 </div>
                                 <div class="form-group">
                                     <p>عنوان مكان العمل</p>
                                     <input type="text" class="form-control border border-success"name="address" value="{{ $emp->address }}" required />
                                 </div>
                                 <div class="form-group">
                                     <p>العمر</p>
                                    <input class="form-control border border-success" type="number" name="age" value="{{ $emp->age }}" required />
                                </div>
                                 <div class="form-group">
                                     <p>رقم الهاتف</p>
                                     <input class="form-control border border-success" type="number" name="phone" value="{{ $emp->phone }}" required />
                                 </div>
                                 <div class="form-group">
                                    <p>كلمة سر</p>
                                    <input class="form-control border border-success" type="password" name="password" value="{{ $emp->password }}" required />
                                </div>
                                 <div class="button-align">
                                    <button  type="submit" class="btn btn-success w-50">تعديل</button>
                                 </div>
                             </form>
                    </div>


                </div>
            </div>
                    
        </div>
    </section>
    @if($errors->any() || $isPassUsed===true || $isUpdated===true)
        <script>
              setTimeout(function() {
                      let s=document.getElementsByClassName('alert');
                      for(i=0;i<s.length;i++)
                                s[i].style.visibility="hidden";
               }, 3000);
        </script>
    @endif
@include('components.part2')