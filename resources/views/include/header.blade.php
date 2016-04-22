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
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <p class="navbar-text navbar-right">
@if(Auth::user())

Signed in as <a href="#" class=breadcrumb"> {{Auth::user()->first_name}}</a>
          <a  href="{{route('signout')}}"  class= "breadcrumb">Sign out</a>
<a href="#" class= "breadcrumb">Acount</a>
@endif
      </p>
</div><!-- /.container-fluid -->
</nav>
</header>