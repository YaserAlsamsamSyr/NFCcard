<!DOCTYPE html>
<html lang="en">
<head>
    <title>home</title>
    @include('components.part1')
    <link href="{{ asset('build/assets/css/home.css') }}" rel="stylesheet">
</head>
<body >
<br><br><br>
    <section class='lst-btutton'>
        <div class="container form-btns">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2 shadow">
                    <h1>{{ Auth::user()->araName }}</h1>
                    <h1>{{ Auth::user()->engName }}</h1>
                    <br><br>
                    <div class="container all-button-in-lst-button">
                    <a href="/employee"><button class="btn btn-outline-info">عرض الموظفين</button></a><br>
                    <a href="/employee/create"><button class="btn btn-outline-success">أضافة موظف</button></a><br>
                    <a href="{{  route('profile.edit') }}"><button class="btn profile-btn">ملف الشخصي</button></a><br>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary" >تسجيل الخروج</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <div class="container">
    @auth


    @endauth
    </div>
@include('components.part2')