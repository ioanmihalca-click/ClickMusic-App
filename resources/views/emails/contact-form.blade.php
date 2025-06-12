<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj nou de contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #3B82F6, #1E40AF);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .field {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8fafc;
            border-left: 4px solid #3B82F6;
            border-radius: 4px;
        }

        .field-label {
            font-weight: bold;
            color: #1E40AF;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .field-value {
            color: #374151;
            font-size: 14px;
        }

        .message-content {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 15px;
            white-space: pre-wrap;
            line-height: 1.6;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .timestamp {
            color: #9ca3af;
            font-style: italic;
            text-align: right;
            margin-top: 15px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📧 Mesaj nou de contact</h1>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">Click Music - Formular de contact</p>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">👤 Nume</div>
                <div class="field-value">{{ $contactData['name'] }}</div>
            </div>

            <div class="field">
                <div class="field-label">📧 Email</div>
                <div class="field-value">
                    <a href="mailto:{{ $contactData['email'] }}" style="color: #3B82F6; text-decoration: none;">
                        {{ $contactData['email'] }}
                    </a>
                </div>
            </div>

            <div class="field">
                <div class="field-label">📝 Subiect</div>
                <div class="field-value">{{ $contactData['subject'] }}</div>
            </div>

            <div class="field">
                <div class="field-label">💬 Mesaj</div>
                <div class="message-content">{{ $contactData['message'] }}</div>
            </div>

            <div class="timestamp">
                Primit pe: {{ now()->format('d.m.Y la H:i') }}
            </div>
        </div>

        <div class="footer">
            <p>Acest email a fost trimis prin formularul de contact de pe <strong>clickmusic.ro</strong></p>
            <p>Pentru a răspunde, folosește adresa: {{ $contactData['email'] }}</p>
        </div>
    </div>
</body>

</html>
