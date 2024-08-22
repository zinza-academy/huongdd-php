<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Topic detail') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="mx-auto">
            <div class="">
                <div class="p-6 text-gray-900 relative flex bg-white">
                    <div class="p-6 text-gray-900 w-5/6">
                        <x-list>
                            <x-slot name="table">{{ $topic->name }}</x-slot>
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
                                            Pinned
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
                            <x-slot name="paginate">
                                {{ $topic->post->onEachSide(Config::get('constants.ON_EACH_SIDE'))->links(Config::get('constants.PAGINATE_VIEW')) }}
                            </x-slot>
                        </x-list>
                    </div>
                    <x-sidebar>
                        <x-newest-post/>
                    </x-sidebar>
                </div>
            </div>
        </div>
    </div>

    <x-footer-list/>
</x-app-layout>


