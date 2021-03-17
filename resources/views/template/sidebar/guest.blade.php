<div class="row side-col-panel">
    <form class="form-control" method="post" action="/login">
        <p>Signing into your account lets you post, reply to posts, and create channels of your own.</p>
        @csrf
        <input name="current" type="hidden" value="{{ url()->full() }}">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Username or Email Address">
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-check">
            <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>