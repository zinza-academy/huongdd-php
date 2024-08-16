<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm relative flex">
                <div class="p-6 text-gray-900 w-5/6">
                    <x-list>
                        <x-slot name="table">
                            Topic
                        </x-slot>
                        <x-slot name="list">
                            <x-list-item>
                                <x-slot name="header">
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Posts
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Comments
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Newest post
                                    </th>
                                </x-slot>
                                <x-slot name="content">
                                    @foreach ($data['topics'] as $topic)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                {{ $topic->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $topic->post->count() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $topic->comment->count() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if (!$topic->post->isEmpty())
                                                    <div class="font-semibold">
                                                        <a href="{{route('post.detail', $topic->latestPost->id)}}">
                                                            {{ $topic->latestPost->title }}
                                                        </a>
                                                    </div>
                                                    <div>{{ $topic->latestPost->created_at }}</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-slot>
                            </x-list-item>
                        </x-slot>
                    </x-list>
                    @foreach ($data['topicsWithPost'] as $topic)
                        <x-list>
                            <x-slot name="table">
                                {{ $topic->name }}
                            </x-slot>
                            <x-slot name="link">
                                <x-btn color="sky" :href="route('topic.detail', $topic->id)">
                                    Readmore
                                </x-btn>
                            </x-slot>
                            <x-slot name="list">
                                <x-list-item>
                                    <x-slot name="header">
                                        <th scope="col" class="px-6 py-3 w-64">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Summary
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Created At
                                        </th>
                                    </x-slot>
                                    <x-slot name="content">
                                        @foreach ($topic->post as $post)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                                <a href="{{route('post.detail', $post->id)}}">{{$post->title}}</a>
                                            </th>
                                            <td class="px-6 py-4 truncate">
                                                {!! $post->description !!}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($post->status === Config::get('constants.POST_STATUS_RESOLVE'))
                                                <x-status color='green'>
                                                    Resolved
                                                </x-status>
                                                @else
                                                <x-status color='gray'>
                                                    Not Resolved
                                                </x-status>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $post->pinned ? 'Pinned' : '..'}}
                                            </td>
                                            <td>
                                                {{$post->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </x-slot>
                                </x-list-item>
                            </x-slot>
                        </x-list>
                    @endforeach
                </div>
                <x-sidebar>
                    <x-newest-post/>
                    <div>
                        <div>Top users</div>
                        @forelse ($data['userLikes'] as $user)
                            <div>
                                {{-- <div><img src="{{url($user->avatar)}}" alt="avatar"></div> --}}
                                <div>
                                    <p>{{ $user->name}}</p>
                                    <p>{{ $user->likes_counted }}</p>
                                </div>
                            </div>
                        @empty
                            <div>No data</div>
                        @endforelse
                    </div>
                </x-sidebar>
            </div>
        </div>
    </div>

    <x-footer-list/>
</x-app-layout>
