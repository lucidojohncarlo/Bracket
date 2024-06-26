<?php
// load_calendar.php

include 'config.php';

// Your load calendar logic goes here

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Load Calendar</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- FullCalendar CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
</head>
<body>
   <h1>Load Calendar Page</h1>
   <!-- Your content goes here -->
   <!-- Main Content -->
         <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="content">
               <!-- Your content goes here -->
               <h2>Calendar</h2>
               <div id="calendar"></div>
            </div>
         </main>
      </div>
   </div>

   <!-- Bootstrap JS and dependencies -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- FullCalendar JS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

   <script>
      $(document).ready(function() {
         $('#calendar').fullCalendar({
            header: {
               left: 'prev,next today',
               center: 'title',
               right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2024-01-01',
            editable: false,
            eventLimit: true,
            events: [
               {
                  title: 'Meeting',
                  start: '2024-01-01T10:00:00',
                  end: '2024-01-01T12:00:00'
               },
               {
                  title: 'Deadline',
                  start: '2024-01-05',
                  end: '2024-01-05'
               },
               // Add more events as needed
            ]
         });
      });

      // Toggle logout button visibility
      $('#header-right').click(function() {
         $('#logoutBtn').toggle();
      });
   </script>
</body>
</html>
