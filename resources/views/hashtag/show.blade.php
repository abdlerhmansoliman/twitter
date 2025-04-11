@extends('layouts.app')

@section('title', __('messages.chats'))

@section('content')

    <div class="flex justify-center">

            <div class="w-3/5 border border-gray-600 h-auto  border-t-0">
                <!--middle wall-->
             
                
                <hr class="border-gray-800 border-2">

                <div class="flex justify-center space-x-4 p-3 border-b border-gray-700">

                    <a href="{{ route('tweet.trending', ['filter' => 'top_hashtags']) }}" class="text-gray-500 hover:text-white font-semibold text-sm px-4 py-2 rounded-lg transition">
                        #Hashtags
                    </a>
                </div>


            @foreach ($posts as $post )
    
            <x-posts :post="$post" />
            
            
            
              @endforeach        


              <!--third tweet-->



        </div>


        <x-right-menu :hashtags="$hashtags" :suggestedUsers="$suggestedUsers"  />
 
        </div>

    </div>
</div>  
    </div>
@endsection