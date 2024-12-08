<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subject }}</title>
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <style>
        .body {
            font-family: 'Press Start 2P', sans-serif;
        }
    </style>
</head>
<body>
    <div style="background-color: #f5f5f5; padding: 20px;">
        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="background-color: #ffffff; border-radius: 5px;">
            <tr>
                <td style="padding: 20px;">
                    <h1 style="color: #333333;">Thank you for shopping at Pony.bit!</h1>
                    <p>Hello {{ $name }},</p> 
                    <p>We are pleased to inform you that your order has been received and is being processed.</p>
                    
                    <p>You can view the order details <a href="http://127.0.0.1:8000/bills/{{ $billId }}">here</a>.</p> 
                    
                    <p>Thank you for trusting and choosing Pony.bit!</p>
                    <p>Sincerely,</p>
                    <p>The Pony.bit Team</p>                    
                </td>
            </tr>
        </table>
    </div>
</body>
</html>