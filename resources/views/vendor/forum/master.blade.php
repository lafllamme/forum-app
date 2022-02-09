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

    <link rel="stylesheet" href="/css/app.css">

    <script defer src="/js/alpine.js"></script>
    <script defer src="/js/app.js"></script>






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
            background-clip: text;
            -webkit-text-fill-color: transparent;

        }

        /* Toggle A */
        input:checked~.dot {
            transform: translateX(100%);
            background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 74%) !important;
        }

        .hideElement {
            display: none;
        }
    </style>
</head>

<body class="bg-white-900 dark:bg-gray-900">
    <nav class="bg-slate-200 dark:bg-gray-800">
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
                            <a href="{{ url(config('forum.web.router.prefix')) }}" class="text-slate-50 dark:text-gray-800 bg-gray-900 dark:bg-white px-3 py-2 rounded-md text-sm font-medium " aria-current="page">Index</a>
                            <a href="{{ route('forum.recent') }}" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium dark:text-white">Recent</a>

                            <a href="{{ route('forum.unread') }}" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium  dark:text-white">Unread</a>

                            <a href="{{ route('forum.category.manage') }}" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium  dark:text-white">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button" class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6 text-white dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button onclick="showMenu(); this.onclick=null;" type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 focus:ring-offset-gray-800 dark:focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <svg version="1.0" class="dark:bg-white rounded-full" xmlns="http://www.w3.org/2000/svg" width="25pt" height="25pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="bg-white dark:bg-gray-800" stroke="none">
                                        <path d="M2370 4305 c-254 -48 -450 -153 -621 -332 -156 -163 -252 -353 -294
                                    -578 -23 -122 -16 -357 13 -467 63 -232 187 -433 357 -578 43 -36 82 -69 89
                                    -73 8 -6 7 -10 -4 -14 -35 -14 -160 -83 -226 -125 -411 -264 -695 -747 -721
                                    -1225 l-6 -113 165 0 165 0 6 103 c7 123 42 264 96 391 159 373 470 638 869
                                    743 132 34 371 43 512 19 491 -86 879 -434 1016 -911 23 -78 44 -205 44 -262
                                    0 -87 -9 -83 173 -83 l160 0 -6 113 c-17 334 -154 667 -386 934 -128 147 -289
                                    274 -473 373 l-97 51 74 60 c172 136 313 358 377 591 20 73 23 106 23 273 0
                                    176 -2 197 -28 290 -31 113 -95 253 -158 347 -127 188 -347 355 -569 431 -158
                                    54 -394 72 -550 42z m360 -330 c276 -63 501 -266 584 -527 141 -443 -109 -900
                                    -559 -1019 -111 -29 -279 -29 -389 0 -357 95 -596 400 -596 764 0 130 22 232
                                    74 342 103 218 316 391 541 438 92 20 263 21 345 2z" />
                                    </g>
                                </svg>
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
                        <div id="toggleMenu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hideElement" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                            @if (Auth::check())
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="bg-white dark:bg-gray-800 block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0"> {{ $username }}
                            </a>
                            <a href="#" class="bg-white dark:bg-gray-800 block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                            <a onclick="document.getElementById('logout-form').submit()" class="bg-white dark:bg-gray-900 block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else

                            <a href="{{ url('/login') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Login</a>
                            <a href="{{ url('/register') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Register</a>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="{{ url(config('forum.web.router.prefix')) }}" class="text-slate-50 dark:text-gray-800 bg-gray-900 block px-3 py-2 rounded-md text-base font-medium dark:bg-white" aria-current=" page">Index</a>

                <a href="{{ route('forum.recent') }}" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Recent</a>

                <a href="{{ route('forum.unread') }}" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Unread</a>

                <a href="{{ route('forum.category.manage') }}" class="text-black hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium  dark:text-white">Manage</a>
            </div>
        </div>
    </nav>
    </div>

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

        function cacheInput(e) {
            if (toggle.checked == true) {
                localStorage.setItem(e.attributes["name"].value, 1)
            }
            if (toggle.checked == false) {
                localStorage.setItem(e.attributes["name"].value, 0)
            }
        }

        const userButton = document.getElementById('user-menu-button');

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
        if (localStorage.switchMode == 0) {
            // toggle.checked = 'false'
            console.log('Offline')
        }
        if (localStorage.switchMode == 1) {
            toggle.checked = 'true'
            console.log('Online')

        }

        function showMenu() {
            const toggleMenu = document.getElementById('toggleMenu');
            console.log(toggleMenu)
            if (toggleMenu.classList.contains('hideElement')) {
                toggleMenu.classList.remove('hideElement');
            } else {
                toggleMenu.classList.add('hideElement');

            }
            userButton.addEventListener('click', showMenu)






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
                        "{{ config('forum.web.default_category_color ') }}",
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
        }
    </script>
    @yield('footer')
</body>

</html>