@props(['post'])


<div class="flex flex-shrink-0 p-4 pb-0">
    <a href="{{ route('profile.show',  ['id' => $post->user->id])}}" class="flex-shrink-0 group block">
      <div class="flex items-center">
        <div>
          <img class="inline-block h-10 w-10 rounded-full" src=" {{ $post->user->image_url }}" alt="" />
        </div>
        <div class="ml-3">
          <p class="text-base leading-6 font-medium text-white">
            {{$post->user->name}}
            <a href="/profile" class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                @ .{{$post->user->name}} . {{$post->created_at->format('d F')}}
              </a>
               </p>
        </div>
      </div>
    </a>
</div>


<div class="text-white pl-16">
    @if($post->post)
    {!! preg_replace_callback('/#([\w]+)/', function ($matches) {
        return '<a href="' . route('hashtag.show', ['hashtag' => $matches[1]]) . '" class="text-blue-400 hover:underline">#' . $matches[1] . '</a>';
    }, e($post->post)) !!}    @endif
    @if ($post->image)
    <div class="md:flex-shrink pr-6 pt-3">
        <img class="rounded-lg w-full h-64" src="{{ asset('storage/' . $post->image->url) }}" alt="Post Image">
    </div>            
    @endif


    <div class="flex">
        <div class="w-full">
            
            <div class="flex items-center">
                <div class="flex-1 text-center">
                    <a href="{{route('tweet.show',$post->id)}}" class="flex items-center space-x-2 px-3 py-2 text-gray-500 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                        <svg class=" h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span class="text-lg text-gray-400">{{ $post->replies()->count() }}</span>
                     
                    </a>
                </div>

                <div class="flex-1 text-center py-2 m-2">
                    <form method="POST" action="{{route('post.retweet',$post->id)}}">
                        @csrf
                    <button type="submit" class="flex items-center space-x-2 px-3 py-2 text-gray-500 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                        <svg class="h-7 w-6 " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path></svg>
                            <span class="text-lg text-gray-400">{{ $post->retweetedby()->count() }}</span>

                    </button>
                </form>
                </div>

                <div class="flex-1 text-center py-2 m-2">
                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 px-3 py-2 text-gray-500 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                            <svg class="h-7 w-6 {{$post->likes()->where('user_id', auth()->id())->exists()? 'text-red-500':'text-gray-500'}} " fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-lg text-gray-400">{{ $post->likes()->count() }}</span>
                        </button>
                    </form>
                </div>

                <div class="flex-1 text-center py-2 m-2">
                    <a href="#" class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                        <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </a>
                </div>
                <div class="flex-1 text-center py-2 m-2">
                    <form method="POST" action="{{ route('bookmark.mark', $post->id) }}">
                        @csrf
                    <button  class="flex items-center space-x-2 px-3 py-2 text-gray-500 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                        <svg class="h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20">
                                </path></svg>
                            <span class="text-lg text-gray-400">{{ $post->bookmark->count() }}</span>

                </button>
                </div>
                </form>
                <div class="flex-1 text-center py-2 m-2">
                    <a href="#" class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300">
                        <svg class="text-center h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </a>
                </div>

            </div>
        </div>

    
    </div>

</div>
  <hr class="border-gray-600">


<hr class="border-gray-600">
