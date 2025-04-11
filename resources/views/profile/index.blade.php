@extends('layouts.app')

@section('title', __('messages.profile'))

@section('content')
        <main role="main">
            <div class="flex" style="width: 990px;">
                <section class="w-3/5 border border-y-0 border-gray-800" style="max-width:600px;">
                    <!--Content (Center)-->
                        <!-- Nav back-->
<div>
<div class="flex justify-start">
    <div class="px-4 py-2 mx-2">
        <a href="" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <g>
                    <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                    </path>
                </g>
            </svg>
        </a>
    </div>
    <div class="mx-2">
        <h2 class="mb-0 text-xl font-bold text-white">{{$user->name}}</h2>
        <p class="mb-0 w-48 text-xs text-gray-400">{{$user->posts()->count()}} @lang('messages.tweets')</p>
    </div>
</div>

<hr class="border-gray-800">
</div>

<!-- User card-->
<div>
<div class="w-full bg-cover bg-no-repeat bg-center" style="height: 200px; background-image: url('{{ $user->cover_url }}');">
    <img class="opacity-0 w-full h-full" src="https://pbs.twimg.com/profile_banners/2161323234/1585151401/600x200" alt="">
</div>
<div class="p-4">
    <div class="relative flex w-full">
        <!-- Avatar -->
        <div class="flex flex-1">
            <div style="margin-top: -6rem;">
                <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                    <img style="height:9rem; width:9rem;" class="md rounded-full relative border-4 border-gray-900" src="{{   $user->image_url }}" alt="Profile Image">
                    
                    <div class="absolute"></div>
                </div>
            </div>
        </div>
        <!-- Follow Button -->
        <div class="flex flex-col text-right">
            @if($isOwner)
                
            <a href="{{route('profile.edit')}}" class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring   max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800 hover:border-blue-800 flex items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">
                Edit Profile
            </a>
            @else
            @if(Auth::user()->isFollowing($user))
            <form method="Post" action="{{route('user.unfollow', $user->id )}}">
                @csrf
            <button type="submit" class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring   max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800 hover:border-blue-800 flex items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">
                @lang('messages.unfollow')
            </button>
        </form>
            @else    
            <form method="Post" action="{{route('user.follow', $user->id )}}">
                @csrf
            <button type="submit" class="flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring   max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800 hover:border-blue-800 flex items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">
                @lang('messages.follow')

            </button>
        </form>
        @endif

            @endif
            
        </div>
    </div>

    <!-- Profile info -->
    <div class="space-y-1 justify-center w-full mt-3 ml-3">
        <!-- User basic-->
        <div>
            <h2 class="text-xl leading-6 font-bold text-white">{{$user->name}}</h2>
            <p class="text-sm leading-5 font-medium text-gray-600">@ {{$user->name}}</p>
        </div>
        <!-- Description and others -->
        <div class="mt-3 text-white">
            <p class=" leading-tight mb-2"> {{$user->bio}}</p>
            <div class="text-gray-600 flex">
                <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon"><g>
                    <path d="M11.96 14.945c-.067 0-.136-.01-.203-.027-1.13-.318-2.097-.986-2.795-1.932-.832-1.125-1.176-2.508-.968-3.893s.942-2.605 2.068-3.438l3.53-2.608c2.322-1.716 5.61-1.224 7.33 1.1.83 1.127 1.175 2.51.967 3.895s-.943 2.605-2.07 3.438l-1.48 1.094c-.333.246-.804.175-1.05-.158-.246-.334-.176-.804.158-1.05l1.48-1.095c.803-.592 1.327-1.463 1.476-2.45.148-.988-.098-1.975-.69-2.778-1.225-1.656-3.572-2.01-5.23-.784l-3.53 2.608c-.802.593-1.326 1.464-1.475 2.45-.15.99.097 1.975.69 2.778.498.675 1.187 1.15 1.992 1.377.4.114.633.528.52.928-.092.33-.394.547-.722.547z"></path><path d="M7.27 22.054c-1.61 0-3.197-.735-4.225-2.125-.832-1.127-1.176-2.51-.968-3.894s.943-2.605 2.07-3.438l1.478-1.094c.334-.245.805-.175 1.05.158s.177.804-.157 1.05l-1.48 1.095c-.803.593-1.326 1.464-1.475 2.45-.148.99.097 1.975.69 2.778 1.225 1.657 3.57 2.01 5.23.785l3.528-2.608c1.658-1.225 2.01-3.57.785-5.23-.498-.674-1.187-1.15-1.992-1.376-.4-.113-.633-.527-.52-.927.112-.4.528-.63.926-.522 1.13.318 2.096.986 2.794 1.932 1.717 2.324 1.224 5.612-1.1 7.33l-3.53 2.608c-.933.693-2.023 1.026-3.105 1.026z"></path></g></svg>
                     <a href="{{$user->link}}" target="#" class="leading-5 ml-1 text-blue-400">{{$user->link}}</a>
                </span>
            </div>
            <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon"><g>
                <path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg> 
                <span class="leading-5 ml-1">{{$user->created_at->format('l, d F Y')}}</span></span>
        </div>
        <div class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
            <div class="text-center px-3">
                <a href="{{route('profile.show', ['id' => $user->id])}}" class="text-gray-600"> 
                <span class="font-bold text-white">{{$user->posts()->count()}} </span>
                    
                @lang('messages.tweets')
                 </a>
            </div>
            <div class="text-center pr-3"><span class="font-bold text-white">{{$user->FollowinCount()}}</span><span class="text-gray-600"> @lang('messages.following')</span></div>
            <div class="text-center px-3">
                <span class="font-bold text-white">{{$user->followersCount()}} </span>
                <span class="text-gray-600"> @lang('messages.follower')</span>
            </div>
            <div class="text-center px-3">
                <a href="{{route('profile.show', ['id' => $user->id, 'filter' => 'likes'])}}" class="text-gray-600">
                <span class="font-bold text-white">{{$user->likedPosts()->count()}} </span>
                    @lang('messages.likes')
                     </a>
            </div>
        </div>
    </div>
</div>
<hr class="border-gray-800">
</div>

<ul class="list-none">

                <!--second tweet-->
@foreach ($posts as $post )
    
<x-posts :post="$post" />



  @endforeach


  <!--third tweet-->



</div>
<hr class="border-gray-800">



        </li>
        </ul>
                </section>


                <aside class="w-2/5 h-12 position-relative">
                    <!--Aside menu (right side)-->
                            <div style="max-width:350px;">
<div class="overflow-y-auto fixed  h-screen">




            <div class="relative text-gray-300 w-80 p-5">
<button type="submit" class="absolute ml-4 mt-3 mr-4">
    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
    </svg>
</button>

<input type="search" name="search" placeholder="Search Twitter" class=" bg-dim-700 h-10 px-10 pr-5 w-full rounded-full text-sm focus:outline-none bg-purple-white shadow rounded border-0">
</div>
    <!--trending tweet section-->
<div class="max-w-sm rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4">
<div class="flex mb-1">
    <!-- Image-->
    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full mr-1">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/116865832_615803592697921_5045643941059143720_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=101&amp;_nc_ohc=EQFsJZNRIPMAX-pb8EZ&amp;tp=1&amp;oh=1ffba368dc5827c172420060b811d1c4&amp;oe=60433210);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/116865832_615803592697921_5045643941059143720_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=101&amp;_nc_ohc=EQFsJZNRIPMAX-pb8EZ&amp;tp=1&amp;oh=1ffba368dc5827c172420060b811d1c4&amp;oe=60433210" alt="">
        </div>
    </a>

    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full mr-1">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/33476414_2111389325772141_4942435591556956160_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=109&amp;_nc_ohc=m4fof_6edMQAX8y6Mma&amp;tp=1&amp;oh=66d43f3c9ef1e6d35aa27b5ea79fc566&amp;oe=6045E945);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/33476414_2111389325772141_4942435591556956160_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=109&amp;_nc_ohc=m4fof_6edMQAX8y6Mma&amp;tp=1&amp;oh=66d43f3c9ef1e6d35aa27b5ea79fc566&amp;oe=6045E945" alt="">
        </div>
    </a>

    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/fr/e15/s1080x1080/71304173_398561657763867_3930777215019056798_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=103&amp;_nc_ohc=V2sPZa9JmQAAX_Lmo3e&amp;tp=1&amp;oh=ecbe6e24eb0d74975e725fceaaf09f5b&amp;oe=60460257);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/fr/e15/s1080x1080/71304173_398561657763867_3930777215019056798_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=103&amp;_nc_ohc=V2sPZa9JmQAAX_Lmo3e&amp;tp=1&amp;oh=ecbe6e24eb0d74975e725fceaaf09f5b&amp;oe=60460257" alt="">
        </div>
    </a>
</div>
<div class="flex">
    <!-- Image-->
    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full mr-1">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/28765942_569404996768567_810640940719931392_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=107&amp;_nc_ohc=Xf0LrzDMbp8AX8S55zD&amp;tp=1&amp;oh=0cf858806b52e56cc9093211b2656831&amp;oe=6045F090);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/28765942_569404996768567_810640940719931392_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=107&amp;_nc_ohc=Xf0LrzDMbp8AX8S55zD&amp;tp=1&amp;oh=0cf858806b52e56cc9093211b2656831&amp;oe=6045F090" alt="">
        </div>
    </a>

    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full mr-1">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/27877940_216827205533781_6550488685962330112_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=109&amp;_nc_ohc=ihm93wr5mUUAX_w6e1G&amp;tp=1&amp;oh=e492418bf694b130464f681f9fedd180&amp;oe=60442B6C);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/27877940_216827205533781_6550488685962330112_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=109&amp;_nc_ohc=ihm93wr5mUUAX_w6e1G&amp;tp=1&amp;oh=e492418bf694b130464f681f9fedd180&amp;oe=60442B6C" alt="">
        </div>
    </a>

    <a href="https://www.instagram.com/ricardoribeiro.rr/" target="#" class="flex-col w-full">
        <div class="w-full bg-cover bg-no-repeat bg-center" style="height:100px; background-image: url(https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/22277804_1824335967579893_4558955485163683840_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=105&amp;_nc_ohc=CknMgBUYNhcAX-Jxi0P&amp;tp=1&amp;oh=631583468373481077e1834df4031435&amp;oe=6045BD08);">
            <img class="opacity-0" src="https://instagram.flis9-1.fna.fbcdn.net/v/t51.2885-15/e35/22277804_1824335967579893_4558955485163683840_n.jpg?_nc_ht=instagram.flis9-1.fna.fbcdn.net&amp;_nc_cat=105&amp;_nc_ohc=CknMgBUYNhcAX-Jxi0P&amp;tp=1&amp;oh=631583468373481077e1834df4031435&amp;oe=6045BD08" alt="">
        </div>
    </a>
</div>
</div>
    <!--trending tweet section-->
<div class="max-w-sm rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4">
<div class="flex">
    <div class="flex-1 m-2">
        <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Germany trends</h2>
    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" text-2xl rounded-full text-white hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </a>
    </div>
</div>


<hr class="border-gray-800">

<!--first trending tweet-->
<div class="flex">
    <div class="flex-1">
        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">1 . Trending</p>
        <h2 class="px-4 ml-2 w-48 font-bold text-white">#Microsoft363</h2>
        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,466 Tweets</p>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</div>
<hr class="border-gray-800">

<!--second trending tweet-->

<div class="flex">
    <div class="flex-1">
        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">2 . Politics . Trending</p>
        <h2 class="px-4 ml-2 w-48 font-bold text-white">#HI-Fashion</h2>
        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">8,464 Tweets</p>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</div>
<hr class="border-gray-800">

<!--third trending tweet-->

<div class="flex">
    <div class="flex-1">
        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">3 . Rock . Trending</p>
        <h2 class="px-4 ml-2 w-48 font-bold text-white">#Ferrari</h2>
        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,586 Tweets</p>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</div>
<hr class="border-gray-800">

<!--forth trending tweet-->

<div class="flex">
    <div class="flex-1">
        <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">4 . Auto Racing . Trending</p>
        <h2 class="px-4 ml-2 w-48 font-bold text-white">#vettel</h2>
        <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">9,416 Tweets</p>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
            <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</div>
<hr class="border-gray-800">

<!--show more-->

<div class="flex">
    <div class="flex-1 p-4">
        <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
    </div>
</div>

</div>
    <!--people suggetion to follow section-->
<div class="max-w-sm rounded-lg  bg-dim-700 overflow-hidden shadow-lg m-4">
<div class="flex">
    <div class="flex-1 m-2">
        <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Who to follow</h2>
    </div>
</div>


<hr class="border-gray-800">

<!--first person who to follow-->

<div class="flex flex-shrink-0">
    <div class="flex-1 ">
        <div class="flex items-center w-48">
            <div>
                <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
            </div>
            <div class="ml-3 mt-3">
                <p class="text-base leading-6 font-medium text-white">
                    Sonali Hirave
                </p>
                <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                    @ShonaDesign
                </p>
            </div>
        </div>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" float-right">
            <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                Follow
            </button>
        </a>

    </div>
</div>
<hr class="border-gray-800">

<!--second person who to follow-->

<div class="flex flex-shrink-0">
    <div class="flex-1 ">
        <div class="flex items-center w-48">
            <div>
                <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
            </div>
            <div class="ml-3 mt-3">
                <p class="text-base leading-6 font-medium text-white">
                    Sonali Hirave
                </p>
                <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                    @ShonaDesign
                </p>
            </div>
        </div>

    </div>
    <div class="flex-1 px-4 py-2 m-2">
        <a href="" class=" float-right">
            <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                Follow
            </button>
        </a>

    </div>
</div>

<hr class="border-gray-800">



<!--show more-->

<div class="flex">
    <div class="flex-1 p-4">
        <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
    </div>
</div>

</div>




    <div class="flow-root m-6 inline">
        <div class="flex-1">
            <a href="#">
                <p class="text-sm leading-6 font-medium text-gray-500">Terms Privacy Policy Cookies Imprint Ads info
                </p>
            </a>
        </div>
        <div class="flex-2">
            <p class="text-sm leading-6 font-medium text-gray-600"> © 2020 Twitter, Inc.</p>
        </div>
    </div>
</div>
</div>
                </aside>
            </div>
        </main>

    </div>

</div>






<style>
.overflow-y-auto::-webkit-scrollbar, .overflow-y-scroll::-webkit-scrollbar, .overflow-x-auto::-webkit-scrollbar, .overflow-x::-webkit-scrollbar, .overflow-x-scroll::-webkit-scrollbar, .overflow-y::-webkit-scrollbar, body::-webkit-scrollbar {
display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-y-auto, .overflow-y-scroll, .overflow-x-auto, .overflow-x, .overflow-x-scroll, .overflow-y, body {
-ms-overflow-style: none;
/* IE and Edge */
scrollbar-width: none;
/* Firefox */
}

.bg-dim-700 {
--bg-opacity: 1;
background-color: #192734;
}

html, body {
margin: 0;
background-color: #15202b;
}

svg.paint-icon {
fill: currentcolor;
}

    </style>
@endsection