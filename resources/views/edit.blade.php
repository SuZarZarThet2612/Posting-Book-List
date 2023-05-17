@extends('master')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-6 offset-3 ">
            <div class="my-3">
                <a href="{{route('post#updatePage',$post['id'])}}" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-left-long"></i> back</a>
            </div>
            {{-- <h3>{{$post['title']}}</h3>
            <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus sint culpa similique aliquam hic ipsum nesciunt, nihil dolor blanditiis quos dolorum nemo esse cumque cupiditate labore ratione aperiam voluptates illum.
                {{$post['description']}}
            </p> --}}
            <form action="{{route('post#update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="" >Post Title</label>
                <input type="hidden" name="postId" value="{{$post['id']}}">
                <input type="text" name="postTitle" id="" class=" form-control my-3 @error('postTitle') is-invalid @enderror" value="{{old('postTitle',$post['title'])}}" placeholder="Enter post title..." >
                @error('postTitle')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror

                <div class="">
                    <label for="">Image</label>
                    @if ($post['image']==null)
                        <img src="{{asset('image-not-found-1-scaled.png')}}" class="img-thumbnail shadow-sm mt-2">
                    @else
                        <img src="{{asset('storage/'.$post['image'])}}" class="img-thumbnail shadow-sm mt-2">
                    @endif

                    {{-- <img src="{{asset($if($post->image==null)'{{asset('storage/'.$post->image)}}'' @else '{{asset('image-not-found-1-scaled.png')}}" @endif)}}" alt=""> --}}
                </div>
                    <input type="file"  name="postImage" class="form-control @error('postImage') is-invalid  @enderror" value="{{old('postImage')}}" >
                    @error('postImage')
                     <small class="invalid-feedback">{{$message}}</small>
                    @enderror



                <label for="" class="mt-3">Post Description</label>
                <textarea name="postDescription" id="" cols="30" rows="10" class="form-control @error('postDescription') is-invalid @enderror" placeholder="Enter post description" >{{old('postDescription',$post['description'])}}</textarea>
                @error('postDescription')
                    <small class="invalid-feedback">{{$message}}</small>
                @enderror

                <label for="" >Post Fee</label>
                <input type="text" name="postFee" id="" class=" form-control my-3 " value="{{old('postTitle',$post['price'])}}" placeholder="Enter post Fee.." {{old('postFee',$post['price'])}} >


                <label for="" >Post Address</label>
                <input type="text" name="postAddress" id="" class=" form-control my-3 " value="{{old('postTitle',$post['address'])}}" placeholder="Enter post Address..." {{old('postAddress',$post['address'])}}>


                <label for="" >Post Rating</label>
                <input type="text" name="postRating" id="" class=" form-control my-3 " value="{{old('postTitle',$post['rating'])}}" placeholder="Enter post rating..." {{old('postRating',$post['rating'])}}>

                <input type="submit" value="Update" class="btn btn-dark my-3 text-white float-end">
            </form>
        </div>
    </div>

</div>

@endsection
