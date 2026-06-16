<!-- resources/views/certificates/template.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

</head>
<body>

<div class="container">
    <h1>Certificate of Completion</h1>

    <p>This certifies that</p>

    <h2>{{ $participant->name }}</h2>

    <p>has successfully completed</p>

    <h3>{{ $event->title }}</h3>

    <p>{{ $event->event_ends_at }}</p>
</div>

</body>
</html>