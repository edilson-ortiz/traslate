'
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            text-align: justify;
            margin: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="title">{{ $document->nombre }}</div>
    <div class="content">
        {{ $document->context }}
    </div>
</body>

</html>
