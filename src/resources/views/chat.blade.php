<x-app-layout>
    <div class="container">

            <div class="talk">
                @foreach($messages as $message)
                @if($message->send_user_id == $user->id)
                <div class="talk_left">
                    <div class="word-break">
                    <img src="{{ asset('storage/icon/' . $user->icon_image) }}" style="display:inline;position:absolute;" width="40px" height="40px">
                        <div class="break-word">
                            <p>{{ $message->message }}</p>
                        </div>
                        <div style="font-size:6px;text-align:left;">{{ $message->created_at }}</div>
                    </div>
                </div>
                @endif
                @if($message->send_user_id == $login_user->id)
                <div class="talk_right">
                    <div class="word-break" style="margin-left:auto;">
                        <div class="break-word" style="margin-left:auto;">            
                            <p>{{ $message->message }}</p>
                            <img src="{{ asset('storage/icon/' . $login_user->icon_image) }}" style="display:inline;position:absolute;" width="40px" height="40px">
                            <div style="font-size:6px;text-align:right;">{{ $message->created_at }}</div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                

            </div>
        
    </div>
</x-app-layout>