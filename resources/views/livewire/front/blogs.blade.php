@section('title', __('website\home.blog'))
@section('css')

@endsection
<div>
    <!-- start section -->
    <section class="section">
        
        <div class="container">
            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
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
                                           <img  src="{{ asset('Dashboard/img/blogs/default_blog.jpg') }}"
                                           data-src="{{ asset('Dashboard/img/blogs/default_blog.jpg') }}" alt="demo" />
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
                        {{-- {{ $blogs->links() }} --}}
                        @if (count($blogs))
                        {{ $blogs->links('page-links') }}
                        @endif

                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->

 

    @include('livewire.front._review_form')


    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map"
        data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U"
        data-longitude="44.958309"
        data-latitude="34.109925"
        data-marker="img/marker.png"
        style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>
