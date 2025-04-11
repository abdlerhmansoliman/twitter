@if($newMessagesCount > 0)
    <div class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center animate-bounce shadow-md ring-2 ring-white">
        {{ $newNotitificationsCount }}
    </div>
@endif