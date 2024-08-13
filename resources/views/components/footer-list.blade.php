<div class="flex flex-wrap bg-gray-100 p-5">
    @foreach ($topics as $topic)
        <div class="w-1/6 p-1">
            {{$topic->name}}
        </div>
    @endforeach
</div>
