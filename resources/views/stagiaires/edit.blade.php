<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Stagiaire</title>
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

        .photo-section {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .photo-current {
            margin-bottom: 15px;
        }

        .photo-current h4 {
            color: #333;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .photo-current img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ddd;
        }

        .photo-empty {
            width: 150px;
            height: 150px;
            background: #eee;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 14px;
            border: 2px dashed #ddd;
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
        .form-group input[type="email"],
        .form-group input[type="date"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f9f9f9;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="date"]:focus,
        .form-group input[type="file"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group input[type="file"] {
            padding: 10px;
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Modifier {{ $stagiaire->firstname }} {{ $stagiaire->lastname }}</h1>
            <a href="{{ route('stagiaires.index') }}" class="back-link">← Retour</a>
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

            <form action="{{ route('stagiaires.update', $stagiaire) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="firstname">Prénom *</label>
                    <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $stagiaire->firstname) }}" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Nom *</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $stagiaire->lastname) }}" required>
                </div>

                <div class="form-group">
                    <label for="cef">CEF *</label>
                    <input type="text" id="cef" name="cef" value="{{ old('cef', $stagiaire->cef) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $stagiaire->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $stagiaire->phone) }}">
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $stagiaire->address) }}">
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date de naissance</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $stagiaire->date_of_birth) }}">
                </div>

                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $stagiaire->city) }}">
                </div>

                <div class="photo-section">
                    @if($stagiaire->photo)
                        <div class="photo-current">
                            <h4>📷 Photo actuelle</h4>
                            <img src="{{ asset('storage/' . $stagiaire->photo) }}" alt="Photo de {{ $stagiaire->firstname }}">
                        </div>
                    @else
                        <div class="photo-current">
                            <h4>📷 Photo</h4>
                            <div class="photo-empty">Aucune photo</div>
                        </div>
                    @endif
                    
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="photo">Remplacer la photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                    </div>
                </div>

                <button type="submit" class="submit-btn">✓ Mettre à jour</button>
            </form>
        </div>
    </div>
</body>
</html>
