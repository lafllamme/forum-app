{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')



<div class="p-4 w-full bg-slate-200 text-center rounded-full border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700 ">
    <h3 class="mb-4 text-2xl font-bold dark:text-white">
        <p class="shake-slow shake-constant shake-constant--hover">Enter the chat Fam!</p>
    </h3>
    <p class="mb-2 text-base text-center text-gray-500 sm:text-lg dark:text-gray-400 dark:">
    <p class="shake-little shake-constant shake-constant--hover text-gray-900 dark:text-white">Welcome to the Board, down below you can either enter the forum or chat with someone else</p>
    </p>
    <div class="justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
        <a href="/chatify" class="w-20 sm:w-auto flex bg-slate-300 hover:bg-slate-400 focus:ring-4 dark:bg-gray-800 focus:ring-gray-300 text-white rounded-full inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">

            <div class="text-left">
                <div class="-mt-1 text-center font-sans text-black dark:text-white text-sm font-semibold">Enter Chat </div>
            </div>
        </a>
        <a href="#" class="w-20 sm:w-auto flex bg-slate-300 hover:bg-slate-400 dark:bg-gray-800 focus:ring-4 focus:ring-gray-300 text-white rounded-full inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">

            <div class="text-left">
                <div class="-mt-1 text-center font-sans text-black dark:text-white text-sm font-semibold" data-open-modal="create-category">Create Category</div>
            </div>
        </a>
    </div>
</div>


<div class="d-flex flex-row justify-content-between mt-4">

    <h2 class="flex-grow-1 dark:text-white">Kategorien</h2>
    @can ('createCategories')


    <!-- <button type="button" class="bg-slate-200 hover:bg-slate-400 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-600 dark:focus:ring-red-900" data-open-modal="create-category">
        {{ trans('forum::categories.create') }}
    </button> -->
    @include ('forum::category.modals.create')
    @endcan

</div>

@foreach ($categories as $category)
@include ('forum::category.partials.list', ['titleClass' => 'lead'])
@endforeach
@stop