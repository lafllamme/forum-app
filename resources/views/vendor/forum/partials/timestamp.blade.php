@if(isset($category))
<time class="bg-slate-200 text-black dark:text-white m-2 inline-flex items-center 
justify-center px-2 py-1 text-xs font-bold leading-none rounded-full" style="background: {{ $category->color}};" datetime="{{ $carbon }}" title="{{ $carbon->toDayDateTimeString() }}">{{ $carbon->diffForHumans() }}</time>

@elseif(isset($subcategory))
<time class="bg-slate-200 text-black dark:bg-gray-600 dark:text-white m-2 inline-flex items-center 
justify-center px-2 py-1 text-xs font-bold leading-none rounded-full" datetime="{{ $carbon }}" title="{{ $carbon->toDayDateTimeString() }}" style="background: {{ $subcategory->color}};">{{ $carbon->diffForHumans() }}</time>

@else
<time class="text-black dark:text-white m-2 inline-flex items-center 
justify-center px-2 py-1 text-xs font-bold leading-none rounded-full" datetime="{{ $carbon }}" title="{{ $carbon->toDayDateTimeString() }}" >{{ $carbon->diffForHumans() }}</time>
@endif
