<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
      <link href="./output.css" rel="stylesheet">


    <title>Home</title>
</head>
<body style="background-color: #15202b;" >
    <div>
        <title>post</title>
      </div>
      <div class="flex">
        <x-left-menu :user="$user"   /> 
    
        <div class="ml-4 w-full max-w-2xl">        
            <x-posts :post="$post" />
    
            <div class="comments-section mt-5">
                <form method="POST" action="{{ route('tweet.store') }}" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <input type="text" name="post" 
                           class="bg-gray-900 text-gray-300 font-medium text-sm w-full p-2 rounded-lg border border-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-400"
                           placeholder="Write a comment...">
                           <input type="hidden" name="parent_id" value="{{ $parentPost->id ?? '' }}">
    
                           <input type="file" name="images" multiple>
                           @if(isset($post))
                           <input type="hidden" name="parent_id" value="{{ $post->id }}">
                       @endif
                       <div class="flex-1">
                        <button type="submit" class="bg-blue-400 mt-5 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full mr-8 float-right">
                            @lang('messages.replay')
                          </button>
                    </div>
                </form>
            
                <h3 class="text-gray-300 text-sm font-semibold mb-3">@lang('messages.replies')</h3>
    
                <div class="flex flex-col space-y-2">
                    @foreach ($post->replies as $reply)
                    <div class="comment border-b border-gray-700 p-2 text-sm">
                      <strong class="text-white text-xs">{{ $reply->user->name }}</strong>
                      <p class="text-gray-400 text-xs">{{ $reply->post }}</p>
                      @if ($reply->image)
                      <img src="{{ asset('storage/' . $reply->image->url) }}" class="w-40 h-40 object-cover rounded-lg">
                  @endif
                      {{-- <img src="{{{asset('storage/' . $reply->url) }}}}" alt=""> --}}
                      <small class="text-gray-500 text-[10px]">{{ $reply->created_at->diffForHumans() }}</small>
                      
                  </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
</body>