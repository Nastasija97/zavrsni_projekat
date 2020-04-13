   
 <div class="post col-md-4">
     <div class="post-thumbnail"><a href="{{route('front.pages.blog_post',['id'=>$latestBlogPost->id])}}"><img src="{{$latestBlogPost->getBlogPostPhoto1Url()}}" alt="BlogPost Image" class="img-fluid"></a></div>
              <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                  <div class="date">{{$latestBlogPost->created_at->diffForHumans(\Carbon\Carbon::now())}} | 2016</div>
                  <div class="category"><a href="/themes/front/blog-category.html">Business</a></div>
                </div><a href="/themes/front/blog-post.html">
                  <h3 class="h4">Ways to remember your important ideas</h3></a>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
              </div>
            </div>
     