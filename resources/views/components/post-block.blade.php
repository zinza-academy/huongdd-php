@can('delete-post', $post)
    <div class="py-3 flex justify-end">
        <div class="tooltip">
            <form action="{{route('post.destroy', $post->id)}}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <input
                class="cursor-pointer block px-4 py-2 text-start text-sm leading-5 text-white bg-red-700 hover:bg-red-400 focus:outline-none focus:bg-red-400 transition duration-150 ease-in-out rounded"
                type="submit" value="Delete" onclick="return sure()">
            </form>
            <p>Delete by admin/acc_user</p>
        </div>
    </div>
@endcan
<div class="flex p-2 bg-cyan-200">
    <div class="w-1/5 bg-white mr-2 py-4">
        <div class="flex justify-center">
            <div class="tooltip">
                @if ($post->user->avatar)
                <img class="h-20 w-20 rounded-full object-cover" src="{{url($post->user->avatar)}}" alt="avatar">
                @else
                <img class="h-20 w-20 rounded-full object-cover" src="{{url('img/placeholder.png')}}" alt="avatar">
                @endif
                <p>{{$post->user->name}}</p>
            </div>
        </div>
        <div class="text-center">
            <p class="font-bold mb-2">{{$post->user->name}}</p>
            @if ($post->user->company)
                <p>{{$post->user->company->name}}</p>
            @endif
        </div>
    </div>
    <div class="w-4/5 bg-white py-4 px-2">
        <div class="flex justify-between">
            <div class="font-semibold">{{$post->created_at}}</div>
            <div class="flex justify-end">
                <div>
                    @if ($post->status === Config::get('constants.POST_STATUS_RESOLVE'))
                    <x-status color='green'>
                        Resolved
                    </x-status>
                    @else
                    <x-status color='gray'>
                        Not Resolved
                    </x-status>
                    @endif
                </div>
                <div>
                    @if ($post->pinned)
                    <svg class="w-10 h-10 text-pink-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 9a7 7 0 1 1 8 6.93V21a1 1 0 1 1-2 0v-5.07A7.001 7.001 0 0 1 5 9Zm5.94-1.06A1.5 1.5 0 0 1 12 7.5a1 1 0 1 0 0-2A3.5 3.5 0 0 0 8.5 9a1 1 0 0 0 2 0c0-.398.158-.78.44-1.06Z" clip-rule="evenodd"/>
                    </svg>
                    @endif
                </div>
            </div>
        </div>
        <div class="my-3">
            @foreach ($post->tag as $tag)
                <x-tag color="{{$tag->color}}">
                    {{ $tag->name }}
                </x-tag>
            @endforeach
        </div>
        <div>
            <p class="font-semibold uppercase text-lg">{{ $post->title }}</p>
            <p>{!! $post->description !!}</p>
        </div>
    </div>
</div>
