$(document).ready(function () {
    $("#sharebtn").on("click", function(){
        var message = $('#postmessage').val();
        var link = $('#postlink').val();
        var photo = $('#postphotourl').val();

        $("#sharemsg").html("<span>Кутинг...</span>");
        if (message != '' || link != ''|| photo != ''){
            var share = 0;
            if ($('#tgcheck').is(':checked')) {
                share += 1;
            }
            if ($('#fbcheck').is(':checked')) {
                share += 2;
            }
            if ($('#twcheck').is(':checked')) {
                share += 4;
            }
            $.ajax({
                method : "POST",
                url : "autopost/success",
                data : {
                    share: share,
                    type: $('input[name=posttype]:checked').val(),
                    message: message,
                    link: link,
                    photo:photo
                }
            })
            .done(function(msg){
                $('#sharemsg').removeClass();
                $('#sharemsg').addClass('alert alert-success');
                $("#sharemsg").html(msg);
            });
        }
        else {
            $("#sharemsg").html("<span>Avval matn kiriting</span>");
        }
    });
})
