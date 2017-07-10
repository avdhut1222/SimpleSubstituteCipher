$(document).ready(function(){
    
    $('#decrypt').on('click', function() {
        var cipherForm = document.getElementById("cipherForm");
        var form_data = new FormData(cipherForm);
        form_data.append('cipherType', 'decrypt');
        $.ajax({
                url: '../backend/index.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    $("textarea#outputText").val(response);
                }
        });
    });

    $('#encrypt').on('click', function() {
        var cipherForm = document.getElementById("cipherForm");
        var form_data = new FormData(cipherForm);
        form_data.append('cipherType', 'encrypt');
        $.ajax({
                url: '../backend/index.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    $("textarea#outputText").val(response);
                }
        });
    });

    $('#cipherKey').on('keyup', function(){
        $('#cipherKey').val($('#cipherKey').val().toLowerCase());
    })
});