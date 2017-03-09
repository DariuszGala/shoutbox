$(document).ready(function() {
    document.addEventListener('keydown', function(event) {
        if(event.keyCode == 115) Shoutbox.del();
    });

    var canSend = true;
    
    $('form').on('submit', function(e) {
        e.preventDefault();
        if(canSend) {
            Shoutbox.post($(this));
            canSend = false;
        } else {
            alert('Please wait 5s');
        };
        $('textarea').val("");
        setTimeout(function() {
            canSend = true;
        }, 5000);         
     });  
   
    setInterval(function(){
        Shoutbox.get();
    }, 1000);
    
    let Shoutbox = {
        get: function() {
            $.ajax({
                type: 'get',
                url: 'api.php',
                dataType: 'json',
                success: function(response) {                
                    let fragment = document.createDocumentFragment();
                    $.each(response, function(num, post) {  
                        let li = document.createElement('li');
                        li.innerHTML += '<p>@'+post['nick']+'</p>'+
                                        '<p>'+post['date']+'</p>'+
                                        '<p>'+post['message']+'</p>';

                        fragment.appendChild(li);
                    });
                    document.querySelector(".content").innerHTML = '';
                    document.querySelector(".content").appendChild(fragment);
                }
            });
        },
        
        post: function(form) {
            $.ajax({
                type: 'post',
                url: 'api.php',
                data: form.serializeArray(),
                dataType: 'json'
            });
        },
        
        del: function() {
            $.ajax({
                type: 'delete',
                url: 'api.php',
            });
        }
    }; 
});