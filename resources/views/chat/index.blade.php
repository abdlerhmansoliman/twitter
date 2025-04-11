@extends('layouts.app')

@section('title', __('messages.chats'))

@section('content')
 
    
        <main class="flex-1 min-h-screen border-r border-l border-gray-700 mx-auto max-w-4xl p-4">
            <h2 class="text-xl font-bold mb-4">@lang('messages.chats') </h2>
            
            @forelse($chatUsers as $chatUser)
                <a href="{{ route('chat.show', $chatUser->id) }}" class="block p-3 hover:bg-gray-800 rounded mb-2 transition-all duration-200">
                    <div class="flex items-center">
                        <img src="{{ $chatUser->image_url ?? 'https://via.placeholder.com/40' }}" alt="avatar" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold">{{ $chatUser->name }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-400">
                    @lang('messages.there is no chats')
                </p>
            @endforelse
        </main>
    </div>
    @endsection
