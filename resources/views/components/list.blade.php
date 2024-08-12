<div class="relative overflow-x-auto border-2 mb-5">
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
</div>
