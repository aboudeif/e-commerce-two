<!-- login css -->
<style>
    *{
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
        margin:1rem auto;
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
    async function getFavourites() {
        $.ajax({
            type: 'GET',
            url: "{{ route('favourites.api') }}",
            data: {
                '_token': '{{ csrf_token() }}',
            },
            success: function(data) {
                console.log(data);
                alert('Product added to favourites');
            },
            error: function(data) {
                console.log(data);
                alert('Product already added to favourites');
            }
        });
        
       getFavourites();
    }
</script>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="<< route('dashboard') >>" :active="request()->routeIs('dashboard')">
                         
                    </x-jet-nav-link>
                </div> -->
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">


                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                @auth
                <!-- Favourites -->
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <span class="material-symbols-outlined">favorite</span>
                    </x-slot>
                  
                        <!-- Favuorites menu -->
                        <x-slot name="content">
                            <!-- Favuorites Preview -->
                            <!-- foreach ($products as $product) -->
                            <x-jet-dropdown-link href="{{ route('favourites.index') }}">
                                {{-- ajax function to get favourite data --}}
                                @if(isset($favourites))
                                    @foreach($favourites as $favourite)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                                        <b class="font-bold text-xl mb-2 text-right px-3">
                                            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                        </b>
                                        <span class="text-gray-700 text-right px-3">
                                            {{ $product->price }} EGP
                                        </span>
                                    @endforeach
                                @endif         
                               
                            
                            </x-jet-dropdown-link>
                            <!-- endforeach -->
                        </x-slot>
                
                </x-jet-dropdown>

                                <!--  -->
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">

                       
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('تسجيل الخروج') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    
                    </x-jet-dropdown>
                @else
                     <!-- Favourites -->
                     <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <span class="material-symbols-outlined">favorite</span>
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
                            
                            <a href="/login" class="header__user-modal-link">تسجيل الدخول</a>
                            
                            
                            <a href="/register" class="header__user-modal-link">حساب جديد</a>
                            
                            </div>
                        </div>
                        
                    </x-slot>
                    </x-jet-dropdown>
                    <!-- login -->
                    <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <span class="material-symbols-outlined">person</span>
                    </x-slot>
                    <x-slot name="content">
                        <!-- login menu -->
                        <div class="header__user-modal" dir="rtl">
                            <div class="header__user-modal-title">
                                
                                مرحباً 👋
                                
                            </div>
                            <div class="header__user-modal-desc">
                            
                                سجل الدخول أو أنشئ حسابك للإستمتاع بعروض صنعت لك خصيصاً
                            
                            </div>
                            
                            <a href="/login" class="header__user-modal-link">تسجيل الدخول</a>
                            
                            
                            <a href="/register" class="header__user-modal-link">حساب جديد</a>
                            
                            </div>
                        </div>
                        
                    </x-slot>
                    </x-jet-dropdown>
                @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- <x-jet-responsive-nav-link href="<< route('dashboard') >>" :active="request()->routeIs('dashboard')">
                << __('Dashboard') >>
            </x-jet-responsive-nav-link> -->
        </div>

        
        <div class="pt-4 pb-1 border-t border-gray-200">
        @auth
            <div class="flex items-center px-4">
            
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
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
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
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
        </div>
        @endauth
    </div>
</nav>