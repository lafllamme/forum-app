{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')

<div class="d-flex flex-row justify-content-between mb-2">

    <h2 class="flex-grow-1">Kategorien</h2>
    @can ('createCategories')

    <button id="switchTheme" type="button" class="py-2.5 px-2.5 mr-2  text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">🌙</button>


    <button type="button" class="btn btn-primary" data-open-modal="create-category">
        {{ trans('forum::categories.create') }}
    </button>

    @include ('forum::category.modals.create')
    @endcan
</div>

@foreach ($categories as $category)
@include ('forum::category.partials.list', ['titleClass' => 'lead'])
@endforeach
@stop