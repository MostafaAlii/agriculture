@section('title', __('website\home.farmerproducts'))
@section('css')

@endsection
<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
               <h1>
                {{-- <a href="route('farmer.addPaymentMethod')" class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> {{ __('Website/farmers.add_farmerPaymentMethod') }}</a> --}}
                   <a href="{{ route('farmer.addproduct') }}" class="btn btn-primary btn-lg"> <i class="fa fa-plus"></i> {{ __('Admin/products.add_new_product') }}</a>
                </h1>
               @include('dashboard.common._partials.messages')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>
                            <span style="font-weight: bold;color: #33ab4e;">
                              {{ Auth::user()->firstname .' ' . Auth::user()->lastname }}
                            </span> {{ __('Admin/site.product') }}
                        </h5>
                    </div>
                    <div class="panel-body">
                        {{-- @isset()

                        @endisset --}}
                        @if ($products->count() >0)
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Admin/products.product_main_image') }}</th>
                                <th scope="col">{{ __('Admin/products.product_name') }}</th>
                                <th scope="col">{{ __('Admin/products.product_category') }}</th>
                                <th scope="col">{{ __('Admin/site.tag') }}</th>
                                <th scope="col">{{ __('website/home.price') }}</th>
                                {{-- <th scope="col">{{ __('website/home.special') }}</th> --}}
                                <th scope="col">{{ __('website/home.unit') }}</th>
                                <th scope="col">@lang('Admin/site.qty')</th>
                                <th scope="col">{{ __('Admin/products.product_status') }}</th>
                                <th scope="col">{{ __('Admin/general.created_since') }}</th>
                                <th scope="col">{{ __('Admin/site.action') }}</th>
                              </tr>
                            </thead>
                            <tbody>


                                @foreach ($products as $index=>$product )
                                    <tr>
                                        <th scope="row">{{ $index+1 }}</th>
                                        <td>
                                            <a href="{{ route('product_details',encrypt($product->id)) }}">
                                                <img class="users-avatar-shadow rounded-circle img-preview" height="64" width="64"
                                                    src=" {{ $product->image_path ?
                                                    $product->image_path : URL::asset('Dashboard/img/Default/default_product.jpg') }}"
                                                    alt="{{ Auth::user()->firstname .'_' . Auth::user()->lastname . '_' .$product->name }}">
                                            </a>
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <div class="text-primary text-bold">
                                                    <span>{{$category->name}}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->tags as $tag)
                                                <div class="text-primary text-bold">
                                                    <span>{{$tag->name}}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        @if ($product->special_price > 0)
                                            <td>
                                                <s>{{ number_format($product->getPrice(), 2) }} $</s><br>
                                                <strong>{{ number_format($product->special_price, 2) }} $</strong>
                                            </td>
                                        @else
                                            <td>{{ number_format($product->getPrice(), 2) }} $</td>
                                        @endif
                                        {{-- <td>{{ number_format($product->getPrice(), 2) }} $</td>
                                        <td>{{ number_format($product->special_price, 2) }} $</td> --}}
                                        <td>{{ $product->getUnit()->Name }}</td>
                                        <td>{{ $product->qty}} </td>
                                        <td class="font-weight-bold badge badge-pill badge-{{ $product->status == 1 ? 'success' : 'danger'  }}">
                                            {{ $product->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}
                                         </td>
                                        <td>{{ $product->created_at->diffforhumans() }} </td>
                                        <td>
                                            {{-- <a href="{{ route('farmer.editproduct',['product_id' =>$product->id]) }}" class="btn btn-success btn-lg"><i class="fa fa-edit"></i> {{ __('Admin/site.edit') }}</a> --}}
                                            <a href="{{ route('farmer.editproduct',encrypt($product->id)) }}" class="btn btn-success btn-lg"><i class="fa fa-edit"></i> {{ __('Admin/site.edit') }}</a>
                                            <a href="" class="btn btn-danger btn-lg" title="Delete" wire:click.prevent="delete({{ $product->id }})"
                                                onclick="confirm('{{ __('Are you sure to delete this product') }}') || event.stopImmediatePropagation() ">
                                                <i class="fa fa-trash"></i>{{ __('Admin/site.delete') }}
                                            </a>
                                        </td>
                                    </tr>
                              @endforeach

                            </tbody>
                        </table>
                        @else
                           <h3 style="color: #e71d1d;"> ({{ __('Website/home.smsnoproduct') }})</h3>
                        @endif
                        @if (count($products))
                        {{ $products->links('page-links') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
