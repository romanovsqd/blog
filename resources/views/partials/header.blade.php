<header class="navbar bg-base-200 font-medium">

    <div class="container mx-auto px-4 flex justify-between items-center">

        <div>
            <a class="btn btn-ghost text-xl">{{ __('Blog') }}</a>
        </div>

        <div class="hidden md:block">

            <ul class="menu menu-horizontal gap-2 text-base">
                <li>
                    <a href="#">{{ __('Home') }}</a>
                </li>

                <li>
                    <a href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
                </li>

                <li>
                    <a href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                </li>

                @auth
                    @if (auth()->user()->isAdmin())
                        <li>
                            <details class="dropdown">
                                <summary class="">{{ __('Admin panel') }}</summary>
                                <ul class="menu dropdown-content bg-base-100 z-1 w-max shadow-sm">
                                    <li><a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a></li>
                                    <li><a href="{{ route('admin.posts.index') }}">{{ __('Posts') }}</a></li>
                                </ul>
                            </details>
                        </li>
                    @endif
                @endauth
            </ul>

        </div>

        <div class="hidden md:block">
            <ul class="menu menu-horizontal gap-1 text-base">

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-primary">{{ __('Login') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}" class="btn btn-ghost btn-primary-content">{{ 'Register' }}</a>
                    </li>
                @endguest

                @auth
                    <li>
                        <details class="dropdown">
                            <summary class="">{{ __('Profile') }}</summary>
                            <ul class="menu dropdown-content bg-base-100 z-1 w-max shadow-sm">

                                <li><a href="{{ route('profile.edit') }}">{{ __('Edit') }}</a></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="p-0">
                                        @csrf
                                        <button type="submit" class="text-red-700 py-2 px-3 cursor-pointer">{{ __('Logout') }}</button>
                                    </form>
                                </li>

                            </ul>
                        </details>
                    </li>
                @endauth
            </ul>
        </div>

        <div class="block md:hidden">

            <details class="dropdown dropdown-end">
                <summary class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </summary>

                <ul class="menu dropdown-content bg-base-100 rounded-box z-1 w-max text-lg sm:text-base shadow-md">

                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="link link-primary no-underline">{{ __('Login') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('register') }}" class="">{{ 'Register' }}</a>
                        </li>

                        <div class="divider m-0"></div>
                    @endguest

                    <li>
                        <a href="#">{{ __('Home') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                    </li>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <div class="divider m-0"></div>
                            <li>
                                <details class="dropdown">
                                    <summary class="">{{ __('Admin panel') }}</summary>
                                    <ul>
                                        <li><a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a></li>
                                        <li><a href="{{ route('admin.posts.index') }}">{{ __('Posts') }}</a></li>
                                    </ul>
                                </details>
                            </li>
                        @endif

                        <div class="divider m-0"></div>

                        <li>
                            <details class="dropdown">

                                <summary class="">{{ __('Profile') }}</summary>

                                <ul>
                                    <li><a href="{{ route('profile.edit') }}">{{ __('Edit') }}</a></li>

                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="p-0">
                                            @csrf
                                            <button type="submit" class="text-red-700 py-2 px-3 cursor-pointer">Logout</button>
                                        </form>
                                    </li>

                                </ul>

                            </details>
                        </li>

                    @endauth
                </ul>

            </details>
        </div>
    </div>

</header>
