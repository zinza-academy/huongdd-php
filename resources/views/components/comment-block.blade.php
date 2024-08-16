<div id="cmt-block">
    @forelse ($comments as $comment)
    <div class="w-full text-gray-900 my-2">
        <div class="flex p-2 bg-gray-200">
            <div class="w-1/5 bg-white mr-2 py-4">
                <div class="flex justify-center">
                    <div class="tooltip">
                        @if ($comment->user->avatar)
                        <img class="h-20 w-20 rounded-full object-cover" src="{{url($comment->user->avatar)}}" alt="avatar">
                        @else
                        <img class="h-20 w-20 rounded-full object-cover" src="{{url('img/placeholder.png')}}" alt="avatar">
                        @endif
                        <p>{{$comment->user->name}}</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="font-bold mb-2">{{$comment->user->name}}</p>
                    @if ($comment->user->company)
                        <p>{{$comment->user->company->name}}</p>
                    @endif
                </div>
            </div>
            <div class="w-4/5 bg-white py-4 px-2">
                <div class="flex justify-between py-3">
                    <div class="font-semibold">{{$comment->created_at}}</div>
                    <div class="flex gap-x-2">
                        <span id="like-comment-{{$comment->id}}">{{ $comment->like->count() }}</span>
                        <x-like-btn :active="in_array($comment->id, $user->like->pluck('comment_id')->toArray())"
                            data-comment-id="{{$comment->id}}" data-user-id="{{$user->id}}"/>

                        @can('mark-resolve', $comment)
                        <form action="{{route('comment.resolve', ['cmt_id' => $comment->id, 'post_id' => $comment->post->id, 'user_id' => $comment->user->id])}}" method="POST">
                            @csrf
                            <div class="inline-block tooltip">
                                <input class="cursor-pointer ring-2 rounded-lg px-1" type="submit" value="Resolve" name="submit">
                                <p>Click to resolve this comment</p>
                            </div>
                        </form>
                        @endcan
                        @if ($comment->is_solution)
                            <span class="text-green-500">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd"/>
                                  </svg>
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <p>{!! $comment->content !!}</p>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div>This post has no comments yet</div>
    @endforelse
    {{$comments->appends(['page' => request('page')])->links('vendor.pagination.semantic-ui')}}
</div>
