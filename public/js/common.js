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
