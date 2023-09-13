@extends('layouts.admin.layout')
@section('content')
<!-- right content -->
<div id="content">
   @include('layouts.admin.header')
   <!-- dashboard inner -->
   <div class="midde_cont">
      <div class="container-fluid">
         <div class="row column_title">
            <div class="col-md-12">
               <div class="page_title">
                  <h2>Dashboard</h2>
               </div>
            </div>
         </div>
         <div class="row column1">
            <div class="col-md-6 col-lg-3">
               <div class="full counter_section margin_bottom_30">
                  <div class="couter_icon">
                     <div> 
                        <i class="fa fa-user yellow_color"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">2500</p>
                        <p class="head_couter">Welcome</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full counter_section margin_bottom_30">
                  <div class="couter_icon">
                     <div> 
                        <i class="fa fa-clock-o blue1_color"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">123.50</p>
                        <p class="head_couter">Average Time</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full counter_section margin_bottom_30">
                  <div class="couter_icon">
                     <div> 
                        <i class="fa fa-cloud-download green_color"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">1,805</p>
                        <p class="head_couter">Collections</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full counter_section margin_bottom_30">
                  <div class="couter_icon">
                     <div> 
                        <i class="fa fa-comments-o red_color"></i>
                     </div>
                  </div>
                  <div class="counter_no">
                     <div>
                        <p class="total_no">54</p>
                        <p class="head_couter">Comments</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row column1 social_media_section">
            <div class="col-md-6 col-lg-3">
               <div class="full socile_icons fb margin_bottom_30">
                  <div class="social_icon">
                     <i class="fa fa-facebook"></i>
                  </div>
                  <div class="social_cont">
                     <ul>
                        <li>
                           <span><strong>35k</strong></span>
                           <span>Friends</span>
                        </li>
                        <li>
                           <span><strong>128</strong></span>
                           <span>Feeds</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full socile_icons tw margin_bottom_30">
                  <div class="social_icon">
                     <i class="fa fa-twitter"></i>
                  </div>
                  <div class="social_cont">
                     <ul>
                        <li>
                           <span><strong>584k</strong></span>
                           <span>Followers</span>
                        </li>
                        <li>
                           <span><strong>978</strong></span>
                           <span>Tweets</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full socile_icons linked margin_bottom_30">
                  <div class="social_icon">
                     <i class="fa fa-linkedin"></i>
                  </div>
                  <div class="social_cont">
                     <ul>
                        <li>
                           <span><strong>758+</strong></span>
                           <span>Contacts</span>
                        </li>
                        <li>
                           <span><strong>365</strong></span>
                           <span>Feeds</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-lg-3">
               <div class="full socile_icons google_p margin_bottom_30">
                  <div class="social_icon">
                     <i class="fa fa-google-plus"></i>
                  </div>
                  <div class="social_cont">
                     <ul>
                        <li>
                           <span><strong>450</strong></span>
                           <span>Followers</span>
                        </li>
                        <li>
                           <span><strong>57</strong></span>
                           <span>Circles</span>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <!-- graph -->
         <div class="row column2 graph margin_bottom_30">
            <div class="col-md-l2 col-lg-12">
               <div class="white_shd full">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Extra Area Chart</h2>
                     </div>
                  </div>
                  <div class="full graph_revenue">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="content">
                              <div class="area_chart">
                                 <canvas height="120" id="canvas"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end graph -->
         <div class="row column3">
            <!-- testimonial -->
            <div class="col-md-6">
               <div class="dark_bg full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Testimonial</h2>
                     </div>
                  </div>
                  <div class="full graph_revenue">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="content testimonial">
                              <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                 <!-- Wrapper for carousel items -->
                                 <div class="carousel-inner">
                                    <div class="item carousel-item active">
                                       <div class="img-box"><img src="{{ asset('import/images/layout_img/user_img.jpg') }}" alt=""></div>
                                       <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                       <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                    </div>
                                    <div class="item carousel-item">
                                       <div class="img-box"><img src="images/layout_img/user_img.jpg" alt=""></div>
                                       <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                       <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                    </div>
                                    <div class="item carousel-item">
                                       <div class="img-box"><img src="images/layout_img/user_img.jpg" alt=""></div>
                                       <p class="testimonial">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae..</p>
                                       <p class="overview"><b>Michael Stuart</b>Seo Founder</p>
                                    </div>
                                 </div>
                                 <!-- Carousel controls -->
                                 <a class="carousel-control left carousel-control-prev" href="#testimonial_slider" data-slide="prev">
                                 <i class="fa fa-angle-left"></i>
                                 </a>
                                 <a class="carousel-control right carousel-control-next" href="#testimonial_slider" data-slide="next">
                                 <i class="fa fa-angle-right"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end testimonial -->
            <!-- progress bar -->
            <div class="col-md-6">
               <div class="white_shd full margin_bottom_30">
                  <div class="full graph_head">
                     <div class="heading1 margin_0">
                        <h2>Progress Bar</h2>
                     </div>
                  </div>
                  <div class="full progress_bar_inner">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="progress_bar">
                              <!-- Skill Bars -->
                              <span class="skill" style="width:73%;">Facebook <span class="info_valume">73%</span></span>                  
                              <div class="progress skill-bar ">
                                 <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%;">
                                 </div>
                              </div>
                              <span class="skill" style="width:62%;">Twitter <span class="info_valume">62%</span></span>   
                              <div class="progress skill-bar">
                                 <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;">
                                 </div>
                              </div>
                              <span class="skill" style="width:54%;">Instagram <span class="info_valume">54%</span></span>
                              <div class="progress skill-bar">
                                 <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">
                                 </div>
                              </div>
                              <span class="skill" style="width:82%;">Google plus <span class="info_valume">82%</span></span>
                              <div class="progress skill-bar">
                                 <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 82%;">
                                 </div>
                              </div>
                              <span class="skill" style="width:48%;">Other <span class="info_valume">48%</span></span>
                              <div class="progress skill-bar">
                                 <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end progress bar -->
         </div>
         <div class="row column4 graph">
            <div class="col-md-6 margin_bottom_30">
               <div class="dash_blog">
                  <div class="dash_blog_inner">
                     <div class="dash_head">
                        <h3><span><i class="fa fa-calendar"></i> 6 July 2018</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                     </div>
                     <div class="list_cont">
                        <p>Today Tasks for Ronney Jack</p>
                     </div>
                     <div class="task_list_main">
                        <ul class="task_list">
                           <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>10:00 AM</strong></li>
                           <li><a href="#">Create new task for Dashboard</a><br><strong>10:00 AM</strong></li>
                           <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>11:00 AM</strong></li>
                           <li><a href="#">Create new task for Dashboard</a><br><strong>10:00 AM</strong></li>
                           <li><a href="#">Meeting about plan for Admin Template 2018</a><br><strong>02:00 PM</strong></li>
                        </ul>
                     </div>
                     <div class="read_more">
                        <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="dash_blog">
                  <div class="dash_blog_inner">
                     <div class="dash_head">
                        <h3><span><i class="fa fa-comments-o"></i> Updates</span><span class="plus_green_bt"><a href="#">+</a></span></h3>
                     </div>
                     <div class="list_cont">
                        <p>User confirmation</p>
                     </div>
                     <div class="msg_list_main">
                        <ul class="msg_list">
                           <li>
                              <span><img src="{{ asset('import/images/layout_img/msg2.png') }}" class="img-responsive" alt="#" /></span>
                              <span>
                              <span class="name_user">Herman Beck</span>
                              <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                              <span class="time_ago">12 min ago</span>
                              </span>
                           </li>
                           <li>
                              <span><img src="{{ asset('import/images/layout_img/msg3.png') }}" class="img-responsive" alt="#" /></span>
                              <span>
                              <span class="name_user">John Smith</span>
                              <span class="msg_user">On the other hand, we denounce.</span>
                              <span class="time_ago">12 min ago</span>
                              </span>
                           </li>
                           <li>
                              <span><img src="{{ asset('import/images/layout_img/msg2.png') }}" class="img-responsive" alt="#" /></span>
                              <span>
                              <span class="name_user">John Smith</span>
                              <span class="msg_user">Sed ut perspiciatis unde omnis.</span>
                              <span class="time_ago">12 min ago</span>
                              </span>
                           </li>
                           <li>
                              <span><img src="{{ asset('import/images/layout_img/msg3.png') }}" class="img-responsive" alt="#" /></span>
                              <span>
                              <span class="name_user">John Smith</span>
                              <span class="msg_user">On the other hand, we denounce.</span>
                              <span class="time_ago">12 min ago</span>
                              </span>
                           </li>
                        </ul>
                     </div>
                     <div class="read_more">
                        <div class="center"><a class="main_bt read_bt" href="#">Read More</a></div>
                     </div>
                  </div>
               </div>
            </div>
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