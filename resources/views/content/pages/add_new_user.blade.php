@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Create new account</span>
</h4>



  <div class="card">
    <div class="card-body">
      <h6>Add New</h6>
      <div class="col-md-6">

        <div class="form-group pb-2">
          <label for="">Fullname:</label>
          <input type="text" class="form-control" placeholder="Enter Full Name">
        </div>

        <div class="form-group pb-2">
          <label for="">Email:</label>
          <input type="text" class="form-control" placeholder="Enter Full Name">
        </div>

        <div class="form-group pb-2">
          <label for="">Create a password:</label>
          <input type="text" class="form-control" placeholder="Enter Full Name">
        </div>


        <div class="form-group pb-2">
          <label for="">Select Role:</label>
          <select name="" id="" class="form-control">
            <option value="">Job Seeker</option>
            <option value="">Freelancer</option>
            <option value="">Recruiter</option>
          </select>
        </div>


        <div class="form-group pb-2">
          <button class="btn btn-primary">Create account</button>
        </div>

      </div>
    </div>
  </div>


@endsection
