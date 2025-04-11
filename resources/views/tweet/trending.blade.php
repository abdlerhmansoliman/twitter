@extends('layouts.app')

@section('title', __('messages.trending'))

@section('content')

    <div class="min-h-screen text-white" style=" background-color: #15202b;">
        <div class="flex">



            <div class="w-3/5 border border-gray-600 h-auto  border-t-0">
                <!--middle wall-->
             
                
                <hr class="border-gray-800 border-2">

                <div class="flex justify-center space-x-4 p-3 border-b border-gray-700">
                    <a href="{{ route('tweet.trending') }}" class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
                        @lang('messages.explore') 

                    </a>
                    <a href="{{ route('tweet.trending', ['filter' => 'top_hashtags']) }}" class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
                        #@lang('messages.hashtags') 

                    </a>
                </div>

                @if(isset($hashtags) && $hashtags->isNotEmpty())
                @foreach ($hashtags as $hashtag)
                    <div class="p-3 border-b border-gray-700">
                        <a href="{{ route('hashtag.show', ['hashtag' => $hashtag->name]) }}" class="text-blue-500 hover:underline">
                            #{{ $hashtag->name }}
                        </a>
                        <span class="text-gray-500 text-sm">({{ $hashtag->posts_count }} posts)</span>
                    </div>
                @endforeach
            @else
            @foreach ($trending as $post )
    
            <x-posts :post="$post" />
            
            
            
              @endforeach            @endif


              <!--third tweet-->



        </div>




    <div/>
        </div>
    </div>
    
@endsection