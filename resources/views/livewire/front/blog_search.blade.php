    <!-- start section -->
    <section class="section">
        <div class="container">
            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        @if(count($blogs)==0)
                        <center><h2>{{ __('website\search.no_result') }}</h2></center>
                        @else
                            @foreach($blogs as $blog)
                                <!-- start item -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="__item __item--preview">
                                        <figure class="__image">
                                            @if(isset($blog->image->filename))
                                                <img  src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                                data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                                alt="demo" />
                                            @else
                                            <img  src="{{ asset('Dashboard/img/images/blogs-img/blog-article-1.jpg') }}"
                                            data-src="{{ asset('Dashboard/img/images/blogs-img/blog-article-1.jpg') }}" alt="demo" />
                                            @endif
                                        </figure>
                                        <div class="__content">
                                            <p class="__category"><a href="{{ route('blogdetails',encrypt($blog->id) ) }}">{{ $blog->admin->firstname }}</a></p>
                                            <h3 class="__title h5"><a href="{{ route('blogdetails',encrypt($blog->id) ) }}">{{ $blog->title }}</a></h3>
                                            <p>{{ Str::limit($blog->body,50,) }}</p>
                                        </div>
                                        <span class="__date-post">
                                            {{-- <strong>{{ $blog->created_at->diffforhumans() }}</strong> --}}
                                            {{ $blog->created_at->diffforhumans() }}
                                        </span>
                                    </div>
                                </div>
                                <!-- end item -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->
