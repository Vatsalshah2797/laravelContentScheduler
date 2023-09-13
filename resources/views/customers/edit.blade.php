@extends('layouts.admin.layout')
@section('content')
<div id="content">
    @include('layouts.admin.header')
    <!-- Content Header (Page header) -->
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                       <h2>{{ __('Edit Customer') }}</h2>
                    </div>
                    <div class="pull-right col-sm-6">
                        <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
                    </div>
                 </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        <input type="email" name="email" value="{{ $customer->email }}" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Mobile:</strong>
                                        <input type="phone" name="mobile" value="{{ $customer->mobile }}" class="form-control" placeholder="Mobile">
                                  </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
        <!-- footer -->
        @include('layouts.admin.footer')
    </div>
    <!-- model popup -->
    @include('wallet.wallet-popup')
 </div>
 @endsection

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
   
   $('#addPaymentButton').on('click', function (e) {
       e.preventDefault();
       var amount = $('#payment').val();
       
       var remarks = "this is test";


       var options = {
            "key": "{{ config('app.razorpay_api_key') }}", // Enter the Key ID generated from the Dashboard
            "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "{{ config('app.currency') }}",
            "name": "{{ config('app.account_name') }}",
            "description": remarks,
            "image": "{{ asset('images/logo-black.svg') }}",
            //"order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response) {
               $('#razorpay_payment_id').val(response.razorpay_payment_id);
               $('#razorpay_order_id').val(response.razorpay_order_id);
               $('#razorpay_signature').val(response.razorpay_signature);
               $('#addPaymentForm').submit();
            },
            "prefill": {
               "name": "Vatsal P M Shah",
               "email": "vatsalshah2797@gmail.com",
               "contact": "+918401942365"
            },
            "notes": {
               "address": "Razorpay Corporate Office"
            },
            "theme": {
               "color": "#3399cc"
            }
         };
         var rzp1 = new Razorpay(options);
         rzp1.on('payment.failed', function (response) {

         });

         rzp1.open();





      //  $.ajaxSetup({
      //      headers: {
      //          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //      }
      //  });
      //  $.ajax({
      //      type: "GET",
      //      url: "orderid-generate",
      //      data: $("#addPaymentForm").serialize(),
      //      success: function (data) {
      //          var order_id = '';
      //          if (data.order_id) {
      //              order_id = data.order_id;
      //          }

               


      //      },
      //  });

   });

</script>
@endsection
{{-- @section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection --}}