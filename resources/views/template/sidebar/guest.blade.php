<div class="row side-col-panel">
    <h5 class="col-12">
        Sign into your account.
    </h5>
    <form method="post" action="/login">
        <div class="col-12">
            Signing into your account lets you post, reply to posts, and create channels of your own.
        </div>
        @csrf
        <div class="col-12">
            <input name="current" type="hidden" value="{{ url()->full() }}">
        </div>
        <div class="col-12">
            <input name="username" type="text" class="form-control" placeholder="Username or Email">
        </div>
        <div class="col-12">
            <input name="password" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="col-12 text-center">
            <input style="height: 14pt;" class="form-check-input" type="checkbox" name="remember"  value="" id="defaultCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>

