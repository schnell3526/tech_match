<x-app-layout>
    <div class="container">
            <div class="line_container">
                <div class="line_title">
                    {{ $user->nickname }}
                </div>
                <div class="line_contents scroll" id="chat">
                @foreach($messages as $message)
                    @if($message->send_user_id == $user->id)
                    <div class="line_left">
                        <figure>
                            <img src="{{ asset('storage/icon/' . $user->icon_image) }}">
                        </figure>
                        <div class="line_left-text">
                            <div class="text">{{ $message->message }}</div>
                            <span class="date">{{ $message->created_at }}</span>
                        </div>
                    </div>
                    @endif
                    @if($message->send_user_id == $login_user->id)
                    <div class="line_right">
                        <div class="text">{{ $message->message }}</div>
                        <span class="date">{{ $message->created_at }}</span>
                    </div>
                    @endif
                @endforeach
                </div>
            </div> 
            <div style="margin:50px 200px;">
                
                    <input id="messagebox" name="message" type="text" style="width:700px; height:40px;" />
                    <button type="button" id="button_send">
                        送信
                    </button>
                
                <input type="hidden" name="send_user" value="{{ Auth::id() }}">
                <input type="hidden" name="receive_user" value="{{ $user->id }}">
                <input type="hidden" name="login_user" value="{{ Auth::id() }}">
                <input type="hidden" name="time" value="{{ \Carbon\Carbon::now() }}">
                <input type="hidden" name="icon" value="{{ asset('storage/icon/' . Auth::user()->icon_image) }}">
            </div>
    </div>
    
    <script type="text/javascript" src="{{ mix('js/chat.js') }}"></script>
</x-app-layout>