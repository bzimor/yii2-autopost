$(document).ready(function () {
    function setclass(newclass) {
        $('#sharemsg').removeClass();
        $('#sharemsg').addClass(newclass);
    };
    $("#sharebtn").on("click", function(){
        var title = $('#posttitle').val();
        var message = $('#postmessage').val();
        var link = $('#postlink').val();
        var photo = $('#postphotourl').val();
        setclass('alert alert-success');
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
            if(share > 0){
                $.ajax({
                    method : "POST",
                    url : "autopost/success",
                    data : {
                        share: share,
                        type: $('input[name=posttype]:checked').val(),
                        title: title,
                        message: message,
                        link: link,
                        photo:photo
                    }
                })
                .done(function(msg){
                    setclass('alert alert-success');
                    $("#sharemsg").html(msg);
                    setTimeout(function(){
                        location.reload();
                    }, 3);
                })
                .fail(function(){
                    setclass('alert alert-danger');
                    $("#sharemsg").html("<span>Serverda xatolik</span>");
                });
            }
            else {
                setclass('alert alert-warning');
                $("#sharemsg").html("<span>Biror ijtimoiy tarmoqni belgilang</span>");

            }
        }
        else {
            $('#sharemsg').removeClass();
            $('#sharemsg').addClass('alert alert-warning');
            $("#sharemsg").html("<span>Avval matn kiriting</span>");
        }
    });
})
