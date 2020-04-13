<div class="row d-flex align-items-stretch">
    <div class="text col-lg-7">
        <div class="text-inner d-flex align-items-center">
            <div class="content">
                <header class="post-header">
                    <div class="category"><a href="{{route('front.pages.blog_category',['category'=>$importantBlogPost->blogCategory->name])}}">{{$importantBlogPost->blogCategory->name}}</a></div><a href="/themes/front/blog-post.html">
                        <h2 class="h4">{{$importantBlogPost->name}}</h2></a>
                </header>
                <p>{{$importantBlogPost->description}}</p>
                <footer class="post-footer d-flex align-items-center"><a href="{{route('front.pages.blog_author',['author'=>Auth::user()->name])}}" class="author d-flex align-items-center flex-wrap">
                        <div class="avatar"><img src="/themes/front/img/avatar-1.jpg" alt="..." class="img-fluid"></div>
                         <div class="title"><span>{{Auth::user()->name}}</span></div></a>
                    <div class="date"><i class="icon-clock"></i></div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                </footer>
            </div>
        </div>
    </div>
    <div class="image col-lg-5"><img src="{{$importantBlogPost->getBlogPostPhoto1Url()}}" alt="..."></div>
</div>
