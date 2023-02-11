@extends('frontend.master')

@section('title')
    Electro | Login
@endsection

@section('content')


<div style="width: 100%; height:auto; display:flex; aling-items:center; justify-content:center;">

    <div style="padding:50px" class="container">

        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                   
    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        </div>
                    @endif
                   
    
                <div class="card">
                    
                    <div class="card-body">
                        <form action="{{ url('/user-login')}}" method="POST">  
                            @csrf
                           
                            <div style="text-align: center; font-size:25px; padding:20px; font-weight:bold"> <h1 >Login</h1> </div>
                            
                            <div style="width: 100% ;padding-right:20px" class="form-group ">
                                <label for="Email">Email</label>
                                <input  type="email" name="email" class="form-control" value="{{ old('name')}}" placeholder="Email">
                            </div>

                            <div style="width: 100% ;padding-right:20px" class="form-group ">
                                <label for="password">Password</label>
                                <input  type="password" name="password" class="form-control" value="{{ old('name')}}" placeholder="Password">
                            </div>

                            <div style="width: 100% ;padding-right:20px; display:flex; justify-content:center" class="form-group ">
                                <button style="width: 200px ;padding:10px; font-size:20px" type="submit" class="btn btn-primary">Login</button>
                            </div>

                            <div style="text-align: center"> Don't have an account ? <a href="{{url('/register')}}">Register here</a></div>
                            

                            
                        </form>
                    </div>

                   
                </div>
            </div>
        
           <div class="col-md-3"></div>
            </div>
        </div>
      
    </div>

</div>

<style>
    input{
        padding: 20px 6px !important;
    }
</style>


@endsection