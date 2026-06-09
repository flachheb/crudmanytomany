<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attacher des stagiaires</title>
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
            max-width: 800px;
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

        .back-link {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .back-link:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .form-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
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

        .module-info {
            background: #f0f0f0;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 30px;
        }

        .module-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .module-code {
            font-size: 13px;
            color: #999;
            margin-top: 5px;
        }

        .stagiaires-list {
            margin-bottom: 30px;
        }

        .stagiaires-list h3 {
            color: #333;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .checkbox-group::-webkit-scrollbar {
            width: 8px;
        }

        .checkbox-group::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .checkbox-group::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 6px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-item:hover {
            background: #f0f0f0;
            border-color: #667eea;
        }

        .checkbox-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-right: 15px;
            accent-color: #667eea;
        }

        .checkbox-item input[type="checkbox"]:checked + .item-label {
            font-weight: 600;
            color: #667eea;
        }

        .item-label {
            flex: 1;
            cursor: pointer;
        }

        .stagiaire-name {
            color: #333;
            font-weight: 500;
            font-size: 15px;
        }

        .stagiaire-cef {
            color: #999;
            font-size: 12px;
            margin-top: 3px;
        }

        .stagiaire-email {
            color: #667eea;
            font-size: 12px;
            margin-top: 3px;
        }

        .selected-count {
            display: inline-block;
            background: #e8f4f8;
            color: #0084b4;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 15px;
            margin-top: 30px;
        }

        .submit-btn,
        .cancel-btn {
            padding: 14px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .cancel-btn {
            background: #e0e0e0;
            color: #333;
        }

        .cancel-btn:hover {
            background: #d0d0d0;
        }

        .empty-message {
            padding: 30px;
            text-align: center;
            color: #999;
            background: #f9f9f9;
            border-radius: 8px;
        }

        @media (max-width: 600px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 24px;
            }

            .form-card {
                padding: 25px 20px;
            }

            .button-group {
                grid-template-columns: 1fr;
            }

            .checkbox-item {
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Attacher des stagiaires</h1>
            <a href="{{ route('modules.show', $module) }}" class="back-link">← Retour</a>
        </div>

        <div class="form-card">
            <div class="module-info">
                <div class="module-name">{{ $module->code }} - {{ $module->title }}</div>
                <div class="module-code">{{ $module->MHP }}h pratique + {{ $module->MHS }}h synthèse</div>
            </div>

            @if($stagiaires->count() > 0)
                <form action="{{ route('modules.storeStagiaires', $module) }}" method="POST">
                    @csrf

                    <div class="stagiaires-list">
                        <h3>👥 Stagiaires <span class="selected-count" id="selectedCount">0 sélectionnés</span></h3>
                        <div class="checkbox-group">
                            @foreach($stagiaires as $stagiaire)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="stagiaires[]" value="{{ $stagiaire->id }}"
                                        {{ in_array($stagiaire->id, $attachedStagiaires) ? 'checked' : '' }}
                                        onchange="updateSelectedCount()">
                                    <div class="item-label">
                                        <div class="stagiaire-name">{{ $stagiaire->firstname }} {{ $stagiaire->lastname }}</div>
                                        <div class="stagiaire-cef">CEF: {{ $stagiaire->cef }}</div>
                                        <div class="stagiaire-email">{{ $stagiaire->email }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="submit-btn">✓ Enregistrer les stagiaires</button>
                        <a href="{{ route('modules.show', $module) }}" class="cancel-btn">Annuler</a>
                    </div>
                </form>
            @else
                <div class="empty-message">
                    📭 Aucun stagiaire disponible. Veuillez d'abord créer des stagiaires.
                </div>
            @endif
        </div>
    </div>

    <script>
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('input[name="stagiaires[]"]:checked');
            const countElement = document.getElementById('selectedCount');
            const count = checkboxes.length;
            countElement.textContent = count + ' sélectionné' + (count > 1 ? 's' : '');
        }

        // Initialiser au chargement
        updateSelectedCount();
    </script>
</body>
</html>
