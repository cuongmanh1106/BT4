

@extends('include.layout')
@section('title', 'Insert a user')


@section('content')
<!-- End .content-box-header -->

<!-- @if(Session::has('ok'))
   
    <script>alert('{{ Session::get('ok') }}')</script> 

@elseif(Session::has('fail'))
    
    <p>Thất bại</p>
@else 

@endif -->


<!--Validator kiem tra loi-->

 <section id="main-content">
    <section class="wrapper">
        <div class="form-w3layouts">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Insert a user
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                               @if (count($errors) > 0)
                                <ul>
                                  @foreach($errors->all() as $err)
                                    <li style="color: red">{{ $err }}</li>
                                    <!--<script type="text/javascript">alert('{!! $err !!}')</script>-->
                                  @endforeach
                                </ul>
                                @endif
                                
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                    <h4 class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }}<button class="close" data-dismiss="alert" aria-label="close">&times;</button></h4>
                                    
                                    @endif
                                @endforeach
                                <form method="POST" enctype="multipart/form-data" class="cmxform form-horizontal " id="commentForm" method="get" action="{{ route('users.store')}}" novalidate="novalidate">
                                    {{ csrf_field() }}
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Name (required)</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="cname" name="name" minlength="2" type="text" required="">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Email (required)</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="cname" name="email" minlength="2" type="email" required="">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-3">Level (required)</label>
                                        <div class="col-lg-6">
                                            <select class="form-control input-lg m-bot15" name="level">
                                                <option value="1">Admin</option>
                                                <option value="2">SuperAdmin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="curl" class="control-label col-lg-3">Password </label>
                                        <div class="col-lg-6">
                                            <input class="form-control " name="password" id="curl" type="password" name="password">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <input class="btn btn-default" type="button" value="Bỏ qua" onclick="window.location='{{ route('users.list') }}'" />
                                        </div>
                                    </div>    
                                </form>

                            </div>

                        </div>
                    </section>
                </div>
            </div>
            
            <!-- page end-->
        </div>
</section>
@endsection