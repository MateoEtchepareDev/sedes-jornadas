<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificado de Participación</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f5f5f5;
        }
        .certificate {
            background-color: white;
            padding: 60px;
            max-width: 900px;
            margin: 0 auto;
            border: 2px solid #333;
            text-align: center;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .header {
            margin-bottom: 40px;
        }
        .header h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 40px 0;
        }
        .intro {
            font-size: 16px;
            color: #333;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .participant-name {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a1a;
            margin: 30px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .event-details {
            font-size: 16px;
            color: #555;
            margin: 30px 0;
            line-height: 1.8;
        }
        .event-details p {
            margin: 10px 0;
        }
        .footer {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 30px;
            font-size: 12px;
            color: #888;
        }
        .date {
            margin-top: 10px;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <h1>Certificado de Participación</h1>
            <p>Este documento certifica que</p>
        </div>

        <div class="content">
            <div class="participant-name">
                {{ $participant->full_name }}
            </div>

            <div class="intro">
                ha participado satisfactoriamente en el evento:
            </div>

            <div class="event-details">
                <p><strong>{{ $participant->event->title }}</strong></p>
                <p>Realizado el {{ \Carbon\Carbon::parse($participant->event->event_starts_at)->format('d \\d\\e F \\d\\e Y') }}</p>
            </div>
        </div>

        <div class="footer">
            <div class="date">
                Emitido: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
            </div>
        </div>
    </div>
</body>
</html>