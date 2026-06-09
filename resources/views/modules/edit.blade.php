<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Module</title>
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
            max-width: 700px;
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

        .error-alert {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 25px;
            color: #c33;
        }

        .error-alert ul {
            list-style: none;
            padding-left: 0;
        }

        .error-alert li {
            padding: 5px 0;
        }

        .error-alert li:before {
            content: "✕ ";
            font-weight: bold;
            margin-right: 8px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 15px;
            margin-top: 30px;
        }

        .submit-btn,
        .delete-btn {
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

        .delete-btn {
            background: #f44336;
            color: white;
        }

        .delete-btn:hover {
            background: #da190b;
            transform: translateY(-2px);
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .button-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Modifier {{ $module->title }}</h1>
            <a href="{{ route('modules.index') }}" class="back-link">← Retour</a>
        </div>

        <div class="form-card">
            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('modules.update', $module) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="code">Code *</label>
                        <input type="text" id="code" name="code" value="{{ old('code', $module->code) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Titre *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $module->title) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="MHP">MHP (Heures Pratique) *</label>
                        <input type="number" id="MHP" name="MHP" value="{{ old('MHP', $module->MHP) }}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="MHS">MHS (Heures Synthèse) *</label>
                        <input type="number" id="MHS" name="MHS" value="{{ old('MHS', $module->MHS) }}" min="0" required>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="submit-btn">✓ Mettre à jour</button>
                    <form action="{{ route('modules.destroy', $module) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr? Cette action est irréversible.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">🗑️ Supprimer</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
