<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Post details') }}
        </h2>
    </x-slot>
    @php
        $user = Auth::user();
    @endphp
    <div class="">
        <div class="mx-auto">
            <div class="">
                <div class="p-6 text-gray-900 relative bg-white">
                    <div class="w-full text-gray-900 my-2">
                        <x-post-block/>
                    </div>

                    <x-comment-block/>

                    {{-- upload cmt --}}
                    <div class="w-full text-gray bg-gray-200 mt-2">
                        <div class="flex p-2">
                            <div class="w-1/5 bg-white mr-2 py-4">
                                <div class="flex justify-center">
                                    <div class="tooltip">
                                        @if ($user->avatar)
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{url($user->avatar)}}" alt="avatar">
                                        @else
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{url('img/placeholder.png')}}" alt="avatar">
                                        @endif
                                        <p>{{$user->name}}</p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="font-bold mb-2">{{$user->name}}</p>
                                    @if ($user->company)
                                        <p>{{$user->company->name}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="w-4/5 bg-white py-4 px-2">
                                <form action="{{route('comment.store')}}" method="POST">
                                    @csrf
                                    <textarea id="message" rows="4" name="content" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="flex justify-end mt-3">
                                        <input class="submit-btn cursor-pointer py-2 px-4 rounded-lg bg-blue-500 text-white" type="submit" value="Send" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer-list/>
</x-app-layout>

<script>
    $('.submit-btn').on('click', function(e) {
        localStorage.setItem('currentPos', window.scrollY);
    })

    window.addEventListener('load', function() {
        let currentPos = localStorage.getItem('currentPos');
        if (currentPos) {
            window.scrollTo(0, parseInt(currentPos));
            localStorage.removeItem('currentPos');
        }
    })

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#cmt-block').html($(data).find('#cmt-block').html());
                window.scrollTo(0, 0);
            }
        });
        window.history.pushState("", "", url);
    })

    const urls = {
        'like' : "{{route('like')}}",
        'dislike' : "{{route('dislike')}}"
    };

    $(document).on('click', '.like-btn, .dislike-btn', function(e) {
        e.preventDefault();

        const button = $(this);
        const isLikeAction = button.hasClass('like-btn');
        const data = {
            'comment_id': button.data('commentId'),
            'user_id': button.data('userId')
        };
        const $likes = $(`#like-comment-${data['comment_id']}`);
        const url = isLikeAction ? urls['like'] : urls['dislike'];
        const method = isLikeAction ? 'POST' : 'DELETE';

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function() {
                let currLikes = parseInt($likes.text());
                if (isLikeAction) {
                    button.removeClass('like-btn').addClass('dislike-btn');
                    button.html('<svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z"/></svg>');
                    currLikes++;
                    console.log('liked');
                } else {
                    button.removeClass('dislike-btn').addClass('like-btn');
                    button.html('<svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/></svg>');
                    currLikes--;
                    console.log('disliked');
                }
                $likes.text(currLikes);
            }
        });
    });

</script>


