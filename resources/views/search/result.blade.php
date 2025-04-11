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
    <div class="text-white container mx-auto flex">


        <aside class="w-1/4 p-4">
          <x-left-menu :user="$user"  /> 

        </aside>
    
        <main class="w-1/2 p-4">
            <h2 class="text-2xl font-bold mb-4"> Search Results</h2>
    
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Users</h3>
                <div class="space-y-4">
                    @foreach ($users as $user )
                    <div class="flex flex-shrink-0 p-4 pb-0">
                        <a href="{{ route('profile.show',  ['id' => $user->id])}}" class="flex-shrink-0 group block">
                          <div class="flex items-center">
                            <div>
                              <img class="inline-block h-10 w-10 rounded-full" src=" {{ $user->image_url }} " alt="" />
                            </div>
                            <div class="ml-3">
                              <p class="text-base leading-6 font-medium text-white">
                                {{$user->name}}
                                <a href="/profile" class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                    @ .{{$user->name}}  {{$user->created_at->format('d F')}}
                                  </a>
                                   </p>
                            </div>
                          </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
    
            <div>
                <h3 class="text-xl font-semibold mb-2">Tweets</h3>
                <div class="space-y-4">
                    @foreach($posts as $post)
                      <x-posts :post="$post" />
                        
                    @endforeach
                </div>
            </div>
        </main>
    
        <aside class="w-1/4 p-4">
        </aside>
    
    </div>
</body>