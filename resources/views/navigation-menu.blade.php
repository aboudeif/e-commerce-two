<!-- login css -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    * {
        font-family: 'Tajawal', sans-serif;
    }

    .header__user-modal {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        width: fit-content;
        z-index: 9999;
    }

    .header__user-modal-title {
        font-weight: bold;
        margin-top: 1rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .header__user-modal-desc {
        text-align: center;
    }

    .header__user-modal-link {
        color: #fff;
        padding: 0.25rem 1rem;
        border-radius: 5px;
        margin: 1rem auto;
        text-align: center;
        width: max-content;
        margin-left: auto;
        display: block;
    }

    .header__user-modal-link:nth-of-type(1) {
        background: #00bcd4;
    }

    .header__user-modal-link:nth-of-type(2) {
        background: #ff9800;
    }

    .header__user-modal-link:hover {
        opacity: 0.8;
    }
</style>

<script>
    // show filter form
    function open_filter(){
       filter_form = document.getElementById("filter-form");
       if(filter_form.style.display == "none")
           filter_form.style.display = "block";
        else
              filter_form.style.display = "none";
    }

    function filter() {
        const value = $('#search').val();
        if (value == '') {
            // remove keyword from request then go to search page with request
            var request = window.location.href;
            if (request.indexOf('keyword') > -1) {
                request = request.substring(0, request.indexOf('keyword') - 1);
            }
            window.location.href = request;
            
        } else {
            // add keyword = value to the request then redirect to search page with full request
            var request = window.location.href;
            var keyword = 'keyword=' + value;
            var sign = '?';
            if (request.indexOf('?') > -1) {
                sign = '&';
            }
            var newRequest = request.indexOf('keyword') > -1 ? request.replace(/keyword=[^&]*/, keyword) : request + sign + keyword;
            window.location.href = newRequest;
        }
        }

</script>

<!-- -----------------------login form------------------------ -->
<style>
    nav
    {
        border-radius: 10px;
        z-index: 9999;
        position: sticky;
        top: 0;

        width: 100%;
    }
    .login-form {
        width: 70%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }


    
    /* Full-width input fields */
    input.login[type=text], input.login[type=password] {
      position: absolute;
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    /* Set a style for all buttons */
    button.login {
      position: absolute;
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    
    button.login:hover {
      opacity: 0.8;
    }
    
    /* Extra styles for the cancel button */
    .cancelbtnlogin {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }
    
    
    .containerlogin {
      padding: 16px;
    }
    
    span.psw {
      float: right;
      padding-top: 16px;
    }
    
    /* The Modal (background) */
    .modallogin {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top:  calc(100vh - var(--nav-height));
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: #fff; /* Fallback color */
      background-color: rgba(255,255,255,0.8); /* Black w/ opacity */
      padding-top: 60px;
    }
    
    :root
    {
        --nav-height: 590px;
    }
    </style>
    <script>
        document.getElementById("navbar").offsetHeight
        document.documentElement.style.setProperty('--nav-height', document.getElementById("navbar").offsetHeight + 'px');
    </script>
    <style>
    .modalfilter {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 999; /* Sit on top */
      left: 15%;
      /* form top is  after navbar in all screens */
      top:  calc(100vh - var(--nav-height));
      width: 70%; /* Full width */
      height: max-content; /* Full height */
      align-content: center;
      overflow: auto; /* Enable scroll if needed */
      background-color: #fff; /* Fallback color */
      background-color: rgba(255,255,255,0.8); /* Black w/ opacity */
      padding: 20px;
    }
    
    /* Modal Content/Box */
    .modal-contentlogin {
      background-color: #fefefe;
      margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }
    
    /* The Close Button (x) */
    .closelogin {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }
    
    .closelogin:hover,
    .closelogin:focus {
      color: red;
      cursor: pointer;
    }
    
    /* Add Zoom Animation */
    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }
    
    @-webkit-keyframes animatezoom {
      from {-webkit-transform: scale(0)} 
      to {-webkit-transform: scale(1)}
    }
      
    @keyframes animatezoom {
      from {transform: scale(0)} 
      to {transform: scale(1)}
    }
    
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
    </style>
    
<!-- -----------------------login form------------------------ -->
<div id="id01" class="modallogin login-form" dir="rtl">
    <x-guest-layout>
        {{-- <x-jet-authentication-card> --}}
            
            <div class="mx-3 my-3">
                {{ __('تسجيل الدخول') }}
            </div>
            <x-jet-validation-errors class="mb-4" id="loginerror" />
       
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
    
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                <div>
                    <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('كلمة المرور') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>
    
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('تذكر معلومات الدخول') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('الدخول') }}
                </x-jet-button>

                <x-jet-button class="ml-4"  onclick="document.getElementById('id01').style.display='none';window.localStorage.setItem('form','');">
                    {{ __('إغلاق') }}
                </x-jet-button>

                
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('هل نسيت كلمة المرور؟') }}
                        </a>
                    @endif

                </div>
            </form>
         {{-- </x-jet-authentication-card> --}}
    </x-guest-layout>
    
</div>
<script>

    const login_form = document.getElementById('id01');
    const logintext = document.getElementById('loginerror').innerHTML;
    //alert(document.getElementById('loginerror').innerHTML);
    // if there a div has the word "Whoops" in the login_form, then show the login_form
    // if session('_status_') == 'login', then show the login_form
    
    if (logintext && window.localStorage.getItem('form') == "login") {
        login_form.style.display = "block";
    }
    
</script>
    
<!-- /-----------------------login form------------------------ -->
<!-- -----------------------register form------------------------ -->
<div id="id02" class="modallogin login-form" dir="rtl">
<x-guest-layout>
    {{-- <x-jet-authentication-card> --}}
        
        <div class="mx-3 my-3">
            {{ __('إنشاء حساب جديد') }}
        </div>

        <x-jet-validation-errors class="mb-4" id="regerror" />
        
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('الاسم') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('البريد الإلكتروني') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('كلمة المرور') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('تأكيد كلمة المرور') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('أوافق علي :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('الشروط والأحكام').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('سياسة الخصوصية').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
            <x-jet-button class="ml-4">
                {{ __('التسجيل') }}
            </x-jet-button>

            <x-jet-button class="ml-4"  onclick="document.getElementById('id02').style.display='none';window.localStorage.setItem('form','');">
                {{ __('إغلاق') }}
            </x-jet-button>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" onclick="document.getElementById('id02').style.display='none';document.getElementById('id01').style.display='block';">
                    {{ __('لديك حساب بالفعل؟') }}
                </a>

            </div>
        </form>
    {{-- </x-jet-authentication-card> --}}
</x-guest-layout>
    
</div>
<script>
    // Get the modal
    let reg_form = document.getElementById('id02');
    let regtext = document.getElementById('regerror').innerHTML;
    
    // if there a div has the word "Whoops!" in the modal, then show the modal
    if (regtext && window.localStorage.getItem('form') == "reg") {
        reg_form.style.display = "block";
    }
    </script>
    <!-- /-----------------------register form------------------------ -->
<!-- -----------------------filter form------------------------ -->
<div id="filter-form" class="modalfilter filter-form" dir="rtl">
    <x-guest-layout>
            
            <form method="GET" action="" class="text-right flex flex-wrap" id="filter">
                
                <div class="flex shrink-0 mr-3 my-2">
                    <x-jet-label for="to" value="{{ __('الحد الأقصي للسعر') }}"  class="inline mx-2 my-2"/>
                    <x-jet-dropdown class="mx-1 inline">
                        <x-slot name="trigger">
                            <x-jet-button form="" class=" ml-2 " wire:model="choose_color" @click.enter="choose_color">
                                {{-- <x-jet-input type="text" id="color" name="color" form="filter" class="inline" disabled /> --}}
                                <span class="material-symbols-outlined">
                                    payments
                                    </span>
                            </x-jet-button>
                        </x-slot>
                        <x-slot name="content">
                            @foreach (App\Models\Product::orderBy('price','DESC')->get()->unique('price') as $price)
                                <x-jet-dropdown-link class="cursor-pointer"
                                onclick="document.getElementById('to').value ='{{ __($price->price) }}';">
                                    <span class="mx-1 inline-block"> 
                                    {{ __($price->price) }} ج.م
                                    </span>
                                </x-jet-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                    <x-jet-input id="to" name="to" form="filter" type="number" min="100.00" max="9999.99" step="0.01" class="inline mx-1" autofocus />
                </div>
                
                <div class="flex shrink-0 mr-3 my-2">
                    <x-jet-label for="from" value="{{ __('الحد الأدني للسعر') }}" class="inline mx-2 my-2" />
                    <x-jet-dropdown class="mx-1 inline">
                        <x-slot name="trigger">
                            <x-jet-button form="" class=" mx-2 " wire:model="choose_color" @click.enter="choose_color">
                                {{-- <x-jet-input type="text" id="color" name="color" form="filter" class="inline" disabled /> --}}
                                <span class="material-symbols-outlined">
                                    payments
                                    </span>
                            </x-jet-button>
                        </x-slot>
                        <x-slot name="content">
                            @foreach (App\Models\Product::orderBy('price','ASC')->get()->unique('price') as $price)
                                <x-jet-dropdown-link class="cursor-pointer"
                                onclick="document.getElementById('from').value ='{{ __($price->price) }}';">
                                    <span class="mx-1 inline-block"> 
                                    {{ __($price->price) }} ج.م
                                    </span>
                                </x-jet-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                    <x-jet-input id="from" name="from" form="filter" type="number" min="0.00" max="9999.99" step="0.01" class="inline mx-1" autofocus />
                </div>
                
                
                <div class="flex shrink-0 mr-3 my-2">
                  
                        <div class="inline-block mt-2">
                            {{ __('اللون') }}
                        </div>
                        <x-jet-dropdown class="mx-1 inline">
                            <x-slot name="trigger">
                                <x-jet-button form="" class=" mx-2 " wire:model="choose_color" @click.enter="choose_color">
                                    {{-- <x-jet-input type="text" id="color" name="color" form="filter" class="inline" disabled /> --}}
                                    <span class="material-symbols-outlined">
                                        gradient
                                        </span>
                                </x-jet-button>
                            </x-slot>
                            <x-slot name="content">
                                @foreach (App\Models\Product_variance::all()->unique('color','color_code') as $color)
                                    <x-jet-dropdown-link class="cursor-pointer" 
                                    onclick="document.getElementById('color').value ='{{ __($color->color) }}';">
                                        <span style="width: 1rem;height:1rem;background-color:{{ $color->color_code }};margin-left:1rem;display:inline-block;"></span>
                                        <span class="mx-1 inline-block"> {{ __($color->color) }} </span>
                                    </x-jet-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-input id="color" name="color" form="filter" type="text" class="inline mx-1" autofocus />
                  
                </div>
                    {{-- color preview --}}
                    <div class="flex shrink-0 mr-3 my-2">
                 
                        <div class="inline-block mt-2">
                            {{ __('المقاس') }}
                        </div>
                        <x-jet-dropdown class="inline">
                            <x-slot name="trigger">
                                <x-jet-button form="" class="mx-2" wire:model="choose_size" @click.enter="choose_size">
                                    {{-- <x-jet-input type="text" id="size" name="size" form="filter" class="inline" disabled /> --}}
                                    <span class="material-symbols-outlined">
                                        straighten
                                        </span>
                                </x-jet-button>
                            </x-slot>
                            <x-slot name="content">
                                @foreach (App\Models\Product_variance::all()->unique('size') as $size)
                                    <x-jet-dropdown-link class="cursor-pointer"
                                    onclick="document.getElementById('size').value ='{{ __($size->size) }}';">
                                        <span class="mx-1 inline-block"> {{ __($size->size) }} </span>
                                    </x-jet-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-input id="size" name="size" form="filter" type="text" class="inline mx-1" autofocus />
                    </div>
                    

                    {{-- sort by create date --}}
                    <div class="flex shrink-0 mr-3 my-2">
                 
                        <div class="inline-block mt-2">
                     
                        {{ __('الترتيب') }}
                        </div>
                        <x-jet-dropdown class="inline">
                            <x-slot name="trigger">
                                <x-jet-button form="" class="mx-2" wire:model="choose_sort" @click.enter="choose_sort">
                                    {{-- <x-jet-input type="text" id="sort_by" name="sort_by" form="filter" class="inline" disabled /> --}}
                                    <span class="material-symbols-outlined">
                                        sort
                                        </span>
                                </x-jet-button>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link class="cursor-pointer"
                                onclick="document.getElementById('order').value ='{{ __('ASC') }}';">
                                    <span class="mx-1 inline-block"> {{ __('الأحدث إلى الأقدم') }} </span>
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link class="cursor-pointer"
                                onclick="document.getElementById('order').value ='{{ __('DESC') }}';">
                                    <span class="mx-1 inline-block"> {{ __('الأقدم إلى الأحدث') }} </span>
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        
                        <x-jet-input id="order" name="order" form="filter" type="text" class="inline mx-1" autofocus />
                    {{-- sort by create date --}}
                </div>
        
                
                <div class="flex shrink-0 mx-3 my-3 left">
                <x-jet-button class="ml-4">
                    {{ __('فلترة المنتجات') }}
                </x-jet-button>

                <x-jet-button class="ml-4"  onclick="document.getElementById('id01').style.display='none';window.localStorage.setItem('form','');">
                    {{ __('إغلاق') }}
                </x-jet-button>
                </div>

        

                </div>
            </form>
         {{-- </x-jet-authentication-card> --}}
    </x-guest-layout>
</div>
<script>

    const login_form = document.getElementById('id01');
    const logintext = document.getElementById('loginerror').innerHTML;
    //alert(document.getElementById('loginerror').innerHTML);
    // if there a div has the word "Whoops" in the login_form, then show the login_form
    // if session('_status_') == 'login', then show the login_form
    
    if (logintext && window.localStorage.getItem('form') == "login") {
        login_form.style.display = "block";
    }
    
</script>
    
<!-- /-----------------------filter form------------------------ -->

<nav id="navbar" x-data="{ open: false }" class="bg-white border-b border-gray-100" dir="rtl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto my-4 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
           
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <div class="block h-9 w-auto mx-3" >
                            <img src="{{ asset('logo.png') }}" alt="logo" width="110rem">
                        </div>
                    </a>
                </div>

                

                <!-- search -->
               
                    <!-- full width searchbox with price range filter -->
                    <div class="w-full flex-1 flex items-center">
 
                            <input type="text" 
                            class="w-full bg-white-200 text-gray-600 placeholder-gray-500 border border-gray-200 rounded-lg py-2 px-4 appearance-none leading-normal focus:outline-none focus:bg-white focus:border-gray-500" 
                            placeholder="بحث"
                            id="search"
                            value="{{ request()->input('keyword') ?? '' }}"
                            wire:model="search"
                            @keydown.enter="search"
                            
                            >
                    </div>
                    {{-- serach button --}}
                    <button class="material-symbols-outlined btn"
                     style="color: darkblue;height:max-content;padding:4px;text-align:center;margin:5px;margin-top:15px;border-radius:5px;opacity:0.7;"
                     wire:model="search"
                    @click.enter="search"

                    >
                        {{ __('search') }}
                    </button>
                    {{-- filter button --}}
                    <button class="material-symbols-outlined btn"
                    style="color: darkblue;height:max-content;padding:4px;text-align:center;margin:5px;margin-top:15px;border-radius:5px;opacity:0.7;"
                    wire:model="open_filter"
                    @click.enter="open_filter"

                    >
                        {{ __('filter_list') }}
                   </button>
               
            
                <!-- advanced search popup -->
                
              
        {{-- <div class=" flex items-center md:ml-0 bg-green-100 mx-3 height-max rounded-md"> --}}
                        
                

            <div class="hidden sm:flex sm:items-center sm:ml-6 mx-3" dir="rtl">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative flex right">

                    <!-- login -->
                    <x-jet-dropdown align="right" width="48">
                        @auth
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <x-jet-dropdown-link href="{{ route('home') }}">
                                    {{ __('العمليات') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('حسابي') }}
                                </x-jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('تسجيل الخروج') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        @else
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <span class="material-symbols-outlined">person</span>
                                </button>
                            </x-slot>
                            <!-- login menu -->
                            <x-slot name="content">
                                <div class="header__user-modal" dir="rtl">
                                    <div class="header__user-modal-title">
                                        مرحباً 👋
                                    </div>
                                    <div class="header__user-modal-desc">
                                        سجل الدخول أو أنشئ حسابك للإستمتاع بعروض صنعت لك خصيصاً
                                    </div>
                                    <div>
                                        <a onclick="document.getElementById('id01').style.display='block';window.localStorage.setItem('form','login');" class="header__user-modal-link cursor-pointer">تسجيل الدخول</a>
                                        <a onclick="document.getElementById('id02').style.display='block';window.localStorage.setItem('form','reg');" class="header__user-modal-link cursor-pointer">حساب جديد</a>
                                    </div>
                                </div>
                            </x-slot>
                        @endauth
                    </x-jet-dropdown>

                    <!-- Favourites -->

                    <x-jet-dropdown align="right" href="{{ route('favourites.index') }}" :active="request()->routeIs('favourites.index')"
                        width="48">
                        @auth
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:opacity-0.8 transition">
                                    <div class="material-symbols-outlined">favorite</div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('favourites.index') }}">
                                    {{ __('المفضلة') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        @else
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <span class="material-symbols-outlined">favorite</span>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <!-- Favuorites menu -->
                                <div class="header__user-modal" dir="rtl">
                                    <div class="header__user-modal-title">
                                        المفضلة ❤️
                                    </div>
                                    <div class="header__user-modal-desc">
                                        إستخدم قائمة المنتجات المفضلة لتتبع منتجاتك
                                    </div>
                                    <div>
                                        <a onclick="document.getElementById('id01').style.display='block';window.localStorage.setItem('form','login');" class="header__user-modal-link cursor-pointer">تسجيل الدخول</a>
                                        <a onclick="document.getElementById('id02').style.display='block';window.localStorage.setItem('form','reg');" class="header__user-modal-link cursor-pointer">حساب جديد</a>
                                    </div>
                                </div>
                            </x-slot>
                        @endauth
                    </x-jet-dropdown>

                    <!-- cart -->
                    <x-jet-dropdown align="right" width="48">
                        @auth
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:opacity-0.8 transition">
                                    <div class="material-symbols-outlined">shopping_cart</div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('cart.index') }}">
                                    {{ __('سلة الشراء') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        @else
                            <x-slot name="trigger">
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                </button>
                            </x-slot>

                            <!-- Cart menu -->
                            <x-slot name="content">
                                <div class="header__user-modal" dir="rtl">
                                    <div class="header__user-modal-title">
                                        سلة المشتريات 🛒
                                    </div>
                                    <div class="header__user-modal-desc">
                                        أضف المنتجات إلي سلة المشتريات وأحصل علي خصومات فورية
                                    </div>
                                    <div>
                                        <a onclick="document.getElementById('id01').style.display='block';window.localStorage.setItem('form','login');" class="header__user-modal-link cursor-pointer">تسجيل الدخول</a>
                                        <a onclick="document.getElementById('id02').style.display='block';window.localStorage.setItem('form','reg');" class="header__user-modal-link cursor-pointer">حساب جديد</a>
                                    </div>
                                </div>
                            </x-slot>
                        @endauth
                    </x-jet-dropdown>



                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                     <x-jet-responsive-nav-link href="{{ route('welcome') }}" :active="request() -> routeIs('welcome')">
                         __('welcome') 
                    </x-jet-responsive-nav-link>
                </div>


                <div class="pt-4 pb-1 border-t border-gray-200">
                    @auth
                        <div class="flex items-center px-4">

                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </div>
                            @endif

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>

                            <div class="mt-3 space-y-1">
                                <!-- Account Management -->
                                <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                                    {{ __('العمليات') }}
                                </x-jet-responsive-nav-link>

                                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('حسابي') }}
                                </x-jet-responsive-nav-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        {{ __('API Tokens') }}
                                    </x-jet-responsive-nav-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('تسجيل الخروج') }}
                                    </x-jet-responsive-nav-link>
                                </form>

                                <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="border-t border-gray-200"></div>

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-responsive-nav-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                        {{ __('Team Settings') }}
                                    </x-jet-responsive-nav-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                            {{ __('Create New Team') }}
                                        </x-jet-responsive-nav-link>
                                    @endcan

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                    @endforeach
                                @endif
                        @else
                                <div class="flex items-center px-4">
                                    <div class="mt-3 space-y-1">
                                        <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                                            {{ __('Login') }}
                                        </x-jet-responsive-nav-link>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <x-slot name="header"> --}}
        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex my-2 mx-5">
            <x-jet-nav-link href="{{ route('welcome') }}" class="mx-3" :active="request()->routeIs('welcome')">
                كل المنتجات
            </x-jet-nav-link>
           
            @foreach (App\Models\Category::all() as $category)
                <x-jet-dropdown class="mx-3" align="right" width="48">
                    <x-slot name="trigger">
                        <x-jet-nav-link class="mx-1 cursor-pointer">
                        {{ $category->name }}
                        </x-jet-nav-link>
                    </x-slot>
                    <x-slot name="content">
                        @foreach (App\Models\Subcategory::where('category_id',$category->id)->get() as $subcategory)
                            <x-jet-dropdown-link href="?category={{ $category->id }}&subcategory={{ $subcategory->name }}">
                                {{ $subcategory->name }}
                            </x-jet-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-jet-dropdown>
            @endforeach

        </div>
</nav>

