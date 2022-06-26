<!-- login css -->
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
    
    function search() {
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

    
    /* Full-width input fields */
    input.login[type=text], input.login[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    /* Set a style for all buttons */
    button.login {
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
    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }
    
    /* Center the image and position the close button */
    .imgcontainerlogin {
      text-align: center;
      margin: 24px 0 12px 0;
      position: relative;
    }
    
    img.avatar {
      width: 40%;
      border-radius: 50%;
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
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      padding-top: 60px;
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

    <body>
    
    <div id="id01" class="modal">
      
      <form class="modal-content animate" action="/action_page.php" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="img_avatar2.png" alt="Avatar" class="avatar">
        </div>
    
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required>
    
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
            
          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
        </div>
    
        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
      </form>
    </div>
    
    <script>
    // Get the modal
    var modal = document.getElementById('id01');
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    
<!-- /-----------------------login form------------------------ -->


<nav x-data="{ open: false }" class="bg-white border-b border-gray-100" dir="rtl">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <div class="block h-9 w-auto mx-3" >
                            <img src="{{ asset('logo.png') }}" alt="logo" width="110rem">
                        </div>
                    </a>
                </div>

                

                <!-- search -->
                <div class="flex items-center space-x-4 sm:ml-10">
                    <!-- full width searchbox with price range filter -->
                    <div class="w-full flex-1 flex items-center justify-center">
                        <div class="relative w-auto">
                            <input type="text" 
                            class="w-full bg-gray-200 text-gray-600 placeholder-gray-500 border border-gray-200 rounded-lg py-2 px-4 appearance-none leading-normal focus:outline-none focus:bg-white focus:border-gray-500" 
                            placeholder="بحث"
                            id="search"
                            value="{{ request()->input('keyword') ?? '' }}"
                            wire:model="search"
                            @keydown.enter="search"
                            
                            >
                            
                        </div>
                    </div>
                </div>
            </div>
                <!-- advanced search popup -->
                
                

                
            
            

            <div class="hidden sm:flex sm:items-center sm:ml-6" dir="rtl">
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
                                        <a href="/login" class="header__user-modal-link">تسجيل الدخول</a>
                                        <a href="/register" class="header__user-modal-link">حساب جديد</a>
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
                                        <a href="/login" class="header__user-modal-link">تسجيل الدخول</a>
                                        <a href="/register" class="header__user-modal-link">حساب جديد</a>
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
                                        <a href="/login" class="header__user-modal-link">تسجيل الدخول</a>
                                        <a href="/register" class="header__user-modal-link">حساب جديد</a>
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
            <x-jet-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                كل المنتجات
            </x-jet-nav-link>
        </div>
    {{-- </x-slot> --}}
    <!-- / Navigation Links -->
</nav>

