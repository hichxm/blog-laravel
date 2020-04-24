@extends('layouts.default')

@section('content')
<div class="col-md-4">

</div>

<div class="col-md-8">
    @forelse ($posts as $post)
        <div class="card bg-light mb-3">
            <div class="card-header">
                <a href="#" class="text-muted">{{ $post->user->username }}</a>
                <div class="float-right">
                    <span class="text-success" style="cursor: pointer" id="#like-{{ $post->id }}"><i class="fas fa-thumbs-up"></i> 40</span>
                    <span class="text-muted ml-md-1" style="cursor: pointer" id="#comment-{{ $post->id }}"><i class="fas fa-comment"></i> 40</span>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->short_content }}</p>
                <a class="float-right text-muted" href="#">Voir plus <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    @empty

    @endforelse

    {{ $posts->links() }}
</div>
@endsection
