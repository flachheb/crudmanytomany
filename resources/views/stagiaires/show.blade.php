<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Stagiaire</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header h1 {
            color: white;
            font-size: 32px;
        }

        .action-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-links a {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 14px;
        }

        .action-links a:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
            padding: 40px;
        }

        .photo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .photo-container img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #667eea;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .photo-empty {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #f5f5f5 0%, #eeeeee 100%);
            border-radius: 10px;
            border: 3px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .info-label {
            color: #999;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .badge {
            display: inline-block;
            background: #e8f4f8;
            color: #0084b4;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 24px;
            }

            .card-content {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 25px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $stagiaire->firstname }} {{ $stagiaire->lastname }}</h1>
            <div class="action-links">
                <a href="{{ route('stagiaires.index') }}">← Retour à la liste</a>
                <a href="{{ route('stagiaires.edit', $stagiaire) }}">✎ Modifier</a>
                <a href="{{ route('stagiaires.attachModules', $stagiaire) }}">📚 Modules</a>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="photo-container">
                    @if($stagiaire->photo)
                        <img src="{{ asset('storage/' . $stagiaire->photo) }}" alt="Photo de {{ $stagiaire->firstname }}">
                    @else
                        <div class="photo-empty">📷 Pas de photo</div>
                    @endif
                    <span class="badge">Stagiaire</span>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Prénom</div>
                        <div class="info-value">{{ $stagiaire->firstname }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Nom</div>
                        <div class="info-value">{{ $stagiaire->lastname }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">CEF</div>
                        <div class="info-value">{{ $stagiaire->cef }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value"><a href="mailto:{{ $stagiaire->email }}" style="color: #667eea; text-decoration: none;">{{ $stagiaire->email }}</a></div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Téléphone</div>
                        <div class="info-value">{{ $stagiaire->phone ?? '—' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Ville</div>
                        <div class="info-value">{{ $stagiaire->city ?? '—' }}</div>
                    </div>

                    <div class="info-item full-width">
                        <div class="info-label">Adresse</div>
                        <div class="info-value">{{ $stagiaire->address ?? '—' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Date de naissance</div>
                        <div class="info-value">{{ $stagiaire->date_of_birth ? \Carbon\Carbon::parse($stagiaire->date_of_birth)->format('d/m/Y') : '—' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Inscrit le</div>
                        <div class="info-value">{{ $stagiaire->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
