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

function shareLink($post_id){
    var site = $('meta[name="site"]').attr('content');
    const share_box = $("#url-" + $post_id).length;

    if(!share_box) {
        $("#share-" + $post_id).after("<div id=\"url-" + $post_id + "\">\n" +
            "    <input class='shared-link' readonly id=\"link-" + $post_id + "\" type=\"text\" style=\"display: table; padding: 3pt; font-size: 10pt; font-face: fixed;\" value=\"" + site + "/" + $post_id + "\">\n" +
            "</div>");
            var input = document.getElementById('link-' + $post_id);
                input.focus();
                input.select();
    } else {
        $("#url-" + $post_id).remove();
    }
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
            $("#percent-" + $post_id).html(data.percent);
        },
        failure: function (data) {
            console.log(data);
        }
    });
}

function subscribe($content_id, $user_id) {
    var token = $('meta[name="csrf-token"]').attr('content');

    var postdata = {
        _token: token, content_id: $content_id, user_id: $user_id
    };
    $.ajax({
        url: '/user/subscriptions/save',
        type: 'post',
        dataType: 'json',
        data: postdata,
        error: function (jqXHR, exception) {
            console.log(jqXHR.responseText);
        },
        success: function (data) {
            if(data.status == true) {
                $( "button#" + $content_id ).text( 'Subscribed' );
            } else {
                $( "button#" + $content_id ).text( 'Not Subscribed' );
            }
            $( "button#" + $content_id ).toggleClass( "subscribed", "fast" )
        },
        failure: function (data) {
            console.log(data);
        }
    });
}

function getTitle() {
    var token = $('meta[name="csrf-token"]').attr('content');

    var url = $("#url").val();

    var postdata = {
        _token: token, url: url
    };

    console.log(postdata);
    if(!isUrl(url)) {
        console.log('not a url');
        return;
    } else {
        $.ajax({
            url: '/post/url/ajax',
            type: 'post',
            dataType: 'json',
            data: postdata,
            error: function (jqXHR, exception) {
                console.log('error');
                console.log(jqXHR.responseText);
            },
            success: function (data) {
                console.log('success');
                $("#title").val(data.title);
            },
            failure: function (data) {
                console.log('failure');
                console.log(data);
            }
        });
    };


    // var postdata = {
    //     _token: token, address: $content_id, user_id: $user_id
    // };
    // $.ajax({
    //     url: '/p/create/get-title',
    //     type: 'post',
    //     dataType: 'json',
    //     data: postdata,
    //     error: function (jqXHR, exception) {
    //         console.log(jqXHR.responseText);
    //     },
    //     success: function (data) {
    //         if(data.status == true) {
    //             $( "button#" + $content_id ).text( 'Subscribed' );
    //         } else {
    //             $( "button#" + $content_id ).text( 'Not Subscribed' );
    //         }
    //         $( "button#" + $content_id ).toggleClass( "subscribed", "fast" )
    //     },
    //     failure: function (data) {
    //         console.log(data);
    //     }
    // });
}


function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}