@foreach ($newestPosts as $post)
    <div class="border p-5 mx-5">
        <div class="font-medium text-lg">
            <a href="{{route('post.detail', $post->id)}}">{{$post->title}}</a>
        </div>
        <div class="truncate">{!! $post->description !!}</div>
        <div class="flex justify-between">
            @if (isset($post->user->avatar))
            <img src="{{url($post->user->avatar)}}" alt="avatar" class="w-10 h-10 rounded-full">
            @else
            <img src="{{url('img/placeholder.png')}}" alt="avatar" class="w-10 h-10 rounded-full">
            @endif
            <div>
                {{$post->created_at}}
            </div>
        </div>
    </div>
@endforeach
