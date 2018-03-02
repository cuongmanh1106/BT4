@extends('include.layout')
@section('title', 'Edit users')


@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
 <div class="panel panel-default">
    <div class="panel-heading">
     Edit users
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
            <th>User name</th>
            <th data-breakpoints="xs">Email</th>
            <th data-breakpoints="xs sm md" data-title="DOB">Level</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <?php
            if($user->level == 2) {
                $level = "SuperAdmin";
            }
            else if ($user->level == 1) {
                $level = "Admin";
            } else if ($user->level == 0) {
                $level = "Member";
            } else if ($user->level == 3) {
                $level == "Manage page";
            }
           
          ?>
          <tr data-expanded="true">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name}}</td>
            <td>{{ $user->email}}</td>  
            <td>{{ $level}}</td>
            <td>
                <a class="{{ (Auth::user()->level == 1)?'disable':'' }}" href="{!! route('users.edit',$user->id) !!}" title="Edit" >
                    <img src="{{ asset('/public/images/icons/pencil.png') }}" alt="Edit" />
                </a> 

                <a class="{{ (Auth::user()->level == 1)?'disable':'' }}" onclick="return Xoasanpham()" href="{!! route('users.delete',$user->id) !!}" title="Edit" >
                    <img src="{{ asset('/public/images/icons/cross.png') }}" alt="Edit" />
                </a> 

            </td>
          </tr>
         @endforeach

        </tbody>
      </table>
     
    </div>
  </div>
</div>
</section>

@endsection