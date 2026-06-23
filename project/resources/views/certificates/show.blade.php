<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            padding: 60px;
        }
        h1 { font-size: 32px; margin-bottom: 10px; }
        h2 { font-size: 26px; margin: 20px 0; }
        h3 { font-size: 20px; }
        .label { color: #555; font-size: 14px; }
    </style>
</head>
<body>

    <h1>Certificate of Completion</h1>

    <p class="label">This certifies that</p>

    <h2>{{ $participant->full_name }}</h2>

    <p class="label">has successfully completed</p>

    <h3>{{ $participant->event->name }}</h3>

    <p>{{ \Carbon\Carbon::parse($participant->event->event_ends_at)->format('F j, Y') }}</p>

</body>
</html>