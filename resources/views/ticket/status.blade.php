@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
          <div class="card-body">
              <div class="card">
                <h4 class="card-header">Ticket Status</h4>
                <div class="card-body">
                    <p>Status: {{$status}}</p>

                    @if($ticket->reply->isNotEmpty())
                    @foreach($ticket->reply as $reply)
                    <p>{{$reply->reply}}</p>
                    @endforeach
                    @endif
                
                </div>
              </div>
          </div>
        </div>

    </div>
</div>

@endsection