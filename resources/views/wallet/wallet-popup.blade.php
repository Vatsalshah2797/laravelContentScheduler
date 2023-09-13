<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
       <div class="modal-content">
             <!-- Modal Header -->
             <div class="modal-header">
                <h4 class="modal-title">Add Money To Your Wallet</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <!-- Modal body -->
             <div class="modal-body">
                <form role="form" method="POST" action="{{route('razorpay.payment.store')}}" id="addPaymentForm">
                   @csrf
                   <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                   <input type="hidden" name="razorpay_payment_id" value="" id="razorpay_payment_id">
                   <input type="hidden" name="razorpay_order_id" value="" id="razorpay_order_id">
                   <input type="hidden" name="razorpay_signature" value="" id="razorpay_signature">
                   <input type="hidden" name="generated_signature" value="" id="generated_signature">
                   <div class="form-group">
                         <label class="control-label">Amount</label>
                         <div>
                            <input type="number" class="form-control input-lg" name="amount" id="payment" value="">
                         </div>
                   </div>
                </form>
             </div>
             <!-- Modal footer -->
             <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="addPaymentButton">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
             </div>
       </div>
    </div>
 </div>
 <!-- end model popup -->
