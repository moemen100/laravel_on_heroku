<header>
    <input id="url" type="hidden" value="{{route('notifications')}}">
    <input id="homeImage" type="hidden" value="image_path">
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if(Auth::user()!=null)
                    <a class="navbar-brand" href="{{route('dashboard')}}">Dummy Wep</a>
                    <form class="navbar-form navbar-left" method="get" action="{{route("search")}}" role="search">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                @endif
                @if(Auth::user()==null)
                    <a class="navbar-brand">Dummy Wep</a>
                @endif
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(Auth::user())
                    <?php
                    $notifications = \App\Helpers\CommonHelper::getNotification(Auth::User());
                    ?>
                    <p class="navbar-text navbar-right">
                        Signed in as <a href="{{route('dashboard')}}" class=breadcrumb"> {{Auth::user()->first_name}}
                            <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span></a>
                        <a href="{{route('signout')}}" class="breadcrumb">Sign out <span
                                    class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
                        <a href="{{route('account')}}" class="breadcrumb">Account <span class="glyphicon glyphicon-plus"
                                                                                        aria-hidden="true"> </span></a>
                        <a href="{{route('friends.requests')}}" class="breadcrumb">friends request <span
                                    class="glyphicon glyphicon-plus"
                                    aria-hidden="true"> </span></a>
                    </p>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown notifications-menu">
                            <a href="#" id="showNotifications" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-bell"></i>
                                <span id="notification-counter"
                                      class="label label-warning">{{count($notifications)>0?count($notifications)>99?'99+':count($notifications):''}}</span>
                            </a>
                            <ul class="dropdown-menu">

                                <li class="header"> {{count($notifications)}} new notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="notification-wrap">
                                        @foreach($notifications as $notification)
                                            <li>
                                                <a class="notifications-tag"
                                                   data-notification-message="{{$notification->notification}}"
                                                   data-notification="{{$notification->id}}"
                                                   @if($notification->url)href="{{$notification->url}}@endif">
                                                    <i class="{{$notification->icon}}"></i>{{$notification->notification}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{ route('notifications')}}">View all</a></li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div><!-- /.container-fluid -->
        </div>
    </nav>
</header>
<?php
$authUser = 0;
if (Auth::user())
    $authUser = Auth::user()->id;
?>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script>

    Pusher.log = function (msg) {
        console.log(msg);
    };
    var pusher = new Pusher("{{env("PUSHER_KEY")}}");
    var channel = pusher.subscribe('notifications');
    channel.bind('new_friend_request', function (data) {
        if (data.message.user_id == "{{$authUser}}") {
            $("#notification-wrap").append(" <li> <a class=\"notifications-tag\"data-notification-message=\"" + data.message.notification + "\"data-notification=\"" + data.message.id + "\"" + "href=\"" + data.message.url + "\"> <i class=\"" + data.message.icon + "\"></i>" + data.message.notification + "</a> </li>");
            var counter = $("#notification-counter").html();
            if (!counter) {
                $("#notification-counter").html(1);
            } else {
                $("#notification-counter").html(parseInt(counter) + 1);
            }
            if (window.Notification && Notification.permission !== "denied") {
                var text = data.message.notification;
                Notification.requestPermission(function (status) {
                    var n = new Notification('You have new notifications', {
                        body: text,
                        icon: $('#homeImage').val()
                    });
                });
            }
            var notificationButton = $('#showNotifications');
            var notificationSeen = false;
            var ajaxUrl = $('#url');
            var notificationListUrl = ajaxUrl.find('+ input').val();
            ajaxUrl = ajaxUrl.val();
            notificationButton.on('click', function () {
                var notifications = [];
                var notificationsCounter = 0;
                if (notificationSeen)
                    notificationButton.siblings().first().children().first().html('You have 0 new notifications');
                $('.notifications-tag').each(function () {
                    notifications[notificationsCounter] = $(this).data('notification');
                    notificationsCounter++;
                });

                if (notificationsCounter > 0 && !notificationSeen) {
                    $.ajax({
                        type: "get",
                        url: ajaxUrl,
                        data: {notifications: notifications},
                        success: function (data) {
                            notificationButton.children().last().html('');
                            notificationSeen = true;
                        }
                    });
                }
            });
        }
    });

</script>