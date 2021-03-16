$(document).ready(function(){
    var replaced = $("body").html().replace(/\$([a-zA-Z]+)\b/g,
    '<a href="https://finance.yahoo.com/quote/$1">\$1</a>');
    $("body").html(replaced);
});

function copyHashId(){
    document.getElementById("currentShortUrl").select();
    document.execCommand('copy');
}

function readmore($id){
    $( "div#" + $id ).toggleClass( "content-hidden" )
}

function showCommentArea($id){
    $( "#" + $id).toggleClass("display-none");
    $( "#hide-" + $id).toggleClass("display-none");
    $( "#show-" + $id).toggleClass("display-none");

}

function upvote($post_id, $user_id, $direction) {

    var token = $('meta[name="csrf-token"]').attr('content');

    var postdata = {
        _token: token, content_id: $post_id, user_id: $user_id, direction: $direction
    };

    console.log(postdata);

    $.ajax({
        url: '/vote',
        type: 'post',
        dataType: 'json',
        data: postdata,
        error: function (jqXHR, exception) {
            console.log(jqXHR.responseText);
        },
        success: function (data) {
            console.log(data);
            $("span#votes-" + $post_id).html(data.new_vote_total);
        },
        failure: function (data) {
            console.log(data);
        }
    });
}
