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
            $("#votesum-" + $post_id).html(data.sumOfVotes);
            $("#votecount-" + $post_id).html(data.countOfVotes);
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
        url: '/user/subscriptions',
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
}


function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}

// The is activated by the Add Reply link visible on post pages, and displays the reply form.
function showReplyContainer($replyId)
{
// If the replies form is visible, hide it.
    if ($('#reply-container-' + $replyId).length)
    {
        console.log('form is visible');
        $('#reply-container-' + $replyId).remove();
    }
    // if the reply form is not visible, display it.
    else {
        console.log('form is hidden');
        $("#container-" + $replyId).after('<div id="reply-container-' + $replyId + '" style="width: calc(100% - 30pt);">' +
            '    <form class="form" id="form-' + $replyId + '" method="post" action="" onsubmit="postReply(\'' + $replyId + '\', \'' + $userId + '\')">' +
            '        <input type="hidden" name="user_id" value="' + $userId + '">' +
            '        <input type="hidden" name="reply_id" value="' + $replyId + '">' +
            '        <textarea name="content" class="form-control" style="min-height: 80pt; margin-bottom: 3pt;"></textarea>' +
            '        <div style="display:block;">' +
            '            <button class="btn btn-primary" type="submit" style="float:right;">Save</button>' +
            '            <button class="btn btn-secondary" type="reset" style="float:right;">Reset</button>' +
            '        </div>' +
            '    </form>' +
            '</div>');
    }
}

function postReply($replyId, $userId)
{
    event.preventDefault();
    console.log($replyId + $userId);
    postdata = $("#form-" + $replyId).serialize() ;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/reply',
        type: 'post',
        dataType: 'json',
        data: postdata,
        error: function (jqXHR, exception) {
            console.log('error');
            console.log(jqXHR.responseText);
        },
        success: function (data) {
            console.log('success');
            $('#reply-container-' + $replyId).remove();
            $("#container-" + $replyId).after('<ul>' + data.html + '</ul>');
        },
        failure: function (data) {
            console.log('failure');
            console.log(data);
        }
    });
}

function showReportContentModal($content_id, $user_id)
{
    $.get("/modals/report?content_id=" + $content_id + "&user_id=" + $user_id, function (data) {
        $("#modal-stub").append(data);
    });
    $('#reportContent').modal('toggle')
    // Insert hidden input with csrf token embedded
    $("<input>").attr("type", "hidden").attr("name", "_token").attr("id", "token").val($('meta[name="csrf-token"]').attr('content')).appendTo("form");

}