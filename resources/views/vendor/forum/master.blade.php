<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread))
        {{ $thread->title }} -
        @endif
        @if (isset($category))
        {{ $category->title }} -
        @endif
        {{ trans('forum::general.home_title') }}
    </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/alpine.js') }}"></script>



    <!-- Bootstrap (https://github.com/twbs/bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Feather icons (https://github.com/feathericons/feather) -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- Vue (https://github.com/vuejs/vue) -->
    @if (config('app.debug'))
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    @else
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    @endif

    <!-- Axios (https://github.com/axios/axios) -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Pickr (https://github.com/Simonwep/pickr) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://csshake.surge.sh/csshake.min.css">

    <!-- Sortable (https://github.com/SortableJS/Sortable) -->
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.10.1/Sortable.min.js"></script>
    <!-- Vue.Draggable (https://github.com/SortableJS/Vue.Draggable) -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.23.2/vuedraggable.umd.min.js"></script>

    <style>
        html {
            overflow-x: hidden;

        }

        body {
            padding: 0;
            background: #f8fafc;
        }

        textarea {
            min-height: 200px;
        }

        table tr td {
            white-space: nowrap;
        }

        a {
            text-decoration: none;
        }

        .deleted {
            opacity: 0.65;
        }

        #main {
            padding: 2em;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card.category {
            margin-bottom: 1em;
        }

        .list-group .list-group {
            min-height: 1em;
            margin-top: 1em;
        }

        .btn svg.feather {
            width: 16px;
            height: 16px;
            stroke-width: 3px;
            vertical-align: -2px;
        }

        .modal-title svg.feather {
            margin-right: .5em;
            vertical-align: -3px;
        }

        .category .subcategories {
            background: #fff;
        }

        .category>.list-group-item {
            z-index: 1000;
        }

        .category .subcategories .list-group-item:first-child {
            border-radius: 0;
        }

        .timestamp {
            border-bottom: 1px dotted var(--bs-gray);
            cursor: help;
        }

        .fixed-bottom-right {
            position: fixed;
            right: 0;
            bottom: 0;
        }

        .fade-enter-active,
        .fade-leave-active {
            transition: opacity .3s;
        }

        .fade-enter,
        .fade-leave-to {
            opacity: 0;
        }

        .mask {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(50, 50, 50, .2);
            opacity: 0;
            transition: opacity .2s ease;
            z-index: 1020;
        }

        .mask.show {
            opacity: 1;
        }

        .form-check {
            user-select: none;
        }

        .sortable-chosen {
            background: var(--bs-light);
        }

        @media (max-width: 575.98px) {
            #main {
                padding: 1em;
            }
        }

        #fire {
            background-color: #FFE53B;
            background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 74%);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

        }

        /* Toggle A */
        input:checked~.dot {
            transform: translateX(100%);
            background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 74%) !important;
        }
    </style>
</head>

<body class="dark:bg-gray-900">
    <!-- <nav class="v-navbar navbar navbar-expand-md shadow-lg dark:shadow-dark">
        <div class="container">
            <a id="fire" class="navbar-brand" href="{{ url(config('forum.web.router.prefix')) }}">
                Flameboard
            </a>


            <div class="collapse navbar-collapse" :class="{ show: !isCollapsed }">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="hover:text-green-500 font-medium m-2 text-gray-900 dark:hover:text-red-300 dark:text-white" href="{{ url(config('forum.web.router.prefix')) }}">{{ trans('forum::general.index') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover:text-green-500 font-medium m-2 text-gray-900 dark:hover:text-red-300 dark:text-white" href="{{ route('forum.recent') }}">{{ trans('forum::threads.recent') }}</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="hover:text-green-500 font-medium m-2 text-gray-900 dark:hover:text-red-300 dark:text-white" href="{{ route('forum.unread') }}">{{ trans('forum::threads.unread_updated') }}</a>
                    </li>
                    @endauth
                    @can ('moveCategories')
                    <li class="nav-item">
                        <a class="hover:text-green-500 font-medium m-2 text-gray-900 dark:hover:text-red-300 dark:text-white" href="{{ route('forum.category.manage') }}">{{ trans('forum::general.manage') }}</a>
                    </li>
                    <li>
                        @endcan
                </ul>
                <ul class="navbar-nav">

                    @if (Auth::check())
                    <li class="nav-item dropdown">

                        <a class="dropdown-toggle text-black hover:text-green-400 dark:text-white dark:hover:text-red-400" href="#" id="navbarDropdownMenuLink" @click="isUserDropdownCollapsed = ! isUserDropdownCollapsed">
                            {{ $username }}
                        </a>
                        <div class="dropdown-menu dark:bg-gray-900" :class="{ show: ! isUserDropdownCollapsed }" aria-labelledby="navbarDropdownMenuLink">

                            <a class="hover:text-green-500 text-black hover:text-black dark:text-white dark:hover:text-red-400 " href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav> -->
    <nav class="bg-white-800 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="bg-white-900 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white dark:bg-gray-900 dark:hover:bg-white-900" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!--
            Icon when menu is closed.

            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
          -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!--
            Icon when menu is open.

            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
          -->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class=" flex-shrink-0 flex items-center">
                        <a class="text-black dark:text-white" href="{{ url(config('forum.web.router.prefix')) }}">Flameboard</a>
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="#" class="bg-gray-900 px-3 py-2 rounded-md text-sm font-medium text-white dark:bg-white dark:text-white" aria-current="page">Dashboard</a>

                            <a href="#" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium dark:text-white">Team</a>

                            <a href="#" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium  dark:text-white">Projects</a>

                            <a href="#" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium  dark:text-white">Calendar</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>

                        <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
              From: "transform opacity-0 scale-95"
              To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
              From: "transform opacity-100 scale-100"
              To: "transform opacity-0 scale-95"
          -->
                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium dark:bg-white dark:text-white" aria-current=" page">Dashboard</a>

                <a href="#" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Team</a>

                <a href="#" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Projects</a>

                <a href="#" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Calendar</a>
            </div>
        </div>
    </nav>
    </div>

    <!-- <div class="flex justify-center mt-3">
        <div class="form-check form-switch">
            <input id="switchTheme" class="form-check-input appearance-none w-9 -ml-10 bg-white rounded-full float-left h-5 align-top bg-gray-200 bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm dark:bg-gray-900" type="checkbox" role="switch" id="flexSwitchCheckChecked">
            <label class="form-check-label inline-block text-gray-800 dark:text-white" for="flexSwitchCheckChecked">Toogle Darkmode 🌙</label>
        </div>
    </div> -->

    <div class="flex items-center justify-center w-full mt-4">
        <label for="toggleB" class="flex items-center cursor-pointer">
            <!-- toggle -->
            <div class="relative">
                <!-- input -->
                <input name="switchMode" type="checkbox" id="toggleB" class="sr-only" oninput="cacheInput(this)">
                <!-- line -->
                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                <!-- dot -->
                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
            </div>
            <!-- label -->

            <div class="shake-constant shake-little">
                <div class="ml-3 text-gray-700 font-medium dark:text-white">
                    Toggle Darkmode 🌙
                </div>
            </div>
        </label>

    </div>




    <div id="main" class="container dark:bg-gray-900">
        @include('forum::partials.breadcrumbs')
        @include('forum::partials.alerts')

        @yield('content')
    </div>

    <main class="bg-light-800 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-24 grid grid-cols-2">
            <div>
                <h1 class="py-4 text-green-500 dark:text-yellow-500 font-bold text-6xl">
                    In-demand talent on demand.TM <br /> <span class="text-black dark:bg-gray-900 dark:text-white">Upwork is how.TM</span>
                </h1>
                <p class="text-black text-2xl dark:text-white py-4">
                    Hire proven pros with confidence using the world’s largest, remote talent platform.
                </p>
            </div>
        </div>
    </main>

    <div class="mask">
    </div>

    <script>
        const toggle = document.getElementById('toggleB');

        cacheInput = (e) => {
            if (toggle.checked == true) {
                localStorage.setItem(e.attributes["name"].value, 1)
            }
            if (toggle.checked == false) {
                localStorage.setItem(e.attributes["name"].value, 0)
            }
        }


        if (localStorage.switchMode == 0) {
            // toggle.checked = 'false'
            console.log('Offline')
        }
        if (localStorage.switchMode == 1) {
            toggle.checked = 'true'
            console.log('Online')

        }



        document.getElementById('toggleB').addEventListener('click', function() {
            let htmlClasses = document.querySelector('html').classList;
            if (localStorage.theme == 'dark') {
                htmlClasses.remove('dark');
                localStorage.removeItem('theme')
            } else {
                htmlClasses.add('dark');
                localStorage.theme = 'dark';
            }
        });
        if (localStorage.theme === 'dark' || (!'theme' in localStorage && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.querySelector('html').classList.add('dark')
        } else if (localStorage.theme === 'dark') {
            document.querySelector('html').classList.add('dark')
        }

        new Vue({
            el: '.v-navbar',
            name: 'Navbar',
            data: {
                isCollapsed: true,
                isUserDropdownCollapsed: true
            },
            methods: {
                onWindowClick(event) {
                    const ignore = ['navbar-toggler', 'navbar-toggler-icon', 'dropdown-toggle'];
                    if (ignore.some(className => event.target.classList.contains(className))) return;
                    if (!this.isCollapsed) this.isCollapsed = true;
                    if (!this.isUserDropdownCollapsed) this.isUserDropdownCollapsed = true;
                }
            },
            created: function() {
                window.addEventListener('click', this.onWindowClick);
            }
        });

        const mask = document.querySelector('.mask');

        function findModal(key) {
            const modal = document.querySelector(`[data-modal=${key}]`);

            if (!modal) throw `Attempted to open modal '${key}' but no such modal found.`;

            return modal;
        }

        function openModal(modal) {
            modal.style.display = 'block';
            mask.style.display = 'block';
            setTimeout(function() {
                modal.classList.add('show');
                mask.classList.add('show');
            }, 200);
        }

        document.querySelectorAll('[data-open-modal]').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();

                openModal(findModal(event.currentTarget.dataset.openModal));
            });
        });

        document.querySelectorAll('[data-modal]').forEach(modal => {
            modal.addEventListener('click', event => {
                if (!event.target.hasAttribute('data-close-modal')) return;

                modal.classList.remove('show');
                mask.classList.remove('show');
                setTimeout(function() {
                    modal.style.display = 'none';
                    mask.style.display = 'none';
                }, 200);
            });
        });

        document.querySelectorAll('[data-dismiss]').forEach(item => {
            item.addEventListener('click', event => event.currentTarget.parentElement.style.display = 'none');
        });

        document.addEventListener('DOMContentLoaded', event => {
            const hash = window.location.hash.substr(1);
            if (hash.startsWith('modal=')) {
                openModal(findModal(hash.replace('modal=', '')));
            }

            feather.replace();

            const input = document.querySelector('input[name=color]');

            if (!input) return;

            const pickr = Pickr.create({
                el: '.pickr',
                theme: 'classic',
                default: input.value || null,

                swatches: [
                    '{{ config('
                    forum.web.default_category_color ') }}',
                    '#f44336',
                    '#e91e63',
                    '#9c27b0',
                    '#673ab7',
                    '#3f51b5',
                    '#2196f3',
                    '#03a9f4',
                    '#00bcd4',
                    '#009688',
                    '#4caf50',
                    '#8bc34a',
                    '#cddc39',
                    '#ffeb3b',
                    '#ffc107'
                ],

                components: {
                    preview: true,
                    hue: true,
                    interaction: {
                        input: true,
                        save: true
                    }
                },

                strings: {
                    save: 'Apply'
                }
            });

            pickr
                .on('save', instance => pickr.hide())
                .on('clear', instance => {
                    input.value = '';
                    input.dispatchEvent(new Event('change'));
                })
                .on('cancel', instance => {
                    const selectedColor = instance
                        .getSelectedColor()
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                })
                .on('change', (color, instance) => {
                    const selectedColor = color
                        .toHEXA()
                        .toString();

                    input.value = selectedColor;
                    input.dispatchEvent(new Event('change'));
                });
        });
    </script>
    @yield('footer')
</body>

</html>