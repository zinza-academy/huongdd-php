<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('User / Update') }}
        </h2>
    </x-slot>
    <div class="">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mt-5">
                            @if ($user->avatar)
                                <img src="{{url('storage/' . $user->avatar)}}" alt="avatar" class="h-20">
                            @else
                                <img src="{{url('img/placeholder.png')}}" alt="avatar" class="h-20">
                            @endif
                            <x-text-input id="avatar" class="block mt-1 w-60" type="file" name="avatar"/>
                            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                        </div>
                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-60" type="text" name="name" :value="old('name') ? old('name') : $user->name"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mr-5">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-60" type="text" name="email" :value="$user->email" disabled />
                            </div>
                        </div>

                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="old-password" :value="__('Old password')" />
                                <x-text-input id="old-password" class="block mt-1 w-60" type="password" name="old_password" :value="old('old_password')"/>
                                <x-input-error :messages="$errors->get('old_password')" class="mt-2" />
                            </div>
                            <div class="mr-5">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-60" type="password" name="password" :value="old('password')" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="password-confirm" :value="__('Password confirm')" />
                                <x-text-input id="password-confirm" class="block mt-1 w-60" type="password" name="password_confirm" :value="old('password_confirm')" />
                                <x-input-error :messages="$errors->get('password_confirm')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex justify-start mt-5">
                            <div class="mr-5">
                                <x-input-label for="role" :value="__('Role')" />
                                    <select name="role" class="mt-1 w-60">
                                        <option value="0" @if (!$user->role) selected @endif >Member</option>
                                        <option value="1" @if ($user->role) selected @endif >Company account</option>
                                    </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            <div class="mr-5">
                                <x-input-label for="company" :value="__('Company')" />
                                @if (Auth::user()->is_admin)
                                    <select name="company" class="mt-1 w-60">
                                        @isset($companies)
                                            <option selected value="0"
                                                @if (!$user->company_id)
                                                    selected
                                                @endif >Select company
                                            </option>
                                            @foreach ($companies as $company)
                                                <option value="{{$company->id}}" @if ($company->id === $user->company_id) selected @endif >{{$company->name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    @else
                                        <p class="mt-1 w-60">{{$companies->name}}</p>
                                        <input type="hidden" id="company" name="company" class="block mt-1 w-60" value="{{ $companies->id }}" readonly>
                                    @endif
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>

                        </div>

                        <div class="mt-5">
                            <x-input-label for="dob" :value="__('Date of birth')" />
                            <input type="text" id="datepicker" class="block mt-1 w-60" name="dob" value="{{ old('dob') ? old('dob') : $user->dob }}">
                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                        </div>
                        <input type="submit" class="bg-blue-300 rounded py-1 px-4 mt-5 cursor-pointer" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
