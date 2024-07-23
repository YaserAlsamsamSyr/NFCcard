<!DOCTYPE html>
<html lang="en">
    <head>
        <title>view employees</title>
        @include('components.part1')
        <link href="{{ asset('build/assets/css/viewEmployee.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="body-header">
                <nav class="navbar navbar-light justify-content-between shadow">
                    <form class="form-inline" action="{{ route('searchPhone') }}" method="post" >
                        @if($withPag)
                            @csrf
                            <input class="form-control mr-sm-2" type="text" name="phone" placeholder="phone number" />
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">بحث</button> 
                        @endif
                    </form>
                    @if($withPag)
                        <a class="navbar-brand" href="{{ route('home') }}">عودة</a>
                    @else
                        <a class="navbar-brand" href="/employee">عودة</a>
                    @endif
                </nav>
                @if ($errors->any())
                    <div id="alert" class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                                  {{ $error }} <br>
                        @endforeach
                    </div>
                @endif
                @if($isDeleted===true)
                    <div id="alert" class="alert alert-success" role="alert">
                        <h2>تم الحذف بنجاح</h2>
                    </div>
                @endif 
                @if($errors->updatePassword->get('current_password'))
                    <div id="alert" class="alert alert-danger" role="alert">
                        كلمة سر المدير غير صحيحة
                    </div>
                @endif
        </header>
        <section class="item-list">
            <div class="container">  
                @foreach ($employees as $emp)
                        <div class="row d-flex flex-row-reverse shadow">
                            <div class="col-sm-12 col-md-6 text-to-right">
                                <img src='{{ $emp->img }}' class="img-fluid" alt="no image"/>
                            </div>
                            <div class="col-sm-12 col-md-6 text-to-right" dir="ltr">
                                    <p>الأسم : <span>{{ $emp->firstName }}</span></p>
                                    <p>الكنية : <span>{{ $emp->lastName }}</span></p>
                                    <p><span>{{ $emp->phone }}</span>: رقم الهاتف</p>
                                    <p><span>{{ $emp->age }}</span>: العمر</p>
                                    <p>عنوان العمل : <span>{{ $emp->address }}</span></p>
                                    <p><span>{{ $emp->numUsedCard }}</span>: عدد مرات أستخدام الكرت</p>
                                    <p><span>{{ $emp->password }}</span>: كلمة السر</p>
                                    <form action="/employee/{{ $emp->id }}" method="post" class="delete-emp" >
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="img" value="{{ $emp->img }}" />
                                        <input name="current_password" type="password" class="form-control" placeholder="pasword" />
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </form>
                                    <form action="/employee/{{ $emp->id }}/edit" method="post" class="update-emp">
                                        @csrf
                                        @method('GET')
                                        <input name="current_password" type="password" class="form-control" placeholder="pasword" />       
                                        <button type="submit" class="btn btn-success">تعديل</button>                                
                                    </form>
                            </div>
                        </div>
                @endforeach
            </div>
        </section>
        @if($withPag)
            <section class="pagination">
                <div class="container pagination-container">
                        <div class="pag-list">{{ $employees->links() }}</div>
                </div>
            </section>
        @endif
        @if($errors->updatePassword->get('current_password') ||$isDeleted===true ||$errors->any())
             <script>
                   setTimeout(function() {
                           let s=document.getElementsByClassName('alert');
                           for(i=0;i<s.length;i++)
                                     s[i].style.visibility="hidden";
                    }, 3000);
             </script>
        @endif
@include('components.part2')