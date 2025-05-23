@props(['user'])



<header class="text-white py-4 h-auto">
    <!-- Navbar (left side) -->

    <div style="width: 275px; text-white">
<div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
<!--Logo-->
<svg viewBox="0 0 24 24" class="h-8 w-8 text-white ml-3" fill="currentColor">
<g>
    <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
    </path>
</g>
</svg>


<!-- Nav-->
<nav class="mt-5 px-2">
    <div class="flex flex-col space-y-4">
        <a href="{{route('tweet.index')}}" class=" {{request ()->is('tweet') ? 'bg-gray-800 text-blue-300': ''}} group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
            <svg class="mr-4 h-6 w-6 " stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"></path>
            </svg>
            @lang('messages.home')
        </a>
    
        <a href="{{route('tweet.trending')}}" class="group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
            <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
            </svg>
            @lang('messages.explore') 
        </a>
    
        <a href="{{route('notify.index')}}" class="relative group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
            <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            @lang('messages.notifications') 
        </a>
    
        <a href="{{ route('chat.index') }}" class="relative group flex items-center px-4 py-3 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300 transition-all duration-300">
            <svg class="mr-4 h-6 w-6 text-white group-hover:text-gray-200 transition-colors duration-300" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="text-lg font-semibold text-white">@lang('messages.messages')</span>
            <x-new-messages-badge />
        </a>
    
        <a href="{{route("bookmarks.index")}}" class=" {{request ()->is('bookmarks') ? 'bg-gray-800 text-blue-300': ''}} group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
            <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
            </svg>
            @lang('messages.bookmarks') 
        </a>
    
        <a href="#" class="group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
            <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            @lang('messages.lists') 
        </a>
    
        <a href="{{route('profile.show',['id'=>$user->id])}}" class=" {{request ()->is('profile') ? 'bg-gray-800 text-blue-300': ''}} group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300 ">
            <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            @lang('messages.profile') 
        </a>
    </div>


    <form method="POST" action="{{route('logout')}}">
        @csrf
<button  class="bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full">
    @lang('messages.logout') 
    
</button>
</form>
</nav>
<div class="relative inline-block text-right group" dir="rtl">
    <div class="relative inline-block">
        <!-- Input hidden for controlling the dropdown -->
        <input type="checkbox" id="language-toggle" class="hidden peer">
    
        <label for="language-toggle" class="inline-flex justify-between items-center rounded-md shadow-sm px-4 py-2 bg-blue-400 hover:bg-blue-500 w-full mt-5  text-sm font-medium text-gray-700 cursor-pointer">
            <span>@lang('messages.lang')</span>
            <svg class="mr-2 h-5 w-5 transform transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </label>
    
        <!-- Dropdown menu -->
        <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 hidden peer-checked:block transition-all duration-300 ease-in-out opacity-0 peer-checked:opacity-100">
            <div class="py-1">
                <a href="{{ url('lang/ar') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    @lang('messages.arabic')
                </a>
                <a href="{{ url('lang/en') }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    @lang('messages.english')
                </a>
            </div>
        </div>
    </div>
</div>
<!-- User Menu -->
<div class="absolute" style="bottom: 2rem;">
<div class="flex-shrink-0 flex hover:bg-gray-800 rounded-full px-4 py-3 mt-12 mr-2">
<a href="{{route('profile.index')}}" class="flex-shrink-0 group block">
    <div class="flex items-center">
        <div>
            <img class="inline-block h-10 w-10 rounded-full" src="{{Auth::user()->image_url}}" alt="Profile Image">
   
     </div>
        <div class="ml-3">
            <p class="text-base leading-6 font-medium text-white">
                {{Auth::user()->name}}
            </p>
            <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                {{Auth::user()->name}}
            </p>
        </div>
    </div>
</a>
</div>
</div>
</div>
</div>
</header>
