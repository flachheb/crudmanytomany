<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Module</title>
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
            max-width: 1000px;
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

        .info-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin-bottom: 30px;
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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
            font-size: 18px;
            font-weight: 600;
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

        .section-title {
            color: #333;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .stagiaires-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .stagiaires-table thead {
            background: #f9f9f9;
        }

        .stagiaires-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #ddd;
        }

        .stagiaires-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .stagiaires-table tbody tr:hover {
            background: #f0f0f0;
        }

        .view-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .empty-message {
            padding: 30px;
            text-align: center;
            color: #999;
            background: #f9f9f9;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 24px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .stagiaires-table {
                font-size: 13px;
            }

            .stagiaires-table th,
            .stagiaires-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $module->code }} - {{ $module->title }}</h1>
            <div class="action-links">
                <a href="{{ route('modules.index') }}">← Retour à la liste</a>
                <a href="{{ route('modules.edit', $module) }}">✎ Modifier</a>
                <a href="{{ route('modules.attachStagiaires', $module) }}">👥 Stagiaires</a>
            </div>
        </div>

        <div class="info-card">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Code</div>
                    <div class="info-value">{{ $module->code }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Titre</div>
                    <div class="info-value">{{ $module->title }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">MHP (Heures Pratique)</div>
                    <div class="info-value">{{ $module->MHP }} h</div>
                </div>

                <div class="info-item">
                    <div class="info-label">MHS (Heures Synthèse)</div>
                    <div class="info-value">{{ $module->MHS }} h</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Total Heures</div>
                    <div class="info-value">{{ $module->MHP + $module->MHS }} h</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Stagiaires inscrits</div>
                    <div class="info-value">
                        <span class="badge">{{ $module->stagiaires()->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h2 class="section-title">👥 Stagiaires inscrits</h2>

            @if($module->stagiaires()->count() > 0)
                <table class="stagiaires-table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>CEF</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($module->stagiaires as $stagiaire)
                            <tr>
                                <td>{{ $stagiaire->firstname }}</td>
                                <td>{{ $stagiaire->lastname }}</td>
                                <td><strong>{{ $stagiaire->cef }}</strong></td>
                                <td>{{ $stagiaire->email }}</td>
                                <td>
                                    <a href="{{ route('stagiaires.show', $stagiaire) }}" class="view-link">Voir le profil →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-message">
                    📭 Aucun stagiaire n'est encore inscrit à ce module.
                </div>
            @endif
        </div>
    </div>
</body>
</html>
