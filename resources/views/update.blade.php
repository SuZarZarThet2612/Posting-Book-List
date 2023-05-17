@extends('master')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3 ">
            <div class="my-3">
                <a href="{{route('post#home')}}" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-left-long"></i> back</a>
            </div>

            <h3>{{$post['title']}}</h3>
            <div class="d-flex">
                <div class="btn btn-dark btn-sm text-white my-3 me-2"><i class="fa-solid fa-money-bill-1 text-primary"></i> {{$post->price}}</div>
                <div class="btn btn-dark btn-sm text-white my-3 me-2"><i class="fa-solid fa-location-dot text-danger"></i> {{$post->address}}</div>
                <div class="btn btn-dark btn-sm text-white my-3 me-2">{{$post->rating}} <i class="fa-solid fa-star text-warning"></i></div>
                <div class="btn btn-dark btn-sm text-white my-3 me-2"><i class="fa-solid fa-calendar"></i> {{$post->created_at->format("j-F-Y")}}</div>
                <div class="btn btn-dark btn-sm text-white my-3 me-2"><i class="fa-solid fa-clock"></i> {{$post->created_at->format("h:m:s")}}</div>
            </div>
            <div class="">
                @if ($post->image==null)
                    <img src="{{asset('image-not-found-1-scaled.png')}}" class="img-thumbnail shadow-sm my-4">
                @else
                    <img src="{{asset('storage/'.$post->image)}}" class="img-thumbnail shadow-sm my-4">
                @endif

                {{-- <img src="{{asset($if($post->image==null)'{{asset('storage/'.$post->image)}}'' @else '{{asset('image-not-found-1-scaled.png')}}" @endif)}}" alt=""> --}}
            </div>
            <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus sint culpa similique aliquam hic ipsum nesciunt, nihil dolor blanditiis quos dolorum nemo esse cumque cupiditate labore ratione aperiam voluptates illum.
                {{$post['description']}}
            </p>

        </div>
    </div>
    <div class="row my-3">
        <div class="col-3 offset-7">
            <a href="{{route('post#editPage',$post['id'])}}">
                <button class="btn bg-dark text-white">Edit</button>
            </a>
        </div>
    </div>
</div>

@endsection
