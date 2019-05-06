@extends('layouts.main.dashboard')
@extends('compenents.navbar')
@extends('compenents.header')

@section('content')


<div class="main-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card alert">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="product-3-img">
                                <img src="assets/images/product_1/image-8-226x223.jpg" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="product_details_3">
                                <div class="product_name">
                                    <h4>Maxican Hot Pizza</h4>
                                </div>
                                <div class="product_des">
                                    <p>Vimply dummy text the printing.</p>
                                </div>
                                <div class="prdt_add_to_cart">
                                    <button type="button" class="btn btn-success btn-rounded">$29</button>
                                    <button type="button" class="btn btn-primary btn-rounded  m-l-5">add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
 
       


        </div>
        <!-- /# row -->
    </div>
    <!-- /# main content -->

    @endsection