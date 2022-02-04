<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1>Checkout</h1>
                <form method="post" action="{{route('payment')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('profile.name') }}</label>
                        <input type="name" name="name" class="form-control" id="name" placeholder="Enter name">
                    </div>
                        
        
        
                    <div class="form-group">
                        <label for="email">{{ __('profile.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('profile.phone') }} </label>
                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                    </div>

        
        
                    <div class="form-group">
                        <label for="address">{{ __('profile.address') }}</label>
                        <input type="address" class="form-control" name="address" id="address" placeholder="Enter address">
                    </div>
        
        
                    <button type="submit" class="btn btn-primary">{{ __('profile.email') }}</button>
                </form>

            </div>
            {{-- <div class="col-md-4" style="margin-top: 40px;">
                <label for="Total">Total</label>
                {{$total}}
            </div> --}}
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>