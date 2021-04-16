$( document ).ready(function() {
    console.log(visit_id)
});

setInterval(function () {
    $.get("/heartbeat?id=" + visit_id, null, function (data) {
        console.log(data);
    });
}, 10000);
