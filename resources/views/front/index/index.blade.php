@extends('front._layout.layout')
@section('seo_title',__('Blog Index Page'))
@section('content')

<!-- Hero Section-->
    <div id="index-slider" class="owl-carousel">
    
        @foreach($blogPosts as $blogPost)
      <section style="background: url(/themes/front/img/featured-pic-1.jpeg); background-size: cover; background-position: center center" class="hero">
        <div class="container">
          <div class="row">
            <div class="col-lg-7">
              <h1>{{$blogPost->name}}</h1>
              <a href="{{$blogPost->url}}" class="hero-link">{{$blogPost->url_description}}</a>
            </div>
          </div>
        </div>
      </section>
     
        @endforeach
    </div>

    <!-- Intro Section-->
    <section class="intro">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h2 class="h3">Some great intro here</h2>
            <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="featured-posts no-padding-top">
      <div class="container">
          @foreach($importantBlogPosts as $importantBlogPost)
        <!-- Post-->
        
        @include('front.index.single_blog_slide',[
        'blog'=>$importantBlogPost
        ])
        <!-- Post        -->
        @endforeach

       
      </div>
    </section>
    <!-- Divider Section-->
    <section style="background: url(/themes/front/img/divider-bg.jpg); background-size: cover; background-position: center bottom" class="divider">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h2>
            <a href="{{route('front.contact.index')}}" class="hero-link">Contact Us</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Latest Posts -->
    <section class="latest-posts"> 
      <div class="container">
        <header> 
          <h2>Latest from the blog</h2>
          <p class="text-big">Latest posts from Bloggers that you may like.</p>
        </header>
        <div class="owl-carousel" id="latest-posts-slider">
             
          <div class="row">
                 @foreach($latestBlogPosts as $latestBlogPost)
           @include('front.index.single_latest_blog_post',[
           'blog'=>$latestBlogPost
           ])
               @endforeach
          </div>
           
       
        </div>
      </div>
    </section>
    <!-- Gallery Section-->
    <section class="gallery no-padding">    
      <div class="row">
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item">
            <a href="/themes/front/img/gallery-1.jpg" data-fancybox="gallery" class="image">
              <img src="/themes/front/img/gallery-1.jpg" alt="gallery image alt 1" class="img-fluid" title="gallery image title 1">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
            </a>
          </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item">
            <a href="/themes/front/img/gallery-2.jpg" data-fancybox="gallery" class="image">
              <img src="/themes/front/img/gallery-2.jpg" alt="gallery image alt 2" class="img-fluid" title="gallery image title 2">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
            </a>
          </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item">
            <a href="/themes/front/img/gallery-3.jpg" data-fancybox="gallery" class="image">
              <img src="/themes/front/img/gallery-3.jpg" alt="gallery image alt 3" class="img-fluid" title="gallery image title 3">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
            </a>
          </div>
        </div>
        <div class="mix col-lg-3 col-md-3 col-sm-6">
          <div class="item">
            <a href="/themes/front/img/gallery-4.jpg" data-fancybox="gallery" class="image">
              <img src="/themes/front/img/gallery-4.jpg" alt="gallery image alt 4" class="img-fluid" title="gallery image title 4">
              <div class="overlay d-flex align-items-center justify-content-center"><i class="icon-search"></i></div>
            </a>
          </div>
        </div>
        
      </div>
    </section>
    
    @endesction





