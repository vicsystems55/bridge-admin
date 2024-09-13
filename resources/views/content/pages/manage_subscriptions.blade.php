@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Manage Subscription Plans</span>
</h4>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h6>Basic</h6>
        <p>NGN 8,000 /Month</p>
        <hr>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur labore nobis hic rem sunt nemo quisquam repellendus. Distinctio aliquam vitae amet sapiente, dolor
        </p>
        <div class="c text-center">

          <button class="btn btn-primary">Manage</button>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h6>Standard</h6>
        <p>NGN 12,000/Month</p>

        <hr>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur labore nobis hic rem sunt nemo quisquam repellendus. Distinctio aliquam vitae amet sapiente, dolor
        </p>

        <div class="c text-center">

          <button class="btn btn-primary">Manage</button>
        </div>

      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h6>Premium</h6>
        <p>NGN 20,000/Month</p>

        <hr>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur labore nobis hic rem sunt nemo quisquam repellendus. Distinctio aliquam vitae amet sapiente, dolor
        </p>
        <div class="c text-center">

          <button class="btn btn-primary">Manage</button>
        </div>

      </div>
    </div>
  </div>
</div>




@endsection
