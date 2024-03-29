<div class=" category list-group my-4">
    <div class="bg-slate-200 list-group-item dark:bg-gray-800 shadow-sm dark:bg-gray-800">
        <div class="row align-items-center text-center">
            <div class="col-sm text-md-start">
                <h5 class="card-title">
                    <a href="{{ Forum::route('category.show', $category) }}" id="category" class="font-bold text-gray-900 dark:text-white" style="color: {{ $category->color }};">{{ $category->title }}</a>
                </h5>
                <p class="font-semibold text-black dark:text-white">{{ $category->description }}</p>
            </div>
            <div class="col-sm-2 text-md-end">
                @if ($category->accepts_threads)
                <span class="badge rounded-pill" style="background: {{ $category->color }};">
                    <div class="text-black dark:text-white "> {{ trans_choice('forum::threads.thread', 2) }}: {{ $category->thread_count }}
                    </div>
                </span>
                <span class="relative inline-block mt-1">
                    <svg class="w-6 h-6 text-gray-700 dark:text-white fill-current mt-2 " viewBox="0 0 20 20">
                        <path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                    <span style="background: {{ $category->color }}" class="text-black dark:text-white absolute top-2 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none transform translate-x-1/2 -translate-y-1/2 rounded-full">{{ $category->post_count }}</span>
                </span>
                <br>
                <!-- <span style="background: {{ $category->color }};" class="text-black dark:text-white inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none  rounded-full">Posts</span> -->

                @endif
            </div>
            <div class="col-sm text-md-end text-black dark:text-white">
                @if ($category->accepts_threads)
                @if ($category->newestThread)
                <div class="m-2">
                    <a style="color: {{ $category->color }};" class="font-semibold underline underline-offset-1" href=" {{ Forum::route('thread.show', $category->newestThread) }}">{{ $category->newestThread->title }}</a>
                    @include ('forum::partials.timestamp', ['carbon' => $category->newestThread->created_at])
                </div>


                @endif
                @if ($category->latestActiveThread && $category->latestActiveThread->post_count > 1)
                <div class="m-2">
                    <a style="color: {{ $category->color }};" class="font-semibold underline underline-offset-1" href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">Re: {{ $category->latestActiveThread->title }}</a>
                    @include ('forum::partials.timestamp', ['carbon' => $category->latestActiveThread->lastPost->created_at])
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    </di>

    <div class="mt-1">
        @if ($category->children->count() > 0)
        <div class="subcategories ml-4 mr-4 mt-2">
            @foreach ($category->children as $subcategory)
            <div class="dark:bg-gray-800 list-group-item mt-2">
                <div class="row align-items-center text-center">
                    <div class="col-sm text-md-start">
                        <a href="{{ Forum::route('category.show', $subcategory) }}" style="color: {{ $subcategory->color }};" class="font-medium">{{ $subcategory->title }}</a>
                        <div class="font-medium italic subpixel-antialiased text-sm text-black dark:text-white">{{ $subcategory->description }}</div>
                    </div>
                    <div class="col-sm-2 text-md-end text-black dark:text-white">
                        <span class="badge rounded-pill" style="background: {{ $subcategory->color }};">
                            <div class="text-black dark:text-white "> {{ trans_choice('forum::threads.thread', 2) }}: {{ $category->thread_count }}
                            </div>

                        </span>
                        <!-- <span style="background: {{ $subcategory->color }};" class="text-black dark:text-white inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none  rounded-full">Posts</span> -->
                        <span class="relative inline-block mt-1">
                            <svg class="w-6 h-6 text-gray-700 dark:text-white fill-current mt-2 " viewBox="0 0 20 20">
                                <path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            <span style="background: {{ $subcategory->color }}" class="text-black dark:text-white absolute top-2 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none transform translate-x-1/2 -translate-y-1/2 rounded-full">{{ $subcategory->post_count }}</span>
                        </span>
                        <br>
                        <!-- <span class="badge rounded-pill text-black dark:text-white" style="color: {{ $subcategory->color }};">
                        {{ trans_choice('forum::posts.post', 2) }}: {{ $subcategory->post_count }}
                    </span> -->
                    </div>
                    <div class="col-sm text-md-end text-muted ">
                        @if ($subcategory->newestThread)
                        <div>
                            <a class="font-semibold underline underline-offset-1" href="{{ Forum::route('thread.show', $subcategory->newestThread) }}" style="color: {{ $subcategory->color }}">{{ $subcategory->newestThread->title }}</a>
                            @include ('forum::partials.timestamp', ['carbon' => $subcategory->newestThread->created_at])
                        </div>
                        @endif
                        @if ($subcategory->latestActiveThread && $subcategory->latestActiveThread->post_count > 1)
                        <div>
                            <a class="font-semibold underline underline-offset-1" href="{{ Forum::route('thread.show', $subcategory->latestActiveThread->lastPost) }}" style="color: {{ $subcategory->color }}">Re: {{ $subcategory->latestActiveThread->title }}</a>
                            @include ('forum::partials.timestamp', ['carbon' => $subcategory->latestActiveThread->lastPost->created_at])
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>