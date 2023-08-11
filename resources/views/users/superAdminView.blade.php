@extends('layouts.app')
@section('content')
<div>
    @if(session()->has('message'))
    <div class="alert alert-success" id="alert">
        <button type="button" class="close" data-dismiss="alert">X</button>
        {{session()->get('message')}}
    </div>    
    @endif
</div>
<div class="container"> 
    <table class="table">
        <thead>
        <?php $count=1; ?>
            <tr>
                <th>S.NO.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td scope="row">{{$count}}</td>
                <?php $count++ ?>
                <td scope="row">{{$user->name}}</td>
                <td scope="row">{{$user->email}}</td>
                <td scope="row">{{$user->phone}}</td>
                <td scope="row">{{$user->address}}</td>
                <td scope="row"><img style="height:50px;width:80px;" src="{{ asset('storage/uploads/' . $user->photo) }}" alt="Image"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
    $("document").ready(function(){
        setTimeout(() => {
            $("div.alert").remove();
        }, 3000);
    });
</script>
@endsection