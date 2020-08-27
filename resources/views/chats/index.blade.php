@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="chat-content">
                    @foreach($chats as $chat)
                    
                        <div class="card">
                            <p>
                                <strong> {{ $chat->author }}:</strong>
                                {{ $chat-> content }}
                            </p>
                        </div>
                    @endforeach
                    </div>
                    
                    <form id="chat" name="chat-form">
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <input id="msg" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required autocomplete="content" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="submit-chat" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> //Received

    var user = "{{ $user->name }}"
    var socket = io('http://localhost:6002')
    jQuery(document).ready(($) => {
        $('#submit-chat').click(() => {
            if($('#msg').val() != ''){  
                let data = {
                    author: "{{ $user->name }}",
                    message: $('#msg').val()
                }
                socket.emit('sentMessage', data)
                $('#msg').val('');
            }
            
            return false;
        })
        
        socket.on('receivedMessage', function(data){
            console.log(`received message at server!`)
            $('.chat-content').append('<div class="card"><p><strong>' + data.author + ': </strong>' + data.message + '</p></div>')
        })
    });

</script>