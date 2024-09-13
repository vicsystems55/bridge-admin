@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Job Posts</span>
</h4>

<div class="row">
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h6>Ux/Ui Designerr</h6>
        <p>Lagos, Nigeria</p>
        <hr>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur labore nobis hic rem sunt nemo quisquam repellendus. Distinctio aliquam vitae amet sapiente, dolor
        </p>

      </div>
    </div>
  </div>
</div>




@endsection
