<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $saludo['titulo'] ?? 'Saludo desde Laravel' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 560px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            padding: 36px;
        }

        .header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .icon-badge {
            width: 44px;
            height: 44px;
            background: #fee2e2;
            color: #ef4444;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .title {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
        }

        .message {
            font-size: 16px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 24px;
        }

        .meta-box {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 16px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .meta-value {
            font-weight: 600;
            color: #1e293b;
        }

        .tech-container {
            margin-bottom: 28px;
        }

        .tech-title {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .tech-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tech-badge {
            background: #e2e8f0;
            color: #334155;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        .footer {
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: #94a3b8;
        }

        .author {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            color: #475569;
        }

        .btn-reload {
            background: #0f172a;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-reload:hover {
            background: #334155;
        }
    </style>
</head>
<body>

    <div class="card">
        <!-- Encabezado con Icono y Título -->
        <div class="header">
            <div class="icon-badge">⚡</div>
            <h1 class="title">{{ $saludo['titulo'] ?? '¡Hola desde Laravel!' }}</h1>
        </div>

        <!-- Mensaje principal del controlador -->
        <p class="message">
            {{ $saludo['mensaje'] ?? 'Este mensaje ha sido enviado desde el controlador SaludoController.' }}
        </p>

        <!-- Información del sistema y fecha -->
        <div class="meta-box">
            <div class="meta-item">
                <span class="meta-label">Fecha</span>
                <span class="meta-value">{{ $saludo['fecha'] ?? date('d/m/Y') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Hora</span>
                <span class="meta-value" id="hora-actual">{{ $saludo['hora'] ?? date('H:i:s') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Versión Laravel</span>
                <span class="meta-value">{{ $saludo['version_laravel'] ?? app()->version() }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-label">Versión PHP</span>
                <span class="meta-value">{{ $saludo['version_php'] ?? PHP_VERSION }}</span>
            </div>
        </div>

        <!-- Tecnologías -->
        <div class="tech-container">
            <div class="tech-title">Tecnologías</div>
            <div class="tech-list">
                @foreach($saludo['tecnologias'] ?? ['Laravel', 'PHP', 'Blade'] as $tech)
                    <span class="tech-badge">{{ $tech }}</span>
                @endforeach
            </div>
        </div>

        <!-- Pie de tarjeta con autor y botón -->
        <div class="footer">
            <div class="author">
                <span>🤖</span>
                <span>{{ $saludo['autor'] ?? 'Agente de Laravel' }}</span>
            </div>
            <button class="btn-reload" onclick="location.reload()">Refrescar</button>
        </div>
    </div>

</body>
</html>