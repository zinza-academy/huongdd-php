<nav x-data="{ open: false }" class="bg-gradient-to-br from-red-600 to-purple-500 text-white">

    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-1">
        <div class="flex justify-between h-16 px-6">
            <div class="flex justify-between" style="width:100%">
                @php
                    $user = Auth::user()
                @endphp
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if ($user->is_admin || $user->role)
                        <x-nav-link :href="route('user.index')" :active="request()->is('user/*', 'user')">
                            {{ __('User') }}
                        </x-nav-link>
                        <x-nav-link :href="route('company.index')" :active="request()->is('company/*', 'company')">
                            {{ __('Company') }}
                        </x-nav-link>
                        <x-nav-link :href="route('topic.index')" :active="request()->is('topic/*', 'topic')">
                            {{ __('Topic') }}
                        </x-nav-link>
                    @endif
                    <x-nav-link :href="route('post.index')" :active="request()->is('post/*', 'post')">
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>
                <div class="flex items-center">
                    <form action="POST" class="" action="/">
                        <x-text-input class="text-black" placeholder="Search...">

                        </x-text-input>
                    </form>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center pl-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center border border-transparent transition ease-in-out duration-150">
                            <div class="ms-1">
                                @php
                                    $currentUser = Auth::user();
                                @endphp
                                @if ($currentUser->avatar)
                                    <img src="{{url('storage/' . Auth::user()->avatar)}}" alt="avatar" class="w-10 h-10 rounded-full">
                                @else
                                    <img src="{{url('/storage/img/placeholder.png')}}" alt="avatar" class="w-10 h-10 rounded-full">
                                @endif
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                <div class="pl-1">
                    {{Auth::user()->points ?? 0}}
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
