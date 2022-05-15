@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card text-center">
          <div class="card-body">
              <div class="card">
                <h4 class="card-header">View Ticket</h4>
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

                    <p class="card-text">Customer Name: {{$ticket->customer_name}}</p>
                    <p class="card-text">Description: {{$ticket->description}}</p>
                    <p class="card-text">Email: {{$ticket->email}}</p>
                    <p class="card-text">Phone No: {{$ticket->phone_no}}</p>
                    <p class="card-text">Reference No: {{$ticket->reference_no}}</p>

                    <hr>
                    <h3>Reply</h3>
                    <form method="POST" action="/reply/support-ticket">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="hidden" value="{{$ticket->id}}" name="id">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" value="{{ old('description') }}" required placeholder="Add your reply here"></textarea>
                            @error('description')
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