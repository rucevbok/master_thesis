<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Risk Management Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.7.4/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">Pro užití IS se přihlašte</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="/img/logo2_app">
                        </figure>
                        <form method="POST" action="{{ route('login') }}">
                                    {{csrf_field()}}

                            <div class="field">
                                <div class="control">
                                    <input name="email" class="input is-large form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" placeholder="E-mailová adresa" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" id="password" name="password" type="password" placeholder="Heslo">
                                </div>
                            </div>
                            <div class="field">
                                <label class="checkbox">
                  <input type="checkbox">
                  Remember me
                </label>
                            </div>
                            <button type="submit" class="button is-block is-info is-large is-fullwidth">
                                    {{ __('Login') }}
                                </button>
                           {{--  <button class="button is-block is-info is-large is-fullwidth">Login</button> --}}
                        </form>
                    </div>
                    <p class="has-text-grey">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Zapomenuté heslo') }}</a>
                    @endif
                    </p>

                </div>
            </div>
        </div>
    </section>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>

