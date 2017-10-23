@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

              <div class="panel-heading">
              <h1>{{ $store->name}}</h1>
              <br>
              <h4><i>Location :{{ $store->location }}</h2></i>
              <br>
              <h4><i>Phone :{{ $store->phone }}</h2></i>
              <br>
              <h4><i>Rate :{{ $store->rate_count }}</h2></i>
              <br>
              
             
              </div>
                 <div class="logo">
           
                <img src="{{asset($store->logo)}}" style="">
           
                <img src="{{asset('art/default_pp.png')}}" style="">
            

        </div>
              <div class="panel-body">
               
                <a href="/admin/accept/{{ $event->id }}" id="accept">Accept Request</a>

                <br>

               
                
                  <div id="deleteReq" style="display: none;">
                  <form method="POST" action="/user/stores/{{ $store->id }}">
              <div class="form-group">
                <button type="submit" class="btn">Details</button>
            </div>
          </form>
          </div>
               
              </div>
                
          </div>
            
        </div>
    </div>
</div>

@endsection




