@extends('layouts.template')
 
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2> Show Blog</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('blog.index') }}"> Back</a>
            </div>
        </div>
    </div>
 
<center>
    
<div class="card" style="width: 20rem;">
                <img src="{{ Storage::url('public/blogs/').$blog->image }}" class="rounded card-img-top" >
  <div class="card-body">
    <h3 class="card-title"><label class="font-weight-bold">{{ $blog->title }}</label>
                </h3>
                <h3><p class="card-text"><label class="font-weight-bold">{!! $blog->content !!}</label>
                </p></h3>
    
  </div>
</div>
</center>
  
    
  
@endsection





  <!-- <div class="card">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label class="font-weight-bold">GAMBAR</label>
                <img src="{{ Storage::url('public/blogs/').$blog->image }}" class="rounded" style="width: 150px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label class="font-weight-bold">JUDUL</label>
                {{ $blog->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label class="font-weight-bold">KONTEN</label>
                {!! $blog->content !!}
            </div>
        </div>
    </div> -->