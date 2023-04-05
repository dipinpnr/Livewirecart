<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
       
       
        <!-- Fonts -->
      

        <!-- Styles -->
        <style>
        body {
    margin: 0;
    font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5385;
    color: #333;
    text-align: left;
    background-color: #f5f5f5;
}

.mt-50{
    margin-top: 50px;
}
.mb-50{
    margin-bottom: 50px;
}


.bg-teal-400 { 
    background-color: #26a69a;
}

a{
    text-decoration: none !important;
}


.fa {
        color: red;
}
.cart-counter {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
  float:right;
  margin-bottom:5px;
}

.cart-counter:hover {
  background: red;
}

.cart-counter .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

  .quantity {
            position: relative;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: numberfield;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance:  numberfield;
        }

        .quantity input {
            width: 60px;
            height: 40px;
            line-height: 1.25;
            float: left;
            display: block;
            padding: 0;
            margin: 0;
            padding-left: 20px;
            border: 1px solid #000;
        }

        .quantity input:focus {
            outline: 0;
        }

        .quantity-nav {
            float: left;
            position: relative;
            height: 42px;
        }

        .quantity-button {
            position: relative;
            cursor: pointer;
            border-left: 1px solid #eee;
            width: 20px;
            text-align: center;
            color: #333;
            font-size: 13px;
            font-family: "FontAwesome" !important;
            line-height: 1.7;
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        .quantity-button.quantity-up {
            position: absolute;
            height: 50%;
            top: 0;
            border-bottom: 1px solid #eee;
            font-family: "FontAwesome";
        }

        .quantity-button.quantity-down {
            position: absolute;
            bottom: -1px;
            height: 50%;
            font-family: "FontAwesome";
        }
        </style>

    @livewireStyles   
    </head>
    <body>
      <div class="container d-flex justify-content-center mt-50 mb-50">
            
        <div class="row">
         <livewire:cart-counter>
        
          @livewire('product-listing')            
        </div>
    </div>
    <script>
$(document).ready(function(){
  toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
 
   window.addEventListener('cart-added',event=>{
    toastr.success(event.detail.message,'Success!')
  });
  window.addEventListener('cart-removed',event=>{
    toastr.error(event.detail.message,'Success!')
  });
});
</script>
    @livewireScripts
    </body>
</html>
