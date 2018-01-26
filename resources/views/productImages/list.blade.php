@extends('include.layout')
@section('title', 'Products')


@section('content')


<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     List images of Product <span style="color:green;"><b> {{ $product->name }}</b></span>
    </div>
    <div>
      <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}<button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
            
            @endif
        @endforeach
        <thead>
          <tr>
            <th data-breakpoints="xs">ID</th>
            <th>Name</th>
            <th data-breakpoints="xs sm md" data-title="DOB">Image</th>
          </tr>
        </thead>
        <tbody>
          @foreach($imgs as $img)
          <tr data-expanded="true">
            <td>{{ $img->id }}</td>
            <td>{{ $img->name}}</td>
            <td><img src="{{ asset('/public/images/')}}/{{$img->name}}" width="150px"></td>
            <td>
            <a class="{{ (Auth::user()->level == 1)?'di>
sable':'' }}" onclick="return Xoasanpham()" href="{{ route('pro_img.delete',array($product->id,$img->id)) }}" title="Edit" >
              <img src="{{ asset('/public/images/icons/cross.png') }}" alt="Edit" />
            </a> 
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
      <a class="btn btn-success {{ (Auth::user()->level == 1)?'disabled':'' }}" style="width: 75px; height: 45px;" href="{{ route('pro_img.create',$product->id) }}"><i style="text-align: center; font-size: 20px; line-height: 30px" class="fa fa-plus-circle" aria-hidden="true"></i>
      </a>
      <a class="btn btn-success" style="width: 75px; height: 45px;" href="{{ route('product.list') }}"><span style="font-style: 20px; line-height: 30px;">Back
      </a>
    </div>
  </div</div>
</section>

@endsection