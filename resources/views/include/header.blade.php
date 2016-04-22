<header>
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @if(Auth::user()!=null)

      <a class="navbar-brand" href="{{route('dashboard')}}">Brand</a>
    @endif
      @if(Auth::user()==null)

        <a class="navbar-brand" >Brand</a>
      @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <p class="navbar-text navbar-right">
@if(Auth::user())

Signed in as <a href="{{route('dashboard')}}" class=breadcrumb"> {{Auth::user()->first_name}}</a>
          <a  href="{{route('signout')}}"  class= "breadcrumb">Sign out</a>
<a href="{{route('account')}}" class= "breadcrumb">Account</a>
@endif
      </p>
</div><!-- /.container-fluid -->
</nav>
</header>