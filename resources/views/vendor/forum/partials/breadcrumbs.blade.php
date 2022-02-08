<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="glow" href="{{ url(config('forum.web.router.prefix')) }}">{{ trans('forum::general.index') }}</a></li>
        @if (isset($category) && $category)
        @include ('forum::partials.breadcrumb-categories', ['category' => $category])
        @endif
        @if (isset($thread) && $thread)
        <li class="breadcrumb-item"><a class="glow" href="{{ Forum::route('thread.show', $thread) }}">{{ $thread->title }}</a></li>
        @endif
        @if (isset($breadcrumbs_append) && count($breadcrumbs_append) > 0)
        @foreach ($breadcrumbs_append as $breadcrumb)
        <li class="breadcrumb-item">{{ $breadcrumb }}</li>
        @endforeach
        @endif
    </ol>
</nav>

<style>
    .glow {
        font-size: 1.2rem;
        font-weight: 200;
        color: black;
        text-align: center;
        -webkit-animation: glow 1s ease-in-out infinite alternate;
        -moz-animation: glow 1s ease-in-out infinite alternate;
        animation: glow 1s ease-in-out infinite alternate;
    }

    @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 1px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
        }

        to {
            text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
        }
    }
</style>