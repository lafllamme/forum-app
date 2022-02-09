{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')

<div class="d-flex flex-row justify-content-between mb-2">

    <h2 class="flex-grow-1 dark:text-white">Kategorien</h2>
    @can ('createCategories')

    <button type="button" class="bg-slate-200 hover:bg-slate-400 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-600 dark:focus:ring-red-900" data-open-modal="create-category">
        {{ trans('forum::categories.create') }}
    </button>
    @include ('forum::category.modals.create')
    @endcan

</div>

@foreach ($categories as $category)
@include ('forum::category.partials.list', ['titleClass' => 'lead'])
@endforeach
@stop