   
 <div class="post col-md-4">
     <div class="post-thumbnail"><a 
             href="{{route('front.pages.blog_post',['id'=>$latestBlogPost->id])}}">
             <img src="{{$latestBlogPost->getBlogPostPhoto1Url()}}" alt="BlogPost Image" class="img-fluid"></a></div>
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="date">{{$latestBlogPost->created_at->diffForHumans(\Carbon\Carbon::now())}} | </div>
                  <div class="category"><a href="{{route('front.pages.blog_category',['category'=>$latestBlogPost->blogCategory->name])}}">{{$latestBlogPost->blogCategory->name}}</a></div>
                </div><a href="{{route('front.pages.blog_post',['id'=>$latestBlogPost->id])}}">
                  <h3 class="h4">{{$latestBlogPost->name}}</h3></a>
                <p class="text-muted">{{$latestBlogPost->description}}</p>
              </div>
            </div>
     