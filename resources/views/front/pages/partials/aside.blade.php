<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
        <header>
            <h3 class="h6">Search the blog</h3>
        </header>
        <form action="blog-search.html" class="search-form">
            <div class="form-group">
                <input type="search" placeholder="What are you looking for?">
                <button type="submit" class="submit"><i class="icon-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            @foreach($latestBlogPosts as $latestBlogPost)
            <a href="{{route('front.pages.blog_post',['id'=>$latestBlogPost->id])}}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{$latestBlogPost->getBlogPostThumbPhotoUrl()}}" alt="Thumb" class="img-fluid"></div>
                    <div class="title"><strong>{{$latestBlogPost->name}}</strong>
                        <div class="d-flex align-items-center">
                            <div class="views"><i class="icon-eye"></i> 500</div>
                            <div class="comments"><i class="icon-comment"></i>12</div>
                        </div>
                    </div>
                </div></a>
            @endforeach
        </div>
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Categories</h3>
        </header>
        @foreach($blogCategories as $blogCategory)
        <div class="item d-flex justify-content-between"><a href="{{route('front.pages.blog_category',['category'=>$blogCategory->name])}}">{{$blogCategory->name}}</a><span>12</span></div>
       @endforeach
    </div>
    <!-- Widget [Tags Cloud Widget]-->
    <div class="widget tags">       
        <header>
            <h3 class="h6">Tags</h3>
        </header>
        <ul class="list-inline">
            @foreach($blogTags as $blogTag)
            <li class="list-inline-item"><a href="{{route('front.pages.blog_tag',['tag'=>$blogTag->name])}}" class="tag">#{{$blogTag->name}}</a></li>
           @endforeach
        </ul>
    </div>
</aside>