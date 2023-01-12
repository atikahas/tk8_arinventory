<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>Booking</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
        <link href="{{url('')}}/sleek/source/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
        <link href="{{url('')}}/sleek/theme/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
        <link id="sleek-css" rel="stylesheet" href="{{url('')}}/sleek/theme/assets/css/sleek.css" />
        <link href="{{url('')}}/sleek/arlogo/ar-logo.png" rel="shortcut icon" />
        <link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.css" rel="stylesheet">
        <link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="content" style="padding:0px">
            <div class="row" style="height: 798.25px;">
                <div class="col-12" style="height: 798.25px;">
                <div class="card card-default" style="margin:0px">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{url('')}}/sleek/theme/assets/plugins/jquery/jquery.min.js"></script>
        <script src="{{url('')}}/sleek/theme/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.min.js"></script>
        <script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var year = new Date().getFullYear()
                var month = new Date().getMonth() + 1
                function n(n){
                    return n > 9 ? "" + n: "0" + n;
                }
                var month = n(month)

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'dayGrid' ],
                    defaultView: 'dayGridMonth',
                    displayEventTime: false,
                    events: {!!json_encode($arrbooking)!!},
                });

                calendar.render();
            });
        </script>
    </body>
</html>