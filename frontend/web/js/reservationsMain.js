$(function(){

    $('#reservationsButton').click(function(){
        $('#modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

});