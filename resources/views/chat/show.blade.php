<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js"></script>
    <script src="{{ mix('js/firebase.js') }}"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <link href="./output.css" rel="stylesheet">

    <title>Home</title>
</head>
<body style="background-color: #15202b;" class="font-sans flex flex-col min-h-screen">
    <div class="flex flex-grow">
        <x-left-menu :user="$user" class="w-1/4 bg-[#1f2937] p-4 text-white shadow-lg" />
    
        <div class="flex-1 flex flex-col bg-[#1c2a36] p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-white mb-6">@lang('messages.chat')</h2>
    
            <div class="flex-1 overflow-y-auto bg-[#253341] p-6 rounded-lg space-y-4 shadow-inner">
                @foreach ($messages as $msg)
                    @php
                        $isSender = $msg->sender_id == auth()->id();
                    @endphp
                    <div class="flex items-start {{ $isSender ? 'flex-row-reverse text-right' : 'flex-row text-left' }}">
                        <div class="flex-shrink-0 {{ $isSender ? 'ml-3' : 'mr-3' }}">
                            <img src="{{ $msg->sender->image_url ?? 'https://via.placeholder.com/32' }}" alt="Avatar" class="w-8 h-8 rounded-full">
                        </div>
    
                        <div>
                            <div class="p-3 rounded-lg max-w-md break-words 
                                {{ $isSender ? 'bg-blue-600 text-white' : 'bg-gray-200 text-black' }}">
                                {{ $msg->message }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1 {{ $isSender ? 'text-left' : 'text-right' }}">
                                {{ $msg->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    
            <form action="{{ route('chat.send') }}" method="POST" class="flex gap-3 mt-4">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <input type="text" name="message"
                    class="flex-1 bg-[#2d3748] text-white border border-gray-600 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    placeholder="@lang('messages.write message')">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg flex items-center justify-center transition-colors duration-200">
                    <span>@lang('messages.send')</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                        </path>
                    </svg>
                </button>
                @error('recevier_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
</body>
</html>