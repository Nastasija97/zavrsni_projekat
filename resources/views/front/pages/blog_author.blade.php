@extends('front._layout.layout')
@section('seo_title',__('Authors Blog'))
@section('content')
<div class="container">
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-8"> 
          <div class="container">
            <h2 class="mb-3 author d-flex align-items-center flex-wrap">
              <div class="avatar"><img src="/themes/front/img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                <span>Posts by author "{{$user->name}}"</span>
              </div>
            </h2>
          <div class="row">
                    @foreach($blogPosts as $blogPost)
                    <!-- post -->
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="{{route('front.pages.blog_post',['id'=>$blogPost->id])}}"><img src="{{$blogPost->getBlogPostPhoto1Url()}}" alt="blog post image" class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{$blogPost->created_at->isoFormat('MMM Do [|] YYYY')}} </div>
                                <div class="category"><a href="{{route('front.pages.blog_category',['category'=>$blogPost->blogCategory->name])}}">{{$blogPost->blogCategory->name}}</a></div>
                            </div><a href="{{route('front.pages.blog_post',['id'=>$blogPost->id])}}">
                                <h3 class="h4">{{$blogPost->name}}</h3></a>
                            <p class="text-muted">{{$blogPost->description}}</p>
                            <footer class="post-footer d-flex align-items-center"><a href="{{route('front.pages.blog_author',['id'=>$blogPost->id,'author'=>$blogPost->author])}}" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="{{$blogPost->getAuthorsProfilePicture()}}" alt="..." class="img-fluid"></div>
                                    <div class="title"><span>{{$blogPost->author}}</span></div></a>
                                <div class="date"><i class="icon-clock"></i> {{$blogPost->created_at->now()}}</div>
                                <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                            </footer>
                        </div>
                    </div>
                    <!-- post             -->
                    @endforeach
                </div>
            <!-- Pagination -->
          <nav aria-label="Page navigation example">
                       {{$blogPosts->links()}}
                    
                </nav>
                
          </div>
        </main>
           @include('front.pages.partials.aside')
      </div>
    </div>
@endsection