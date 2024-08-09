<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Company / Update') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <form action="{{route('company.update', $company->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mt-5">
                            <x-input-label for="logo" :value="__('Logo')" />
                            @if ($company->logo)
                                <img src="{{url($company->logo)}}" id="preview" alt="logo" class="h-40 object-cover">
                            @else
                                <img src="{{url('img/logoplaceholder.png')}}" id="preview" alt="logo" class="h-40 object-cover">
                            @endif
                            <x-text-input id="logo" class="block mt-1 w-60" type="file" name="logo"/>
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>
                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-60" type="text" name="name" :value="old('name', $company->name)"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mr-5">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="block mt-1 w-60" type="text" name="address" :value="old('address', $company->address)" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="max_user" :value="__('Number of users')" />
                                <x-text-input id="max_user" class="block mt-1 w-60" type="number" name="max_users" :value="old('max_users', $company->max_users)"/>
                                <x-input-error :messages="$errors->get('max_users')" class="mt-2" />
                            </div>
                            <div class="mr-5">
                                <x-input-label for="status" :value="__('Chose status')" />
                                    <select name="status" class="mt-1 w-60">
                                        <option value="deactive" @if (!$company->status === 'deactive') selected @endif >Deactive</option>
                                        <option value="active" @if ($company->status === 'active') selected @endif >Active</option>
                                    </select>
                            </div>
                        </div>
                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="datepicker" :value="__('Expire time')" />
                                <x-text-input id="datepicker" class="block mt-1 w-60" type="text" name="expired_time" :value="old('expired_time', $company->expired_time)"/>
                                <x-input-error :messages="$errors->get('expired_time')" class="mt-2" />
                            </div>
                        </div>
                        <input type="submit" class="bg-blue-300 rounded py-1 px-4 mt-5 cursor-pointer" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    option = {
        enableTime: true,
        dateFormat: "Y-m-d H:i:S"
    };
    $("#datepicker").flatpickr(option);
    $('#logo').on('change', function(e) {
        $('#preview').attr('src', URL.createObjectURL(e.target.files[0]))
    })
</script>
