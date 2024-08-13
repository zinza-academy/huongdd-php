<div class="relative overflow-x-auto mb-5">
    <div class="flex justify-between w-full py-2 bg-sky-500 text-white px-5">
        <div>
            {{ $table }}
        </div>
        @isset($link)
            <div>
                {{ $link }}
            </div>
        @endisset
    </div>
    <div>
        {{ $list }}
    </div>
    @isset($paginate)
        <div class="mt-5 px-5 py-2">
            {{ $paginate }}
        </div>
    @endisset
</div>
