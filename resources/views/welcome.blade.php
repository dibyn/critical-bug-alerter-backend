<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Signup Form</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/styles.css?v=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</head>
<body>
<div class="ext-wrapper">


    @if(!empty($success))
    <div class="alert alert-success" role="alert">
        <ion-icon name="checkmark-circle-outline"></ion-icon>
        <span>{{ $success ?? '' }}</span>
    </div>
    @endif
    @if(!empty($error))
    <div class="alert alert-danger" role="alert">
        <ion-icon name="close-circle-outline"></ion-icon>
        <span>{{ $error ?? '' }}</span>
    </div>
    @endif

    <form method="post" action="https://bug-alert-systemm.herokuapp.com/">
        @csrf
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Signup</h4>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="fname" name="name">
{{--                    @if ($errors->has('name'))--}}
                        {{ $errors->first('name') }}
{{--                    @endif--}}
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email">
                    @if ($errors->has('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone number</label>
                    <input type="text" class="form-control" id="phnumber" name="phone">
                    @if ($errors->has('phone'))
                        <div class="error">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('error') }}" class="btn btn-primary">Error Submit</a>
            </div>
        </div>
    </form>
</div>
</body>
<style>
    .ext-wrapper {
        display: flex;
        background-color: #f5f5f5;
        justify-content: center;
        height: 100vh;
        padding: 20px;
    }
    .card {
        width: 400px;
    }
    .ext-wrapper {
        display: flex;
        flex-direction: column;
        background-color: #f5f5f5;
        justify-content: center;
        height: 100vh;
        padding: 20px;
    }
    .card {
        width: 400px;
        margin: 0 auto;
    }
    .alert {
        max-width: 350px;
        margin: 0 auto 20px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: normal;
    }
    .alert span {
        line-height: normal;
    }
</style>
</html>