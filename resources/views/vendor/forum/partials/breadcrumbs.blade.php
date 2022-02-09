<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-black dark:text-white" href="{{ url(config('forum.web.router.prefix')) }}">{{ trans('forum::general.index') }}</a></li>
        @if (isset($category) && $category)
        @include ('forum::partials.breadcrumb-categories', ['category' => $category])
        @endif
        @if (isset($thread) && $thread)
        <li class="breadcrumb-item"><a class="" href="{{ Forum::route('thread.show', $thread) }}">{{ $thread->title }}</a></li>
        @endif
        @if (isset($breadcrumbs_append) && count($breadcrumbs_append) > 0)
        @foreach ($breadcrumbs_append as $breadcrumb)
        <li class="breadcrumb-item">{{ $breadcrumb }}</li>
        @endforeach
        @endif

    </ol>

</nav>

<style>
</style>