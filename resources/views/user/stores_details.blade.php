@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

              <div class="panel-heading">
              <h1>Store Details</h1>
              </div>

              <div class="panel-body">
               @foreach($stores as $store)
               <ul>
               <h3></h3>
                <a href="/user/stores/{{ $store->id }}">{{ $store->name }}</a>
                 <a href="/user/stores/{{ $store->id }}">{{ $store->location }}</a>
                  <a href="/user/stores/{{ $store->id }}">{{ $store->rate_count }}</a>
                   <a href="/user/stores/{{ $store->id }}">{{ $store->review }}</a>
                    <a href="/user/stores/{{ $store->id }}">{{ $store->description }}</a>
                     <a href="/user/stores/{{ $store->id }}">{{ $store->phone }}</a>
                <br>
                </ul>
               @endforeach
              </div>
            
        </div>
    </div>
</div>

@endsection

