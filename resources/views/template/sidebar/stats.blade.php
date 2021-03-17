<div class="row side-col-panel">
    <h5 class="col-12">
        Site Statistics
    </h5>
    <div class="col-12">
        Users:  {{ count( \App\Models\User::all()) }}
    </div>
    <div class="col-12">
        Channels:  {{ count( \App\Models\Content::where('type', '=', 'channel')->get() ) }}
    </div>
    <div class="col-12">
        Posts:  {{ count( \App\Models\Content::where('type', '=', 'post')->get() ) }}
    </div>
    <div class="col-12">
        Replies: {{ count( \App\Models\Content::where('type', '=', 'reply') ->get() ) }}
    </div>
</div>
