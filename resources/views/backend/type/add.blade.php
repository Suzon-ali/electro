@extends('backend.master')

@section('content')

<div class="container">

    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if (session()->has('success'))

                <div id="add-brand-notify" style="display: flex;
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
                <div class="card-header"> Add Brand </div>
                <div class="card-body">
                    <form action="{{ url('/type/store')}}" method="POST">  
                        @csrf
                       
                        <div class="form-group">
                            <label for="type_name">Type</label>
                            <input type="text" name="type_name" class="form-control" value="{{ old('type_name')}}" placeholder="Enter Type name">
                        </div>
                        {{-- <div class="form-group">
                            <label for="name">Publication Status</label>
                            <select name="status" class="form-control" >
                                <option selected disabled> ----Select A Status-----</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div> --}}
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
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
    let notify = document.getElementById('add-brand-notify');
    alertClose.addEventListener('click', function(){
        alertArea.style.display = 'none';
    })

    setTimeout(function(){
        notify.style.display = "none";
        }, 3000);
    
</script>


@endsection