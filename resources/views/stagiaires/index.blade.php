
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stagiaires</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            max-width: 1200px;
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

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .btn-success {
            background: #4caf50;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #f44336;
            color: white;
            border: none;
            font-size: 12px;
        }

        .btn-danger:hover {
            background: #da190b;
        }

        .table-card {
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-info {
            background: #2196F3;
            color: white;
        }

        .btn-info:hover {
            background: #0b7dda;
        }

        .btn-warning {
            background: #ff9800;
            color: white;
        }

        .btn-warning:hover {
            background: #e68900;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 30px;
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 4px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: white;
        }

        .empty-state h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 24px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 10px;
            }

            .actions {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container py-4">
	<div class="header">
		<h1>Stagiaires</h1>
		<div class="action-buttons">
			<a href="{{ route('stagiaires.create') }}" class="btn btn-success">+ Nouveau module</a>
			<a href="{{ route('modules.index') }}" class="btn btn-primary">← Modules</a>
		</div>
	</div>

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="h3">Stagiaires</h1>
		<a href="{{ route('stagiaires.create') }}" class="btn btn-primary">New Stagiaire</a>

		@auth
			{{-- <a href="{{ route('auth.dologout') }}" class="btn btn-secondary">Logout</a> --}}
			<form action="{{ route('auth.dologout') }}" method="POST">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-secondary">Logout</button>
			</form>
		@endauth
		@guest
			<a href="{{ route('auth.dologin') }}" class="btn btn-secondary">Login</a>
		@endguest

	</div>

	@if(session('success'))
		<div class="alert alert-success">{{ session('success') }}</div>
	@endif

	@if(isset($stagiaires) && $stagiaires->count())
		<div class="table-card">
			<table>
				<thead>
				<tr>
					<th>Photo</th>
					<th>#</th>
					<th>CEF</th>
					<th>FirstName</th>
					<th>LastName</th>
					<th>Email</th>
					<th>Phone</th>
					<th>City</th>
					<th>Modules</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
				@foreach($stagiaires as $stagiaire)
					<tr>
						<td>
                            @if($stagiaire->photo)
                                <img src="{{ asset('storage/' . $stagiaire->photo) }}" alt="Photo" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                            @else
                                Pas de photo
                            @endif
                        </td>
						<td>{{ $stagiaire->id }}</td>
						<td>{{ $stagiaire->cef }}</td>
						<td>{{ $stagiaire->firstname }}</td>
						<td>{{ $stagiaire->lastname }}</td>
						<td>{{ $stagiaire->email }}</td>
						<td>{{ $stagiaire->phone ?? '-' }}</td>
						<td>{{ $stagiaire->city ?? '-' }}</td>
						<td>
							<span style="background: #e8f4f8; color: #0084b4; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">
								{{ $stagiaire->modules()->count() }}
							</span>
						</td>
						<td>
							<div class="actions">
							{{-- @auth --}}
								<a href="{{ route('stagiaires.attachModules', $stagiaire) }}" class="btn-sm btn-info">👁️ Attacher</a>
								<a href="{{ route('stagiaires.show', $stagiaire) }}" class="btn btn-sm btn-outline-secondary">View</a>
								<a href="{{ route('stagiaires.edit', $stagiaire) }}" class="btn btn-sm btn-outline-primary">Edit</a>
								<form action="{{ route('stagiaires.destroy', $stagiaire) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this stagiaire?');">
									@csrf
									@method('DELETE')
									<button class="btn btn-sm btn-outline-danger">Delete</button>
								</form>
							{{-- @endauth --}}
							@guest
								<a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Create an account</a>
							@endguest
							</div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>

		{{ $stagiaires->links() ?? '' }}
	@else
		<div class="card">
			<div class="card-body">No stagiaires found. <a href="{{ route('stagiaires.create') }}">Create one</a>.</div>
		</div>
	@endif
</div>

</body>
</html>
