<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .centered-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .centered-form .form-group  {
            max-width: 300px;
            width: 100%;
            margin-left: 400px;
        }
        .centered-form .form-title {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="centered-form">
        <div class="container">
            <h1 class="form-title">Connexion</h1>

            <form method="POST" action="{{ route('login') }}" class="text-center">
                @csrf

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" name="email" id="email" >
                    @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control" name="password" id="password" >
                    @error('password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
