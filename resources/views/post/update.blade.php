<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Post / Update') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900 w-1/2">
                    <form class="" action="{{route('post.update', $post->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mt-5">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $post->title)"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-5">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea name="description" id="editor">{{old('description', $post->description)}}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="mt-5">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" class="mt-1 w-60">
                                <option value="{{Config::get('constants.POST_STATUS_RESOLVE')}}">Resolved</option>
                                <option value="{{Config::get('constants.POST_STATUS_NOTRESOLVED')}}" selected >Not Resolved</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        <div class="mt-5">
                            <x-input-label for="topic_id" :value="__('Topic')" />
                            <select name="topic_id" class="mt-1 w-60">
                                @foreach ($topics as $topic)
                                    <option value="{{$topic->id}}" selected>{{$topic->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('topic_id')" class="mt-2" />
                        </div>
                        <div class="mt-5">
                            <x-input-label for="tags[]" :value="__('Tag')" />
                            <select class="mt-1 tags_select w-96" name="tags[]" id="tags" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{in_array($tag->id, $post->tag->pluck('id')->toArray()) ? 'selected' : ''}}>{{$tag->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tags[]')" class="mt-2" />
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="submit" class="bg-blue-300 rounded py-1 px-4 mt-5 cursor-pointer" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tags').select2();
        });
        ClassicEditor.create(document.querySelector( '#editor' ) , {
            ckfinder: {
                uploadUrl: "{{route('img.upload', ['_token' => csrf_token()])}}",
            }
        });
    </script>
</x-app-layout>



