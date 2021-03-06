<x-guest-layout>
    <div id="blogcms"></div>
    <div id="blogempty">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/en">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/en/register" encType="multipart/form-data" id="abc1">
            @csrf


            <!-- Name -->
            <div>
                <x-label for="firstname" :value="__('FirstName')" />
                <x-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="lastname" :value="__('LastName')" />
                <x-input id="LastName" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
            </div>

            <!-- DOB -->
            <div class="mt-4">
                <x-label for="dob" :value="__('DoB')" />
                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required />
            </div>

            <!--profile picture -->
            <div class="mt-4">
                <x-label for="image"  :value="__('Select Profile')" />
                <x-input type="file" name="image" class=" block mt-1 w-full" :value="old('image')" required />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            {{-- <div class="mt-4">
                <x-label for="checkrole" :value="__('Role')" />
                <select name="roles" required  class="form-select block mt-1 w-full" aria-label="Default select example">
                    <option value="2">select</option>
                @foreach($data1 as $data)

                    <option value={!! $data->id !!}>
                        {{$data->display_name}}
                    </option>
                @endforeach


                </select>
                </div> --}}

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" id="login1">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</div>
</x-guest-layout>
