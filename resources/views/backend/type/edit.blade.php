@extends('backend.master')

@section('content')

<div class="container">

    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (session()->has('success'))

                <div style="display: flex;
                flex-direction:row; 
                justify-content: 
                space-between;
                align-items:center; 
                " id="alert-area" class="alert alert-success ">
                    <div>
                        {{ session()->get('success') }}
                    </div>
                    <button class="btn btn-success "  id="close_alert_area" >
                        x
                    </button>
                </div>

                @endif

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
                <div class="card-header"> Edit Type </div>
                <div class="card-body">
                    <form action="{{ url('/type/update/'.$type->id)}}" method="POST">  
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Type</label>
                            <input type="text" name="type_name" class="form-control" value="{{ $type->type_name}}" placeholder="Enter type name">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Update type</button>
                    </form>
                </div>
            </div>
        </div>
    
       <div class="col-md-3"></div>
        </div>
    </div>

</div>


<script>
    let alertArea = document.getElementById('alert-area');
    let alertClose = document.getElementById('close_alert_area');
    alertClose.addEventListener('click', function(){
        alertArea.style.display = 'none';
    })
    
</script>


@endsection