 @extends('layouts.client_layout')

 @section('content')
 <main class="main">
     <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
         <div class="container">
             <h1 class="page-title">My Account<span>Shop</span></h1>
         </div><!-- End .container -->
     </div><!-- End .page-header -->
     <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
         <div class="container">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                 <li class="breadcrumb-item"><a href="#">Shop</a></li>
                 <li class="breadcrumb-item active" aria-current="page">My Account</li>
             </ol>
         </div><!-- End .container -->
     </nav><!-- End .breadcrumb-nav -->

     <div class="page-content">
         <div class="dashboard">
             <div class="container">
                 <div class="row">


                     @include('account.partials.aside')


                     <div class="col-md-8 col-lg-9">
                         <div class="tab-content">
                             <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                 aria-labelledby="tab-dashboard-link">
                                 @if (session('success'))
                                 <div class="alert alert-success">
                                     {{ session('success') }}
                                 </div>
                                 @endif
                                 <p>Hello <span class="font-weight-normal text-dark">User</span> (not <span
                                         class="font-weight-normal text-dark">User</span>? <a href="#">Log
                                         out</a>)
                                     <br>
                                     From your account dashboard you can view your <a href="#tab-orders"
                                         class="tab-trigger-link link-underline">recent orders</a>, manage your
                                     <a href="#tab-address" class="tab-trigger-link">shipping and billing
                                         addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit
                                         your password and account details</a>.
                                 </p>
                             </div><!-- .End .tab-pane -->

                             <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                 aria-labelledby="tab-orders-link">
                                 <p>No order has been made yet.</p>
                                 <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i
                                         class="icon-long-arrow-right"></i></a>
                             </div><!-- .End .tab-pane -->

                             <div class="tab-pane fade" id="tab-manager-story" role="tabpanel"
                                 aria-labelledby="tab-manager-story-link">
                                 <table class="table table-hover table-striped table-bordered">
                                     <thead class="thead-dark">
                                         <tr>
                                             <th>Bài đã đăng</th>
                                             <th>Ngày đăng</th>
                                             <th>Trạng thái</th>
                                             <th>Chức năng</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>Bài viết 1</td>
                                             <td>2024-09-25</td>
                                             <td><span class="">Đang chờ duyệt</span>
                                             <td><a href="" style="text-decoration:dashed;">Xem bài
                                                     viết</a>
                                             </td>
                                         </tr>

                                     </tbody>
                                 </table>
                             </div><!-- .End .tab-pane -->

                             <!-- CSS tùy chỉnh -->
                             <style>
                                 .table {
                                     border-radius: 10px;
                                     overflow: hidden;
                                 }

                                 .table th {
                                     background-color: #343a40;
                                     color: #fff;
                                     text-align: center;
                                     font-weight: bold;
                                 }

                                 .table tbody tr:hover {
                                     background-color: #f5f5f5;
                                 }

                                 .table td {
                                     text-align: center;
                                     vertical-align: middle;
                                 }

                                 .badge {
                                     font-size: 0.9rem;
                                     padding: 5px 10px;
                                 }
                             </style>
                             <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                 aria-labelledby="tab-address-link">
                                 <p>The following addresses will be used on the checkout page by default.</p>

                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="card card-dashboard">
                                             <div class="card-body">
                                                 <h3 class="card-title">Billing Address</h3>
                                                 <!-- End .card-title -->

                                                 <p>User Name<br>
                                                     User Company<br>
                                                     John str<br>
                                                     New York, NY 10001<br>
                                                     1-234-987-6543<br>
                                                     yourmail@mail.com<br>
                                                     <a href="#">Edit <i class="icon-edit"></i></a>
                                                 </p>
                                             </div><!-- End .card-body -->
                                         </div><!-- End .card-dashboard -->
                                     </div><!-- End .col-lg-6 -->

                                     <div class="col-lg-6">
                                         <div class="card card-dashboard">
                                             <div class="card-body">
                                                 <h3 class="card-title">Shipping Address</h3>
                                                 <!-- End .card-title -->

                                                 <p>You have not set up this type of address yet.<br>
                                                     <a href="#">Edit <i class="icon-edit"></i></a>
                                                 </p>
                                             </div><!-- End .card-body -->
                                         </div><!-- End .card-dashboard -->
                                     </div><!-- End .col-lg-6 -->
                                 </div><!-- End .row -->
                             </div><!-- .End .tab-pane -->
                             <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                 aria-labelledby="tab-account-link">
                                 @include('account.partials.account_edit')

                                 @include('account.partials.update-password')
                             </div><!-- .End .tab-pane -->
                         </div>
                     </div><!-- End .col-lg-9 -->
                 </div><!-- End .row -->
             </div><!-- End .container -->
         </div><!-- End .dashboard -->
     </div><!-- End .page-content -->
 </main><!-- End .main -->

 @endsection