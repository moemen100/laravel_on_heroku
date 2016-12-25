$(document).ready(function () {
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
  
        

});

