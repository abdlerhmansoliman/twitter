@extends('layouts.app')

@section('title', __('messages.bookmarks'))

@section('content')
    <div class="ml-4 rounded border-1 justify-center"> 
      <div class="flex items-center space-x-2">
          <svg class="h-6 w-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
              </path>
          </svg>

          <h2 class="text-xl font-bold">@lang('messages.bookmarks')</h2>
      </div>
    </div>
            @foreach ($tweets as $post)
            <x-posts :post="$post" />
        @endforeach                
            
           
        </div>

      </div>
@endsection