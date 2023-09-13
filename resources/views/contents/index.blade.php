@extends('layouts.admin.layout')
@section('content')
<!-- right content -->
<div id="content">
   @include('layouts.admin.header')
    <!-- Content Header (Page header) -->
    <div class="midde_cont">
        <div class="container-fluid">
           <div class="row column_title">
              <div class="col-md-12">
                 <div class="page_title">
                    <h2>{{ __('Contents') }}</h2>
                 </div>
              </div>
           </div>
           <!-- row -->
           <div class="row column1">
              <div class="col-md-12">
                 <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                       <div class="heading1 margin_0">
                          <h2>{{ __('Contents') }} <small>( Listing )</small></h2>
                       </div>
                       <div class="pull-right col-sm-6">
                            <a class="btn btn-success" href="{{ route('contents.create') }}"> Create New content</a>
                        </div>
                    </div>
                    <div class="full price_table padding_infor_info">
                       <div class="row">
                          <div class="col-lg-12">
                             <div class="table-responsive-sm">
                                <table class="table table-striped projects">
                                   <thead class="thead-dark">
                                      <tr>
                                         <th style="width: 2%">No</th>
                                         {{-- <th style="width: 30%">Project Title</th> --}}
                                         <th>Title</th>
                                         <th>Message</th>
                                         <th width="280px">Action</th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                    @foreach($contents as $content)
                                      <tr>
                                         <td>{{ ++$i }}</td>
                                         <td>{{ $content->title }}</td>
                                         <td>{{ html_entity_decode($content->message) }}</td>
                                         <td>
                                            <form action="{{ route('contents.destroy',$content->id) }}" method="POST">
                                 
                                                {{-- <a class="btn btn-info" href="{{ route('contents.show',$content->id) }}">Show</a> --}}
                                  
                                                <a class="btn btn-primary" href="{{ route('contents.edit',$content->id) }}">Edit</a>
                                 
                                                @csrf
                                                @method('DELETE')
                                    
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                         </td>
                                      </tr>
                                    @endforeach
                                   </tbody>
                                </table>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- end row -->
           </div>
        </div>
        <!-- footer -->
        @include('layouts.admin.footer')
    </div>
    <!-- end dashboard inner -->
 
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