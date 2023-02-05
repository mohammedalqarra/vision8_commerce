{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('register' . config('app.name'))</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            font-family: "Source Sans Pro", sans-serif;
            font-size: 16px;
            line-height: 1.43;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
        }

        input,
        button {
            appearance: none;
            outline: none;
        }

        input::-webkit-input-placeholder {
            color: transparent;
            user-select: none;
        }

        input::-moz-placeholder {
            color: transparent;
            user-select: none;
        }

        input:-moz-placeholder {
            color: transparent;
            user-select: none;
        }

        input:-ms-input-placeholder {
            color: transparent;
            user-select: none;
        }

        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 100px #fff inset;
            -webkit-text-fill-color: inherit;
        }

        .input {
            flex: 1;
            width: 100%;
            transition: width 0.18s ease;
        }

        .input__container {
            display: flex;
            flex-direction: column;
            position: relative;
            height: 40px;
            width: 100%;
        }

        .input__container.error {
            height: auto;
        }

        .input__container.error pre {
            padding: 8px 8px 0;
        }

        .input__label {
            position: absolute;
            padding: 0 8px;
            top: 0;
            color: #3d3c48;
            cursor: text;
            font-size: 16px;
            transition-property: top, font-size;
            transition-timing-function: linear;
            transition-duration: 0.18s;
        }

        .input__field {
            background: transparent;
            border: 0px solid #e5e5e6;
            border-bottom-width: 2px;
            padding: 6px 8px;
            font-size: 16px;
            transition: border 0.28s ease-out;
        }

        .input__field:required+.input__label:after {
            content: "*";
            color: red;
        }

        .input__field:focus,
        .input__field:not(:placeholder-shown) {
            border-color: #434176;
        }

        .input__field:focus+.input__label,
        .input__field:not(:placeholder-shown)+.input__label {
            font-size: 14px;
            top: -16px;
        }

        .input:hover .input__field:placeholder-shown:not(:focus) {
            border-color: #918fc1;
        }

        .input-checkbox__field {
            position: absolute;
            height: 18px;
            width: 18px;
            margin: 0;
            cursor: pointer;
            opacity: 0;
            z-index: 1;
        }

        .input-checkbox__container {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .input-checkbox__label {
            padding: 0 16px;
            color: #3d3c48;
            cursor: pointer;
            font-size: 16px;
            line-height: 1.25;
        }

        .input-checkbox__square {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            height: 18px;
            width: 18px;
            border: 1px solid #c5c5c9;
            border-radius: 4px;
            will-change: border, box-shadow;
            transition: border 0.28s ease-out, box-shadow 0.28s ease-out;
            z-index: 0;
        }

        .input-checkbox__square::before,
        .input-checkbox__square::after {
            content: "";
            display: inline-block;
            width: 2px;
            background: #e5e5e6;
            border-radius: 2px;
            transition: background 0.28s ease-out;
        }

        .input-checkbox__square::before {
            height: 4px;
            transform: rotate(-40deg) translate3d(-1.5px, 0px, 0);
        }

        .input-checkbox__square::after {
            height: 8px;
            transform: rotate(40deg);
        }

        .input-checkbox:hover .input-checkbox__square::before,
        .input-checkbox:hover .input-checkbox__square::after {
            background: #434176;
        }

        .input-checkbox__field:focus+.input-checkbox__square::before,
        .input-checkbox__field:focus+.input-checkbox__square::after,
        .input-checkbox__field:checked+.input-checkbox__square::before,
        .input-checkbox__field:checked+.input-checkbox__square::after {
            background: #434176;
        }

        .input-checkbox__field:hover+.input-checkbox__square {
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.32);
        }

        .input-checkbox__field:focus+.input-checkbox__square {
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.32);
        }

        .input-checkbox__field:checked+.input-checkbox__square {
            border-color: #434176;
        }

        .btn {
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            will-change: background, box-shadow;
            transition: background 0.28s ease-out, box-shadow 0.28s ease-out;
        }

        .btn--regular,
        .btn--line {
            padding: 16px 56px;
        }

        .btn--disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        .component--primary .btn:disabled {
            opacity: 0.7;
            pointer-events: none;
        }

        .component--primary .btn--regular {
            background-color: #434176;
            color: #FFF;
        }

        .component--primary .btn--regular:hover {
            background-color: #6361a8;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .component--primary .btn--regular:focus,
        .component--primary .btn--regular:active {
            background-color: #34335c;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }

        .component--primary .btn--regular:disabled {
            background-color: #5c5c5c;
        }

        .link {
            text-decoration: none;
            color: #434176;
            display: inline-block;
            text-decoration: underline;
            transition: color 0.28s ease-out;
        }

        .link:hover {
            color: #161627;
        }

        .form {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        .form__row {
            margin-bottom: 40px;
        }

        .form__row--two {
            margin: 0 -16px 0px;
        }

        @media screen and (min-width: 500px) {
            .form__row--two {
                display: flex;
            }
        }

        .form__inline-input {
            padding: 0 16px;
            margin-bottom: 40px;
        }

        @media screen and (min-width: 500px) {
            .form__inline-input {
                width: 50%;
                flex: 1 0 auto;
            }
        }

        .form__button {
            text-align: center;
        }

        .sign-up {
            min-height: 100vh;
        }

        .sign-up__container {
            display: flex;
            flex-flow: row nowrap;
            height: 100%;
        }

        .sign-up__image,
        .sign-up__content {
            flex: 1;
        }

        .sign-up__image {
            display: none;
            background-image: linear-gradient(210deg, #242348, #5A55AA);
            position: relative;
            overflow: hidden;
        }

        .sign-up__image svg {
            width: 100%;
            height: 100%;
            bottom: 0;
            top: 0;
            position: absolute;
        }

        @media screen and (min-width: 1000px) {
            .sign-up__image {
                display: block;
            }
        }

        .sign-up__content {
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
            padding: 14vh 24px 10vh;
            background-color: #fafafa;
        }

        .sign-up__header {
            margin-bottom: 48px;
            text-align: center;
        }

        .sign-up__title {
            margin-bottom: 16px;
            color: #434176;
        }

        .sign-up__descr {
            font-size: 1.25rem;
            color: rgba(67, 65, 118, 0.4);
        }

        .sign-up__form {
            width: 100%;
        }

        .sign-up__sign,
        .sign-up__terms {
            text-align: center;
            margin-bottom: 20px;
        }

        .sign-up__sign {
            margin-top: -8px;
        }

        .sign-up__terms {
            margin-top: 80px;
        }

        .chart .a {
            fill: url(#a);
        }

        .chart .b {
            clip-path: url(#b);
        }

        .chart .c {
            opacity: 0.201;
        }

        .chart .d,
        .chart .g {
            opacity: 0.7;
        }

        .chart .d {
            fill: url(#c);
        }

        .chart .e,
        .chart .h,
        .chart .k {
            fill: none;
        }

        .chart .e {
            stroke: #a3a0fb;
        }

        .chart .e,
        .chart .f,
        .chart .h,
        .chart .i {
            stroke-width: 2px;
        }

        .chart .f,
        .chart .i {
            fill: #fff;
        }

        .chart .f {
            stroke: #a4a1fb;
        }

        .chart .g {
            fill: url(#e);
        }

        .chart .h {
            stroke: #54d8ff;
        }

        .chart .i {
            stroke: #55d8fe;
        }

        .chart .j {
            stroke: none;
        }
    </style>
</head>

<body>
    <main class="sign-up">
        <div class="sign-up__container">
            <div class="sign-up__image">
                <svg class="chart" viewbox="0 0 800 960" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <lineargradient gradientunits="objectBoundingBox" id="a" x2="1" y1="1">
                            <stop offset="0" stop-color="#5c6ccd"></stop>
                            <stop offset="1" stop-color="#5753b5"></stop>
                        </lineargradient>
                        <lineargradient gradientunits="objectBoundingBox" id="c" x1="0.5" x2="0.5"
                            y2="1">
                            <stop offset="0" stop-color="#a7a7ff"></stop>
                            <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                        </lineargradient>
                        <lineargradient gradientunits="objectBoundingBox" id="e" x1="0.5" x2="0.5"
                            y2="1">
                            <stop offset="0" stop-color="#54d8ff"></stop>
                            <stop offset="1" stop-color="#fff" stop-opacity="0"></stop>
                        </lineargradient>
                    </defs>
                    <g class="b" transform="translate(25 -58)">
                        <g class="c" transform="translate(-585.529 331.726)">
                            <path class="d"
                                d="M330,764.877V546.706s308.5,143.1,555,152.089c266.539-8.71,312.693-69.952,520.308-152.089,177.416-68.461,354.346-87.251,524.168-82.413s317.013,78.793,517.612,86.372c353.879-30.534,534.429-184.911,558.338-249.388v544.74L330,846.259Z"
                                transform="translate(-317.723 -288.325)"></path>
                            <path class="e"
                                d="M313,493.785S619.512,640.3,861.863,643.452s335.438-75.606,521.062-149.472,362.09-86.472,524.554-83.989,320.4,79.889,520.019,84,522.561-133.8,558.472-248.748"
                                transform="translate(-298.268 -234.833)"></path>
                            <g class="f" transform="translate(1072.897 247.907)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                            <g class="f" transform="translate(718.407 383.633)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                        </g>
                        <g class="c" transform="translate(-712.529 564.726)">
                            <path class="d"
                                d="M330,764.877V546.706s308.5,143.1,555,152.089c266.539-8.71,312.693-69.952,520.308-152.089,177.416-68.461,354.346-87.251,524.168-82.413s317.013,78.793,517.612,86.372c353.879-30.534,534.429-184.911,558.338-249.388v544.74L330,846.259Z"
                                transform="translate(-317.723 -288.325)"></path>
                            <path class="e"
                                d="M313,493.785S619.512,640.3,861.863,643.452s335.438-75.606,521.062-149.472,362.09-86.472,524.554-83.989,320.4,79.889,520.019,84,522.561-133.8,558.472-248.748"
                                transform="translate(-298.268 -234.833)"></path>
                            <g class="f" transform="translate(1072.897 247.907)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                        </g>
                        <g class="c" transform="translate(-743.926 354.582)">
                            <path class="g"
                                d="M330,687.576V354.422S631.107,685.647,878.452,698.112c275.977-2.807,278.239-171.952,520.751-264.548,203.024-72.706,357.942,125.622,527.763,130.459s287.023-135.926,518.71-145.705c300.179,14.727,541.051,202.792,559.742,212.9V768.716L330,768.958Z"
                                transform="translate(-313.715 -344.568)"></path>
                            <path class="h"
                                d="M312.953,279.164S623.431,616.493,866.082,619.648s325.629-198.754,520.459-266.824,363.846,129.84,526.511,132.324,318.406-148.686,518.271-144.577S2859.7,459.03,2986.03,549.234"
                                transform="translate(-298.327 -266.489)"></path>
                            <g class="i" transform="translate(2114.927 61.363)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                            <g class="i" transform="translate(1155.767 60.537)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                        </g>
                        <g class="c" transform="translate(-1046.649 464.919)">
                            <path class="g"
                                d="M330,687.576V354.422S631.107,685.647,878.452,698.112c275.977-2.807,278.239-171.952,520.751-264.548,203.024-72.706,357.942,125.622,527.763,130.459s287.023-135.926,518.71-145.705c300.179,14.727,541.051,202.792,559.742,212.9V768.716L330,768.958Z"
                                transform="translate(-314.715 -344.568)"></path>
                            <path class="h"
                                d="M312.953,279.164S623.431,616.493,866.082,619.648s325.629-198.754,520.459-266.824,363.846,129.84,526.511,132.324,318.406-148.686,518.271-144.577S2859.7,459.03,2986.03,549.234"
                                transform="translate(-298.327 -266.489)"></path>
                            <g class="i" transform="translate(1701.637 192.18)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                            <g class="i" transform="translate(1073.43 73.636)">
                                <circle class="j" cx="12.259" cy="12.259" r="12.259"></circle>
                                <circle class="k" cx="12.259" cy="12.259" r="11.259"></circle>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="sign-up__content">
                <header class="sign-up__header">
                    <h1 class="sign-up__title">
                        Sign up
                    </h1>
                    <p class="sign-up__descr">
                        Welcome, Please sign up your account.
                    </p>
                </header>
                <form class="sign-up__form form" action="{{ route('register') }}" method="POST" >
                    @csrf
                    <div class="form__row form__row--two">
                        <div class="input form__inline-input">
                            <div class="input__container">
                                <input class="input__field" id="first-name" placeholder="Name" required=""
                                    type="text" name="name"  value="{{ old('name') }}"/><label class="input__label"  for="first-name">Name</label>
                                    @error('name')
                                    <small style="color: red"  role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="input">
                            <div class="input__container">
                                <input class="input__field" id="email" placeholder="Email" required=""
                                    type="text" name="email" value="{{ old('email') }}"/><label class="input__label" for="email">Email</label>
                                    @error('email')
                                    <small style="color: red"  role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="input">
                            <div class="input__container">
                                <input class="input__field" id="password" placeholder="Password" required=""
                                    type="password" name="password"/><label class="input__label" for="password">Password</label>
                                    @error('email')
                                    <small style="color: red"  role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="input">
                            <div class="input__container">
                                <input class="input__field" id="confirm-password" placeholder="Confirm password"
                                    required="" type="password" name="password_confirmation"/><label class="input__label"
                                    for="confirm-password">Confirm password</label>
                                    @error('email')
                                    <small style="color: red"  role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="component component--primary form__button">
                            <button class="btn btn--regular"  id="sign-up-button" tabindex="0">Sign
                                up</button>
                        </div>
                    </div>
                    <div class="form__row sign-up__sign">
                        Already have an account? &nbsp;<a class="link" href="{{  route('login') }}">Sign in.</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let requiredInput = document.querySelectorAll("input[required]");
            let signUpButton = document.querySelector("#sign-up-button");
            var checkValidForm = () => {
                if (
                    _.every(requiredInput, (input) => {
                        return !_.isEmpty(input.value);
                    })
                ) {
                    if (signUpButton.hasAttribute("disabled")) return;
                    signUpButton.removeAttribute("disabled");
                } else {
                    if (!signUpButton.hasAttribute("disabled")) return;
                    signUpButton.addAttribute("disabled");
                }
            };
            _.forEach(requiredInput, (input) => {
                input.addEventListener("change", function(e) {
                    console.log(e.target.value);
                    checkValidForm();
                });
            });
        });
    </script>
</body>

</html>
