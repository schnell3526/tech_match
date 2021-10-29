const { data } = require("autoprefixer");
const { LazyResult, root } = require("postcss");

Pusher.logToConsole = true;

var pusher = new Pusher('b06be0013eb5f0c6991d', {
    cluster: 'ap3',
    encrypted: true
});

var pusherChannel = pusher.subscribe('tech_match');

pusherChannel.bind('chat_event', function(data) {
    let appendText;
    let login = $('input[name="login_user"]').val();
    if(data.send == login)
    {
        appendText = '<div class="line_right"><div class="text">' + data.message + '</div>'
                    + '<span class="date">' + data.time + '</span></div>';
    }
    else if(data.receive == login)
    {
        appendText = '<div class="line_left"><figure><img src="' + data.icon
                    + '"></figure><div class="line_left-text"><div class="text">' + data.message
                    + '</div><span class="date">' + data.time + '</span></div></div>';
        
    }
    else
    {
        return false;
    }
    

    $("#chat").append(appendText);

    
});


    
    
$('#button_send').on('click', function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });
    $.ajax({
        type: 'post',
        url: '/chat/send',
        dataType: "json",
        data: {
            message: $('input[name="message"]').val(),
            send: $('input[name="send_user"]').val(),
            receive: $('input[name="receive_user"]').val(),
            time: $('input[name="time"]').val(),
            icon: $('input[name="icon"]').val(),
        },
    }).done(function(result){
        $('input[name="message"]').val('');
    }).fail(function(result){
    });
});  