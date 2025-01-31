<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/80bb468345.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('CssFiles/cssstyle.css') }}">
</head>

<body>
    <div class="main-container">
        <div class="form-container">
            <div>
                <h1 class="text-center">Infanion</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="position-relative"><i class="fa-solid fa-envelope position-absolute"
                            style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                        <input type="email" name="email" id="email" class="form-control px-5 py-2"
                            value="{{ old('email') }}"></div>
                        @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative"><i class="fa-solid fa-lock position-absolute"
                            style="left: 10px; top: 50%; transform: translateY(-50%);"></i>
                        <input type="password" name="password" id="password" class="form-control px-5 py-2"
                            value="{{ old('password') }}">
                        <i id="eye-icon" class="fa-solid fa-eye-slash position-absolute"
                            style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i></div>
                        @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                        @endif
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="img-container">
            <img src="{{ asset('Employees_images/' . ('Event_Room.jpg' ?? 'default.jpg')) }}" alt="meeting image"
                class="img-fit">
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="{{ asset('JavaScriptFiles/javascript.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>