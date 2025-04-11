@extends('layouts.app')

@section('title', __('messages.notifications'))

@section('content')

<div class="max-w-2xl mx-auto  p-5 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">@lang('messages.notifications')</h2>
    
    @if ($notifications->count() > 0)
        <ul>
            @foreach ($notifications as $notification)
                <li class="border-b p-3">
                    {{ $notification->data['message'] }}
                    <span class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    

                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">@lang('messages. no notifications')</p>
    @endif
</div>
    </div>
@endsection