
<div>
    <!-- start section -->
    @section('title', __('website\home.home'))
    @section('css')

    @endsection
      {{-- ********************** Home 2 ****************************************** --}}
    <section class="section section--no-pt section--no-pb">
        <div class="container-fluid">
            <!-- start promo banners -->
            <div class="promo-banners">
                <div class="__inner">
                    <div class="row">
                        @foreach (\App\Models\Blog::orderByDesc('created_at')->limit(3)->get() as $blog)
                        <div class="col-12 col-md-6 col-lg-4">
                            @if($blog->image->filename)
                            <a class="__item" href="{{ route('blogdetails',$blog->id) }}"><img src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                alt="demo" class="img-fluid " style="width:620px; height:210px" /></a>
                            @else
                            <a class="__item" href="#"><img src="{{ asset('frontassets/img/promo-banners_img/1.jpg') }}" alt="demo" class="img-fluid w-100" /></a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end promo banners -->

            <div class="spacer py-4 py-lg-6"></div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <div class="container">
            <!-- start advantages -->
            <div class="advantages">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg">
                            <div class="__item">
                                <i class="__ico">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#ff9191" viewBox="0 0 512 512"><path d="M133.565 150.261h244.87v22.261h-244.87zM356.174 183.652h22.261v22.261h-22.261zM133.565 183.652h22.261v22.261h-22.261zM244.87 77.913h22.261v22.261H244.87zM278.261 77.913h22.261v22.261h-22.261zM211.478 77.913h22.261v22.261h-22.261zM178.087 77.913h22.261v22.261h-22.261zM311.652 77.913h22.261v22.261h-22.261z"/><path d="M459.458 479.918c-9.766 5.209-18.233 9.708-35.892 9.812l65.603-196.819a11.132 11.132 0 00-5.992-13.669l-60.22-27.098V144.696c0-18.412-14.979-33.391-33.391-33.391H372.87V55.652c0-6.147-4.983-11.13-11.13-11.13h-94.61V0h-22.26v44.522h-94.609c-6.147 0-11.13 4.983-11.13 11.13v55.652h-16.696c-18.412 0-33.391 14.979-33.391 33.391v107.441l-60.221 27.105a11.128 11.128 0 00-5.99 13.669l65.603 196.818c-17.66-.104-26.126-4.602-35.892-9.811-10.933-5.83-23.325-12.439-46.977-12.439v22.261c18.087 0 26.621 4.551 36.501 9.821C53 505.391 65.391 512 89.044 512c6.261 0 11.602-.414 16.322-1.263 13.658-2.149 22.685-6.958 30.651-11.203 9.864-5.256 18.382-9.795 36.398-9.795 18.087 0 26.62 4.551 36.501 9.821 10.932 5.831 23.324 12.44 46.976 12.44s36.044-6.609 46.977-12.439c9.88-5.27 18.414-9.821 36.501-9.821 18.079 0 26.624 4.539 36.518 9.796 7.991 4.244 17.043 9.053 30.75 11.202 4.718.85 10.057 1.263 16.318 1.263 23.652 0 36.044-6.609 46.977-12.439 9.881-5.27 18.414-9.821 36.501-9.821V467.48c-23.651-.002-36.043 6.607-46.976 12.438zm5.411-184.505l-7.981 23.943-189.758-87.187v-25.738l197.739 88.982zM161.391 66.783h189.217v44.522H161.391V66.783zm-50.087 77.913c0-6.137 4.993-11.13 11.13-11.13h267.13c6.137 0 11.13 4.993 11.13 11.13v97.429l-140.129-63.057a11.12 11.12 0 00-9.135 0L111.302 242.12v-97.424zM47.132 295.413l197.738-88.981v25.738L55.112 319.356l-7.98-23.943zm354.004 191.209c-5.407-1.759-9.886-4.132-14.806-6.745-10.938-5.811-23.337-12.398-46.961-12.398-23.652 0-36.044 6.609-46.977 12.439-9.882 5.27-18.414 9.822-36.501 9.822s-26.621-4.551-36.501-9.822c-10.932-5.83-23.325-12.439-46.977-12.439-23.576 0-35.949 6.593-46.865 12.409-4.884 2.602-9.332 4.965-14.689 6.719L62.192 340.6l182.677-83.932v132.897h22.261V256.668l182.677 83.933-48.671 146.021z"/></svg>
                                </i>

                                <h4 class="__title h6">Free Shipping On Order Over $120</h4>

                                <span>Free shipping on all order</span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg">
                            <div class="__item">
                                <i class="__ico">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#5e9a4b" viewBox="0 0 512.004 512"><path d="M490.926 213.906l-6.586-4.926a22.073 22.073 0 01-7.082-26.425l3.242-7.559c6.586-15.379 5.566-32.508-2.797-46.992-8.367-14.488-22.687-23.938-39.3-25.918l-8.165-.977a22.068 22.068 0 01-19.347-19.343l-.973-8.168C407.934 56.988 398.484 42.664 384 34.3c-14.488-8.367-31.617-9.387-46.992-2.797l-7.563 3.238a22.068 22.068 0 01-26.425-7.082l-4.926-6.582C288.07 7.684 272.73.004 256 .004s-32.07 7.68-42.094 21.074l-4.93 6.582a22.061 22.061 0 01-26.425 7.082l-7.559-3.238c-15.379-6.586-32.508-5.57-46.992 2.797-14.488 8.363-23.937 22.687-25.918 39.297l-.977 8.164a22.068 22.068 0 01-19.347 19.347l-8.164.977c-16.61 1.98-30.934 11.43-39.297 25.918-8.367 14.484-9.383 31.613-2.797 46.992l3.238 7.559a22.068 22.068 0 01-7.082 26.425l-6.582 4.926C7.684 223.93 0 239.273 0 256c0 16.73 7.684 32.074 21.074 42.098l6.586 4.925a22.073 22.073 0 017.082 26.426l-3.242 7.559c-6.586 15.379-5.566 32.508 2.797 46.992 8.367 14.488 22.687 23.938 39.3 25.918l8.165.977a22.068 22.068 0 0119.347 19.343l.973 8.168c1.984 16.61 11.434 30.934 25.918 39.297 14.488 8.363 31.617 9.383 46.992 2.797l7.563-3.238a22.068 22.068 0 0126.425 7.082l4.926 6.582c10.024 13.394 25.367 21.078 42.098 21.078 16.726 0 32.07-7.684 42.094-21.078l4.925-6.582a22.064 22.064 0 0126.43-7.078l7.559 3.234c15.375 6.586 32.504 5.57 46.992-2.793 14.484-8.367 23.934-22.691 25.918-39.3l.973-8.165a22.068 22.068 0 0119.347-19.347l8.164-.973c16.61-1.984 30.938-11.434 39.301-25.918 8.363-14.488 9.383-31.617 2.793-46.996l-3.234-7.555a22.067 22.067 0 017.082-26.43l6.582-4.925c13.394-10.024 21.074-25.368 21.074-42.094-.004-16.73-7.688-32.074-21.078-42.098zm-11.985 68.18l-6.582 4.926a42.006 42.006 0 00-13.48 50.316l3.234 7.555c4.082 9.527 3.45 20.14-1.73 29.117-5.184 8.98-14.059 14.832-24.352 16.063l-8.164.972a42.009 42.009 0 00-36.832 36.836l-.976 8.164c-1.23 10.293-7.082 19.168-16.059 24.352-8.977 5.18-19.59 5.812-29.117 1.73l-7.559-3.238a42.014 42.014 0 00-50.316 13.484l-4.926 6.582c-6.21 8.297-15.719 13.059-26.082 13.059-10.367 0-19.875-4.762-26.086-13.059l-4.926-6.582c-8.168-10.918-20.73-16.914-33.675-16.914a42.222 42.222 0 00-16.637 3.43l-7.559 3.238c-9.531 4.082-20.14 3.45-29.12-1.73-8.977-5.184-14.829-14.059-16.06-24.352l-.972-8.164a42.012 42.012 0 00-36.836-36.832l-8.164-.977c-10.293-1.23-19.168-7.082-24.352-16.058-5.18-8.977-5.812-19.59-1.73-29.117l3.238-7.559a42.019 42.019 0 00-13.48-50.316l-6.586-4.926C24.758 275.875 20 266.367 20 256c0-10.363 4.758-19.871 13.059-26.082l6.582-4.926c15.62-11.691 21.168-32.383 13.48-50.316l-3.234-7.559c-4.082-9.527-3.45-20.14 1.73-29.117 5.184-8.977 14.059-14.828 24.352-16.059l8.164-.976a42.005 42.005 0 0036.832-36.832l.976-8.164c1.23-10.293 7.082-19.168 16.059-24.352 8.977-5.183 19.59-5.812 29.117-1.73l7.559 3.234a42.014 42.014 0 0050.316-13.48l4.926-6.582C236.128 24.762 245.637 20 256 20s19.871 4.762 26.082 13.059l4.93 6.586a42.008 42.008 0 0050.312 13.48l7.559-3.238c9.527-4.082 20.14-3.45 29.117 1.73 8.977 5.184 14.832 14.059 16.059 24.352l.976 8.164a42.008 42.008 0 0036.832 36.832l8.164.976c10.293 1.23 19.168 7.082 24.352 16.059 5.183 8.977 5.812 19.59 1.734 29.117l-3.238 7.559a42.012 42.012 0 0013.48 50.316l6.582 4.926c8.301 6.21 13.059 15.719 13.059 26.086 0 10.363-4.758 19.871-13.059 26.082zm0 0"/><path d="M256 58.121c-30.168 0-59.137 6.617-86.098 19.668-4.972 2.406-7.05 8.387-4.648 13.356 2.406 4.972 8.39 7.05 13.36 4.644C202.835 84.066 228.87 78.121 256 78.121c98.082 0 177.879 79.797 177.879 177.883 0 98.082-79.797 177.879-177.879 177.879-98.086 0-177.883-79.797-177.883-177.88 0-40.175 13.067-78.081 37.79-109.624 3.406-4.348 2.644-10.633-1.704-14.043-4.348-3.406-10.633-2.64-14.039 1.703-27.504 35.102-42.043 77.274-42.043 121.965 0 109.11 88.77 197.879 197.879 197.879s197.879-88.77 197.879-197.88c0-109.112-88.77-197.882-197.879-197.882zm0 0"/><path d="M109.79 205.086l-7.618 9.71c-3.41 4.349-2.649 10.634 1.695 14.04 4.348 3.41 10.633 2.652 14.04-1.695l4.183-5.328v66.136h-6.695c-5.524 0-10 4.477-10 10 0 5.524 4.476 10 10 10h33.046c5.52 0 10-4.476 10-10 0-5.523-4.48-10-10-10h-6.351v-76.691c0-5.524-4.48-10-10-10h-14.434a9.994 9.994 0 00-7.867 3.828zm0 0M190.148 307.95h5.196c16.515 0 29.949-13.434 29.949-29.95v-48.473c0-16.515-13.438-29.953-29.95-29.953h-5.195c-16.515 0-29.949 13.438-29.949 29.953V278c0 16.516 13.434 29.95 29.95 29.95zm-9.949-78.423c0-5.488 4.465-9.953 9.95-9.953h5.195c5.484 0 9.949 4.465 9.949 9.953V278c0 5.484-4.465 9.95-9.95 9.95h-5.195c-5.484 0-9.949-4.466-9.949-9.95zm0 0M270.738 307.95c16.516 0 29.95-13.434 29.95-29.95v-48.473c0-16.515-13.438-29.953-29.95-29.953h-5.195c-16.516 0-29.95 13.438-29.95 29.953V278c0 16.516 13.434 29.95 29.95 29.95zM255.594 278v-48.473c0-5.488 4.465-9.953 9.949-9.953h5.195c5.485 0 9.95 4.465 9.95 9.953V278c0 5.484-4.465 9.95-9.95 9.95h-5.195c-5.484 0-9.95-4.462-9.95-9.95zm0 0M402.8 198.36c-4.464-3.247-10.718-2.258-13.968 2.206l-63.539 87.38c-3.25 4.468-2.262 10.722 2.207 13.968a9.992 9.992 0 0013.969-2.207l63.539-87.379c3.25-4.465 2.258-10.719-2.207-13.969zm0 0M165.93 160.277a9.967 9.967 0 006.57-2.464 126.905 126.905 0 0183.5-31.305c28.75 0 55.863 9.367 78.41 27.086 4.344 3.414 10.63 2.66 14.043-1.684 3.41-4.34 2.656-10.629-1.683-14.039-26.11-20.52-57.497-31.363-90.77-31.363a146.905 146.905 0 00-96.652 36.238c-4.16 3.633-4.59 9.95-.957 14.11a9.972 9.972 0 007.539 3.421zm0 0M164.09 369.176c26.101 20.515 57.492 31.36 90.765 31.36 23.086 0 45.188-5.204 65.696-15.462 4.937-2.469 6.937-8.476 4.469-13.418-2.473-4.937-8.477-6.937-13.418-4.469-17.704 8.86-36.797 13.348-56.747 13.348-28.746 0-55.863-9.363-78.41-27.086-4.34-3.41-10.629-2.656-14.039 1.684-3.414 4.344-2.66 10.629 1.684 14.043zm0 0M354.2 352.07c-2.212-3.312-6.352-5.03-10.262-4.25-4.149.832-7.415 4.301-7.965 8.5-.54 4.078 1.578 8.184 5.203 10.121 3.64 1.95 8.219 1.414 11.324-1.308 3.734-3.285 4.398-8.934 1.7-13.063zm0 0M337.223 196.45c-12.977 0-23.536 10.554-23.536 23.53 0 12.977 10.56 23.536 23.536 23.536 12.972 0 23.53-10.559 23.53-23.536 0-12.976-10.558-23.53-23.53-23.53zm0 27.066c-1.95 0-3.536-1.586-3.536-3.536s1.586-3.535 3.536-3.535a3.536 3.536 0 010 7.07zm0 0M369.191 280.926c0 12.976 10.559 23.535 23.532 23.535 12.976 0 23.535-10.559 23.535-23.535 0-12.977-10.559-23.535-23.535-23.535-12.973 0-23.532 10.558-23.532 23.535zm27.067 0a3.536 3.536 0 01-3.531 3.535c-1.95 0-3.536-1.586-3.536-3.535s1.586-3.535 3.536-3.535a3.536 3.536 0 013.53 3.535zm0 0M129.473 113.453c1.609 3.863 5.539 6.356 9.718 6.16 4.125-.195 7.75-3.015 9.024-6.93 1.285-3.953-.113-8.468-3.426-10.988-3.379-2.57-8.098-2.718-11.637-.379-3.945 2.606-5.46 7.79-3.68 12.137zm0 0"/></svg>
                                </i>

                                <h4 class="__title h6">Member Discount</h4>

                                <span>Back guarantee under 7 days</span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg">
                            <div class="__item">
                                <i class="__ico">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#ffbb4c" viewBox="-29 0 487 487.719"><path d="M220.867 266.176a7.616 7.616 0 00-2.742-.094c-9.16-1.066-16.07-8.816-16.086-18.035a8 8 0 00-16 0c.024 15.394 10.32 28.879 25.164 32.953v8a8 8 0 0016 0v-7.516c17.133-3.586 28.777-19.543 26.977-36.953-1.805-17.41-16.473-30.64-33.977-30.644-10.031 0-18.164-8.133-18.164-18.164s8.133-18.164 18.164-18.164 18.164 8.132 18.164 18.164a8 8 0 0016 0c-.023-16.164-11.347-30.106-27.164-33.442V155a8 8 0 00-16 0v7.77c-16.508 4.507-27.133 20.535-24.86 37.496s16.747 29.62 33.86 29.617c9.899 0 17.973 7.926 18.152 17.82.184 9.895-7.597 18.113-17.488 18.473zm0 0"/><path d="M104.195 222.5c0 64.07 51.938 116.008 116.008 116.008S336.211 286.57 336.211 222.5s-51.938-116.008-116.008-116.008c-64.039.07-115.933 51.969-116.008 116.008zm116.008-100.008c55.234 0 100.008 44.774 100.008 100.008s-44.774 100.008-100.008 100.008S120.195 277.734 120.195 222.5c.063-55.207 44.801-99.945 100.008-100.008zm0 0"/><path d="M375.648 358.23l-62.668 29.61a51.043 51.043 0 00-43.515-26.852l-57.852-1.59a61.1 61.1 0 01-26.293-6.789l-5.886-3.05a103.833 103.833 0 00-96.176.101l.367-13.336a8 8 0 00-7.777-8.219L12.41 326.36a7.997 7.997 0 00-8.215 7.778L.363 473.347a8 8 0 007.778 8.22l63.437 1.746h.219a8 8 0 008-7.782l.183-6.66 16.48-8.824a28.269 28.269 0 0121.099-2.309l98.414 27.621c.172.051.343.09.52.13a105.348 105.348 0 0021.628 2.23 106.739 106.739 0 0044.59-9.73 7.43 7.43 0 00.992-.548l142.692-92.296a8.004 8.004 0 002.62-10.657c-10.593-18.797-34.09-25.957-53.367-16.258zM16.578 465.793l3.39-123.219 47.442 1.305-3.39 123.223zm258.926-2.094a90.704 90.704 0 01-55.469 6.192l-98.148-27.551a44.236 44.236 0 00-32.977 3.605l-8.422 4.512 2.254-81.926a87.938 87.938 0 0189.336-4.765l5.887 3.05a77.267 77.267 0 0033.21 8.579l57.856 1.59c16.25.468 30.051 12.038 33.348 27.96l-86.176-2.379c-4.418-.12-8.094 3.364-8.219 7.778a8.003 8.003 0 007.778 8.219l95.101 2.617h.223a8 8 0 007.992-7.782 50.772 50.772 0 00-.773-10.378l64.277-30.372c.063-.027.125-.058.188-.09a24.443 24.443 0 0127.64 3.872zm0 0M228.203 84V8a8 8 0 00-16 0v76a8 8 0 0016 0zm0 0M288.203 84V48a8 8 0 00-16 0v36a8 8 0 0016 0zm0 0M168.203 84V48a8 8 0 00-16 0v36a8 8 0 0016 0zm0 0"/></svg>
                                </i>

                                <h4 class="__title h6">Money Return</h4>

                                <span>Support online 24 hours a day</span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg">
                            <div class="__item">
                                <i class="__ico">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#7fcffc" viewBox="0 0 422.694 422.694"><path d="M333.069 311.067a691.423 691.423 0 005.04-84 52.639 52.639 0 0017.2-15.28c12.88-18.16 13.92-44.08 3.2-77.12a7.997 7.997 0 00-3.2-4.16l-5.36-3.6a120.64 120.64 0 00-28.8-81.76c-24-26.56-60.72-40-109.44-40s-85.52 13.76-109.44 40a120.64 120.64 0 00-28.8 81.76l-5.36 3.6a7.997 7.997 0 00-3.2 4.16c-18.56 57.2 2.16 81.84 19.84 92.24a591.1 591.1 0 004.56 84.4c-43.52 17.04-90.64 47.36-89.28 98.24a8 8 0 008 8h406.64a8 8 0 008-8c1.28-51.12-46.32-81.52-89.6-98.48zM85.007 207.001c-15.928-16.007-12.889-42.764-6.018-65.054l6.8-4.56a8 8 0 003.52-7.44 106.963 106.963 0 0124.64-74.48c20.72-22.72 53.52-34.48 97.36-34.64 43.84-.16 76.64 11.92 97.44 34.88a106.963 106.963 0 0124.64 74.48 8 8 0 003.52 7.44l6.88 4.56c8 26.64 7.6 46.88-1.84 60.24a35.054 35.054 0 01-4.4 5.04c-2.8-60.72-17.04-106.24-42.8-135.6a108.24 108.24 0 00-42.32-29.76h-.72a132.16 132.16 0 00-45.92-8.56 96.96 96.96 0 00-76.88 32.96c-30.498 34.49-41.155 90.65-43.902 140.494zm186.542 73.746l.08-.32a90.65 90.65 0 0012.96-21.36 92.36 92.36 0 004.8-14.56l21.2-8.96a69.277 69.277 0 0011.6-2.08 695.336 695.336 0 01-4.64 72 368.1 368.1 0 00-45.76-12.08v-11.36a7.52 7.52 0 00-.24-1.28zm-34.56-22.88a8.96 8.96 0 11-8.96-8.96 8.959 8.959 0 018.8 9.28l.16-.32zm-9.04-24.64l.08-.32c-13.785-.092-25.034 11.009-25.125 24.793s11.009 25.034 24.793 25.125c13.104.087 24.044-9.974 25.052-23.039l17.2-7.28c-14.08 33.04-48.48 45.68-58.48 48.72-43.84-24-66.56-48-65.68-71.36 1.44-37.28 61.12-64 67.92-67.2a92.322 92.322 0 0036.48-26.4c20.56 37.52 28.8 69.84 24.88 96.64l-26.4 11.12a24.961 24.961 0 00-20.72-10.799zm-127.28-13.28l.32-.24c1.52-50.08 10.4-109.12 40-143.04a80.001 80.001 0 0164.64-27.52 120.014 120.014 0 0134.8 5.44 64.005 64.005 0 002.88 22.16c3.44 13.28 6.96 26.96 0 40v.56a7.957 7.957 0 00-.4.8c0 .72-6.08 17.2-35.44 29.92-12.64 5.44-75.76 35.12-77.52 81.2-.64 16.64 6.8 32.88 22.08 48.72a8 8 0 00-1.04 3.68v11.28a367.515 367.515 0 00-46.56 12.32 609.02 609.02 0 01-3.84-80.48 8.006 8.006 0 00.08-4.8zm208.08-.56a8.004 8.004 0 00-2.88.64l-13.6 5.76c1.28-30.08-9.6-65.44-32.96-105.36a72.004 72.004 0 000-48c-1.04-3.84-2-8-2.56-11.12a92.856 92.856 0 0126.24 20.8c24.56 28.08 37.76 73.12 39.28 134.4a51.433 51.433 0 01-13.52 2.88zm-105.44 181.92H16.269c6.32-60.08 104-85.2 134.56-91.68v14c0 18.16 22.08 32 52.48 34.32v43.36zm-36.48-77.6v-32a263.096 263.096 0 0040 25.36 8.004 8.004 0 003.76.96h1.76a121.275 121.275 0 0043.52-21.76v27.6c0 7.6-17.36 18.56-44.48 18.56-27.12 0-44.56-11.36-44.56-18.72zm52.48 77.6v-43.28c30.4-2.08 52.48-16 52.48-34.32v-14c30.8 6.4 128 31.44 134.56 91.68l-187.04-.08z"/></svg>
                                </i>

                                <h4 class="__title h6">Online Support</h4>

                                <span>Online Support 24/7</span>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end advantages -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo"/>
        </div>

        <div class="container">
            <div class="section-heading section-heading--left" data-aos="fade">
                <h2 class="__title">{{ __('Admin/site.products') }}</h2>
            </div>

            <!-- start goods -->
            <div class="goods goods--style-1 goods--slider">
                <div class="js-slick"
                    data-slick='{
                        "autoplay": true,
                        "arrows": false,
                        "dots": true,
                        "speed": 1200,
                        "responsive": [
                        {
                            "breakpoint": 575,
                            "settings":{
                                "rows": 2,
                                "slidesToShow": 2,
                                "slidesToScroll": 2
                            }
                        },
                        {
                            "breakpoint": 767,
                            "settings":{
                                "rows": 2,
                                "slidesToShow": 3,
                                "slidesToScroll": 3
                            }
                        },
                        {
                            "breakpoint": 991,
                            "settings":{
                                "rows": 2,
                                "slidesToShow": 4,
                                "slidesToScroll": 2
                            }
                        },
                        {
                            "breakpoint": 1199,
                            "settings":{
                                "rows": 2,
                                "slidesToShow": 4,
                                "slidesToScroll": 2
                            }
                        }]
                    }'>
                    <!-- start item  12 product here to show-->
                    @foreach (\App\Models\Product::latest()->limit(12)->get() as $product)
                        <div class="__item">
                            <figure class="__image">
                                @if($product->image->filename)
                                <a href="{{ route('product_details',$product->id) }}">
                                    <img width="188" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                </a>
                                @else
                                <a href="{{ route('product_details',$product->id) }}">
                                    <img width="188" src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                </a>
                                @endif
                            </figure>

                            <div class="__content">
                                <h4 class="h6 __title"><a href="{{ route('product_details',$product->id) }}">{{ $product->name }}</a></h4>

                                <div class="__category"><a href="#">Fruits</a></div>

                                <div class="product-price">
                                    <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                </div>

                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"
                                wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})" >
                                    <i class="fontello-shopping-bag"></i>{{ __('Admin/site.addtocart') }}</a>
                            </div>

                            <span class="product-label product-label--sale">Sale</span>
                        </div>
                    <!-- end item -->
                    @endforeach
                </div>
            </div>
            <!-- end goods -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb section--gutter">
        <div class="container-fluid px-md-0">
            <!-- start banner simple -->
            <div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
                <div class="d-none d-lg-block">
                    <img class="img-logo img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />
                </div>

                <div class="row no-gutters">
                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/banner_bg_3.jpg') }}" alt="demo" /></a>
                    </div>

                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/banner_bg_4.jpg') }}" alt="demo" /></a>
                    </div>
                </div>
            </div>
            <!-- end banner simple -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section">
        <div class="d-none d-lg-block">
            <img id="bg-img-1" class="img-fluid lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/agro_2.png') }}" alt="demo" />
            <style type="text/css">
                #bg-img-1
                {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    -webkit-transform: translate(-50%,-50%);
                    -ms-transform: translate(-50%,-50%);
                    transform: translate(-50%,-50%);
                }
            </style>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="section-heading section-heading--left" data-aos="fade">
                        <p>
                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/logo_small.png') }}" width="50" height="50" alt="demo" />
                        </p>

                        <h2 class="__title">Fruits & vegetables <span>farm products</span></h2>

                        <p><a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">More about</a></p>
                    </div>
                </div>

                <div class="col-12 col-md-7 col-lg-8">
                    <!-- start feature -->
                    <div class="feature feature--style-3">
                        <div class="__inner">
                            <div class="row">
                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="100" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/7.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Blueberry</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="200" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/8.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Strawberry</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="300" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/9.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Apples</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="400" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/10.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Orange</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="500" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/11.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Carrot</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="600" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/12.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Cabbage</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="700" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/13.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Potato</h5>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <div class="__item  text-center" data-aos="fade" data-aos-delay="800" data-aos-offset="100">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/14.png') }}" alt="demo" />
                                        </i>

                                        <h5 class="__title">Eggplant</h5>
                                    </div>
                                </div>
                                <!-- end item -->
                            </div>
                        </div>
                    </div>
                    <!-- end feature -->
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt">
        <div class="container">
            <div class="special-offer special-offer--style-2" data-aos="zoom-in" data-aos-duration="600" data-aos-offset="70">
                <h2 class="text  text-center">
                    <span style="color: #635729">Healthy</span>
                    <span style="color: #ff6262">life</span>
                    <span style="color: #ffbb4c">with</span>
                    <span style="color: #fcdb5a">fresh</span>
                    <span style="color: #5e9a4b">products</span>
                </h2>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">{{ __('Admin/site.newproducts') }}</h2>

                {{-- <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p> --}}
            </div>

            <!-- start goods -->
            <div class="goods goods--style-2">
                <div class="__inner">
                    <div class="row justify-content-sm-center">
                        <!-- start item -->
                        @foreach ($newProducts as $product)
                            <div class="col-12 col-sm-6 col-lg-5 col-xl-4">
                                <div class="__item">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <figure class="__image">
                                                <a href="{{ route('product_details',$product->id) }}">
                                                    @if($product->image->filename)
                                                        <img class="lazy" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                                        data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                                    @else
                                                        <img class="lazy" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                        data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                    @endif

                                                </a>
                                            </figure>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="__content">
                                                <h4 class="h6 __title"><a href="{{ route('product_details',$product->id) }}">{{ $product->name }}</a></h4>

                                                <div class="rating">
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item"><i class="fontello-star"></i></span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                                    {{-- <span class="product-price__item product-price__item--old">8.11 $</span> --}}
                                                </div>

                                                <a class="custom-btn custom-btn--small custom-btn--style-1" href="#"
                                                wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                                                <i class="fontello-shopping-bag"></i>{{ __('Admin/site.addtocart') }}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="product-label product-label--sale">-20%</span>
                                </div>
                            </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end goods -->

            <div class="spacer py-6 py-md-10"></div>

            <!-- start goods -->
            <div class="goods goods--style-3">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        @foreach ($featuredProducts as $product)
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="__item">
                                <figure class="__image">
                                    <a href="{{ route('product_details',$product->id) }}">
                                        @if($product->image->filename)
                                            <img class="lazy" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                            data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                        @else
                                            <img class="lazy" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                            data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                        @endif

                                    </a>
                                </figure>

                                <div class="__content">
                                    <h4 class="h6 __title"><a href="{{ route('product_details',$product->id) }}">{{ $product->name }}</a></h4>

                                    <div class="__category"><a href="#">Fruits</a></div>

                                    <div class="rating">
                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                        <span class="rating__item"><i class="fontello-star"></i></span>
                                    </div>

                                    <div class="product-price">
                                        {{-- <span class="product-price__item product-price__item--old">{{ number_format($product->price, 2) }} $</span> --}}
                                        <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                    </div>

                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"
                                    wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                                        <i class="fontello-shopping-bag"></i>{{ __('Admin/site.addtocart') }}</a>
                                </div>

                                <span class="product-label product-label--sale">-20%</span>
                            </div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end goods -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb section--gutter">
        <!-- start banner simple -->
        <div class="simple-banner simple-banner--style-1" data-aos="fade" data-aos-offset="50">

            <div class="__label d-none d-md-block">
                <div class="d-table m-auto h-100">
                    <div class="d-table-cell align-middle">
                        <span class="num-1">1</span>
                    </div>

                    <div class="d-table-cell align-middle">
                        <span class="num-2">50$</span>
                        <span>Kg</span>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="__inner">
                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />

                            <div class="row">
                                <div class="col-12 col-lg-7 col-xl-6">
                                    <div class="banner__text" data-aos="fade-left" data-delay="500">
                                        <h2 class="__title h1"><b style="display: block; color: #c6c820;">Fresh Exotic Fruits</b> <span>in Our Store</span></h2>

                                        <p>
                                            The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                        </p>

                                        <p>
                                            <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">Buy</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end banner simple -->
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--review  lazy" data-src="{{ asset('frontassets/img/review_bg_1.png') }}">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">People says <span>about agro</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <!-- start review -->
            <div class="review review--slider">
                <div class="js-slick" data-slick='{"autoplay": true, "arrows": false, "dots": true, "speed": 1000}'>
                    <!-- start item -->
                    <div class="review__item">
                        <div class="review__item__text">
                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>
                        </div>

                        <div class="review__item__author  d-table">
                            <div class="d-table-cell align-middle">
                                <div class="review__item__author-image">
                                    <img class="circled" src="{{ asset('frontassets/img/ava.png') }}" alt="ava" />
                                </div>
                            </div>

                            <div class="d-table-cell align-middle">
                                <span class="review__item__author-name"><strong>Terens Smith</strong></span>
                                <span class="review__item__author-position">/CEO AntalAgro</span>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    <div class="review__item">
                        <div class="review__item__text">
                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>

                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>
                        </div>

                        <div class="review__item__author  d-table">
                            <div class="d-table-cell align-middle">
                                <div class="review__item__author-image">
                                    <img class="circled" src="{{ asset('frontassets/img/ava.png') }}" alt="ava" />
                                </div>
                            </div>

                            <div class="d-table-cell align-middle">
                                <span class="review__item__author-name"><strong>Terens Smith</strong></span>
                                <span class="review__item__author-position">/CEO AntalAgro</span>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->
                </div>
            </div>
            <!-- start review -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section blog-->
    <section class="section section--no-pt section--no-pb">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">{{ __('website\home.blog')}}</h2>

                {{-- <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p> --}}
            </div>

            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        @foreach (\App\Models\Blog::limit(3)->get() as $blog)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="100" data-aos-offset="0">
                                <figure class="__image">
                                    @if($blog->image->filename)
                                        <img class="lazy" src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                        data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                        alt="demo" />
                                    @else
                                       <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                       data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                    @endif
                                </figure>
                                <div class="__content">
                                    <p class="__category"><a href="{{ route('blogdetails',$blog->id) }}">{{ $blog->admin->firstname }}</a></p>

                                    <h3 class="__title h5"><a href="{{ route('blogdetails',$blog->id) }}">{{ $blog->title }}</a></h3>

                                    <p>
                                        {{ Str::limit($blog->body,50,) }}
                                    </p>

                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="{{ route('blogdetails',$blog->id) }}">{{ __('website\home.readmore')}}</a>
                                </div>

                                <span class="__date-post">
                                    <strong>{{ $blog->created_at->diffforhumans() }}</strong>
                                </span>
                            </div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end posts -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section">
        <div class="container">
            <div class="partners-list">
                <div class="js-slick"
                     data-slick='{
                     "autoplay": true,
                     "arrows": false,
                     "dots": true,
                     "speed": 1000,
                     "responsive": [
                        {
                            "breakpoint":576,
                            "settings":{
                                "slidesToShow": 2
                            }
                        },
                        {
                            "breakpoint":767,
                            "settings":{
                                "slidesToShow": 3
                            }
                        },
                        {
                            "breakpoint":991,
                            "settings":{
                                "slidesToShow": 4
                            }
                        },
                        {
                            "breakpoint":1199,
                            "settings":{
                                "autoplay": false,
                                "dots": false,
                                "slidesToShow": 5
                            }
                        }
                    ]}'>
                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/1.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/2.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/3.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/4.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/5.jpg') }}" alt="demo" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>
