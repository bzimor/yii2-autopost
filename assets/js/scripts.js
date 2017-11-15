$(document).ready(function () {
    $("#sharebtn").on("click", function(){
        var image = $('#postimage').val();
        $("#sharemsg").html("<span>Кутинг...</span>");
        if ($("#postmessage").html() != '' || image != ''){
            $.ajax({
                method : "POST",
                url : "success",
                data : {
                    message: $("#postmessage").html(),
                    photo:image
                }
            })
            .done(function(msg){
                $("#sharemsg").html(msg);
            });
        }
        else {
            $("#sharemsg").html("<span>Аввал маколани сакланг</span>");
        }
    });

    $(".btn-change").on("click", function() {
        var apitype = $(this).data('id');
        api_inputs(apitype);
        $('#status select').val($('#'+apitype+'-status').data('id'));
        $('#posttype select').val($('#'+apitype+'-posttype').data('id'));
        $('#bottomtext').val($('#'+apitype+'-bottomtext').html());
        if ( apitype == 'tg') {
            $('#channelid').val($('#tg-channelid').html());
            $('#bottoken').val($('#tg-bottoken').html());
        }
        else if (apitype == 'fb') {
            $('#pageid').val($('#fb-pageid').html());
            $('#apiid').val($('#fb-apiid').html());
            $('#apisecret').val($('#fb-apisecret').html());
            $('#apiver').val($('#fb-apiver').html());
            $('#accesstoken').val($('#fb-accesstoken').html());
        }
        else {
            $('#apiid').val($('#tw-apiid').html());
            $('#apisecret').val($('#tw-apisecret').html());
            $('#accesstoken').val($('#tw-accesstoken').html());
            $('#tokensecret').val($('#tw-tokensecret').html());
        }
    });

    function api_inputs(apiname) {
        $('#api-type').val(apiname);
        $('.toggleable').addClass('hidden');
        $('.'+apiname).removeClass('hidden');
    }
})
