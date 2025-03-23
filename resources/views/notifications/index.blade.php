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
          <x-left-menu :user="$user" /> 

        </aside>
        <div>
            
            @foreach($notifications as $notification)
            <li>
               <a href="{{ route('tweet.show', intval($notification->post_id)) }}">  {{ $notification->message }}</a>
            </li>
        @endforeach
        </div>
    </body>