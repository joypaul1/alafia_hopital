
<div>

    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>{{  $subcategory->name}}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
                        <li class="breadcrumb-item active">{{  $subcategory->name}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <div class="product_header">
                                    <div class="product_header_left">
                                        <div class="custom_select">
                                            <select class="form-control form-control-sm"  wire:click="priceRange($event.target.value)">
                                                <option value="{{null}}">Default sorting</option>
                                               {{--  <option value="popularity">Sort by popularity</option>
                                                <option value="date">Sort by newness</option> --}}
                                                <option value="asc">Sort by price: low to high</option>
                                                <option value="desc">Sort by price: high to low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="product_header_right">
                                        <div class="products_view">
                                            <a href="javascript:Void(0);" class="shorting_icon grid active"><i
                                                    class="ti-view-grid"></i></a>
                                            <a href="javascript:Void(0);" class="shorting_icon list "><i
                                                    class="ti-layout-list-thumb"></i></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row shop_container grid">
                            @forelse ($items as $item)
                            <div class="col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="{{ route('item', ['slug' => $item->slug ]) }}">
                                            <img src="{{ asset($item->image)}}" alt="{{ asset($item->image)}}">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">

                                                <li><a href="{{ route('item', ['slug' => $item->slug ]) }}"><i class="icon-magnifier-add"></i></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="{{ route('item', ['slug' => $item->slug ]) }}">{{ ($item->name)}}</a></h6>
                                        <div class="product_price">
                                            <span class="price">{{number_format($item->sell_price , 2)}}</span>
                                            {{-- <del>$55.25</del>
                                            <div class="on_sale">
                                                <span>35% Off</span>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:80%"></div>
                                            </div>
                                            <span class="rating_num">(21)</span>
                                        </div>
                                        <div class="pr_desc">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                                                blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                        </div> --}}

                                        <div class="list_product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                {{-- <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i>
                                                        Add To Cart</a></li> --}}

                                                <li><a href="{{ route('item', ['slug' => $item->slug ]) }}"><i
                                                            class="icon-magnifier-add"></i></a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse


                        </div>
                        {{-- <div class="row">
                            <div class="col-12">
                                <ul class="pagination mt-3 justify-content-center pagination_style1">
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i
                                                class="linearicons-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                        <div class="sidebar">


                            <div class="widget">
                                <h5 class="widget_title">Childcategory :</h5>
                                <ul class="list_brand">
                                    @forelse ($subcategory->childcategories as $subKey=>$childcategory)
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="subcategorycheckbox"
                                                id="{{$subKey}}"  wire:click="selectChildCat({{$childcategory->id}})" value="">
                                            <label class="form-check-label" for="{{$subKey}}"><span>{{$childcategory->name}}</span></label>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse

                                </ul>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">Brand :</h5>
                                <ul class="list_brand">
                                    @forelse ($this->brands as $brandKey=>$brand)
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="brandcheckbox"
                                                id="{{$brand->id.$brandKey}}"  wire:click="selectBrandId({{$brand->id}})" value="">
                                            <label class="form-check-label" for="{{$brand->id.$brandKey}}"><span>{{$brand->name}}</span></label>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse

                                </ul>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SECTION SHOP -->


    </div>
    <!-- END MAIN CONTENT -->
</div>
