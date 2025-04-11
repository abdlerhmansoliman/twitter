<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 

    <title>@lang('messages.profile')</title>

</head>
<body>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 max-w-xl mx-auto mt-10">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name', Auth::user()->name)" required autofocus />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email', Auth::user()->email)" required />
        </div>

        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-text-input id="bio" class="block mt-1 w-full" type="text" name="bio"
                          :value="old('bio', Auth::user()->bio)" />
        </div>

        <!-- Personal Link -->
        <div>
            <x-input-label for="link" :value="__('Personal Link')" />
            <x-text-input id="link" class="block mt-1 w-full" type="text" name="link"
                          :value="old('link', Auth::user()->link)" />
        </div>

        <!-- Profile Image -->
        <div>
            <x-input-label for="profile_image" :value="__('Profile Image')" />
            <x-text-input id="profile_image" class="block mt-1 w-full" type="file" name="profile_image" />
        </div>

        <!-- Cover Image -->
        <div>
            <x-input-label for="cover_image" :value="__('Cover Image')" />
            <x-text-input id="cover_image" class="block mt-1 w-full" type="file" name="cover_image" />
        </div>

        <x-primary-button class="w-full">
            {{ __('Save Changes') }}
        </x-primary-button>
    </form>
</body>
