$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
});
$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chat_window_1" ).remove();
});



$(function(){
    $("#message").ready(function(){
        setInterval(function(){getMessages()},100);
    })
})

function getMessages(){

    var req = new XMLHttpRequest();
    let obj;
        
    req.onreadystatechange = function(){
    
    if(req.readyState == 4 && req.status == 200){
        $("#message").html(req.responseText);
    } 
    }
    // here it is send request to chat.php page to get the data from db

    req.open('GET','process.php?getMessage=',true); 
    req.send();
    $('#message').scrollTop($('#message')[0].scrollHeight - $('#message')[0].clientHeight);



    // $.ajax({
    //     url: "process.php",
    //     type: "POST",
    //     data: {getMessage: "qwe"},
    //     success: function(dataret,status){
    //         let obj = jQuery.parseJSON(dataret);
    //        $.each(obj, function(i, item) {
    //             if(item.type == 1){
    //                 createHTML(item.message);
    //             }else{
    //                 createHTMLSender(item.message);
    //             }
    //         })
    //     }
    // });
    // setTimeout(getMessages, 1000);
}

$(function(){
    let form
    $("#sendChat").bind({
        submit: function(event){
            form = $(this).serialize();
            event.preventDefault();
            if($("input[name=message]").val() != ""){
                $.ajax({
                    url: "process.php",
                    type: "POST",
                    data: form,
                    success: function(dataRet,statusRet){
                        let obj = jQuery.parseJSON(dataRet);
                        if(isNaN((obj.return.id))){
                            alert(obj.return.id);
                        }
                    }
                });
                $("input[name=message]").val("");
            }
        }
    });
});

