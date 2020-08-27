<div class="chat-content">
                        <div></div>
                    </div>
                    
                    <form>
                        <input id="msg" type="text" class="form-control @error('content') is-invalid @enderror" required>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="submit-chat" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> //Received
    var socket = io('http://localhost:6002')
    jQuery(document).ready(($) => {
        $('#submit-chat').click(() => {
            if(!$('#msg').val())  {}
            else socket.emit('sentMessage', $('#msg').val())
        })
        
        socket.on('receivedMessage', function(msg){
            console.log(`received message ${msg} at server!`)
            $('.chat-content div').append('<div class="card"><p><strong></strong>' + msg + '</p></div>')
        })
    });

</script>