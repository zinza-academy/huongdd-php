<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Post management') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="">

                <div class="p-6 text-gray-900">
                    <div class="mb-5">
                        <x-btn href="{{route('post.create')}}" color="blue">
                            Create new post
                        </x-btn>
                    </div>
                    <div class="relative">
                        <table class="mb-3 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Author
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tags
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                                >
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$post->title}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($post->user->id === Auth::user()->id)
                                            <x-status color="green">{{$post->user->name}}</x-status>
                                        @else
                                            <x-status color="neutral">{{$post->user->name}}</x-status>
                                        @endif

                                    </th>
                                    <td class="px-6 py-4">
                                        @if ($post->deleted_at)
                                        <x-status color='red'>
                                            Deleted by admin/company_account
                                        </x-status>
                                        @elseif ($post->status === Config::get('constants.POST_STATUS_RESOLVE'))
                                        <x-status color='green'>
                                            Resolved
                                        </x-status>
                                        @else
                                        <x-status color='gray'>
                                            Not Resolved
                                        </x-status>
                                        @endif
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if($post->tag->first() !== null)
                                            <span style="background-color: {{$post->tag->first()->color}}" class="inline-block text-white px-3 py-1">
                                                {{$post->tag->first()->name}}
                                            </span>
                                        @endif
                                    </th>

                                    <td class="px-6 py-4">
                                        <x-dropdown>
                                            <x-slot name="trigger" class="rounded bg-gray-700 cursor-pointer">
                                                Action
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('post.edit', $post->id)">
                                                    Update
                                                </x-dropdown-link>
                                                @can('delete-post', $post)
                                                    <form action="{{route('post.destroy', $post->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input
                                                        class="cursor-pointer block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                                        type="submit" value="Delete" onclick="return sure()">
                                                    </form>
                                                @endcan
                                            </x-slot>
                                        </x-dropdown>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$posts->onEachSide(Config::get('constants.ON_EACH_SIDE'))->links(Config::get('constants.PAGINATE_VIEW'))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


