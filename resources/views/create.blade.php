@extends('master')

@section('content')


    <div class="container">
        <div class="row mt-5">

            <div class="col-5 ">
                <div class="p-3">
                    @if(session('insertSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('insertSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('updateSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session('updateSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif --}}

                    <form action="{{route('post#create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-group mb-3">
                            <label for="">Post Tilte</label>
                            <input type="text" name="postTitle" class="form-control @error('postTitle') is-invalid  @enderror" value="{{old('postTitle')}}" placeholder="Enter Post Title..." >

                            @error('postTitle')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror



                        </div>
                        <div class="text-group mb-3 ">
                            <label for="">Post Description</label>
                            <textarea cols="30" rows="10" name="postDescription" class="form-control @error('postDescription') is-invalid  @enderror"  placeholder="Enter Post Description..." >{{old('postDescription')}}</textarea>
                            @error('postDescription')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Image</label>
                            <input type="file"  name="postImage" class="form-control @error('postImage') is-invalid  @enderror" value="{{old('postImage')}}" >
                            @error('postImage')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Fee</label>
                            <input type="number"  name="postFee" class="form-control @error('postFee') is-invalid  @enderror" value="{{old('postFee')}}" >
                            @error('postFee')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Address</label>
                            <input type="text"  name="postAddress" class="form-control @error('postAddress') is-invalid  @enderror" value="{{old('postAddress')}}" placeholder="Enter Post Title...">
                            @error('postAddress')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Rating</label>
                            <input type="number"  name="postRating" min="0" max="5" class="form-control @error('postRating') is-invalid  @enderror" value="{{old('postAddress')}}" >
                            @error('postRating')
                             <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="create" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-7 ">
                <h3 class="mb-3">
                    <div class="row">
                        <div class="col-5">Total = {{$post->Total()}}</div>
                        <div class="col-5 offset-2">
                            <form action="{{route('post#createPage')}}" method="get">
                                <div class="row">
                                    <input type="text" name="searchKey" class="form-control col" value="{{request('searchKey')}}" id="" placeholder="Search...">
                                    <button type="submit" class="btn btn-danger col-2 ">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </h3>

                <div class="data-container">
                    @if(count($post)!=0)
                    @foreach($post as $item)
                    <div class="post p-3 shadow-sm mb-3">
                        <div class="row">
                            <h5 class="col-8">{{$item['title']}} | {{$item['id']}} </h5>
                            <span class="col-3 offset-1">{{$item['created_at']->format("d-M-Y")}}</span>
                        </div>
                        <p class="text-muted">{{Str::words($item['description'],25,'...')}}</p>

                        <span>
                            <small>
                                <i class="fa-solid fa-money-bill-1 text-primary"></i>{{$item->price}} kyats
                            </small>
                        </span> |
                        <span>
                            <small>
                                <i class="fa-solid fa-location-dot text-danger"></i>{{$item->address}}
                            </small>
                        </span> |
                        <span>
                            <small>
                                {{$item->rating}}<i class="fa-solid fa-star text-warning"></i>
                            </small>
                        </span>
                        <div class="text-end">
                            <a href="{{url('post/delete/'.$item['id'])}}">
                                <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            </a>
                            <a href="{{route('post#updatePage',$item['id'])}}">
                                <button class="btn btn-primary"><i class="fa-solid fa-file-lines"></i> Detail</button>
                            </a>
                        </div>
                        </div>
                    @endforeach


                    @else
                    <h3 class="text-danger text-center m-5">There is not data...</h3>
                    @endif
                </div>
                {{$post->appends(request()->query())->Links()}}
            </div>

        </div>
    </div>

@endsection
