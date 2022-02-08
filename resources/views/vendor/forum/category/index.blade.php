{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')

<div class="d-flex flex-row justify-content-between mb-2">

    <h2 class="flex-grow-1 dark:text-white">Kategorien</h2>
    @can ('createCategories')

    <div class="shake-chunk shake-constant"> <button id="switchTheme" type="button" class="py-2.5 px-2.5 mr-2">🌙</button>
    </div>


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