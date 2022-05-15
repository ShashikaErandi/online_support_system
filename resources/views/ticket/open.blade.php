@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
          <div class="card-body">
              <div class="card">
                <h4 class="card-header">Open Support Ticket</h4>
                <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <form method="POST" action="/open/support-ticket">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="customerName">Customer Name</label>
                            <input type="text" class="form-control @error('customerName') is-invalid @enderror" id="customerName" name="customerName" placeholder="Enter name" value="{{ old('customerName') }}" required autocomplete="customerName">
                            @error('customerName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" value="{{ old('description') }}" required autocomplete="description"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phoneNo">Phone Number</label>
                            <input type="text" class="form-control @error('phoneNo') is-invalid @enderror" id="phoneNo" name="phoneNo" placeholder="Enter phone number" value="{{ old('phoneNo') }}" required autocomplete="phoneNo">
                            @error('phoneNo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </div>
          </div>
        </div>

    </div>
</div>

@endsection