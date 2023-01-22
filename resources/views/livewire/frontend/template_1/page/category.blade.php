
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>
                <span></span> {{  $category->name}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            {{-- <p> We found <strong class="text-brand">688</strong> items for you!</p> --}}
                        </div>
                        <div class="sort-by-product-area">

                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Price  <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a  href="javascript:void(0)"  wire:click="priceRange('asc')">Price: Low to High</a></li>
                                        <li><a  href="javascript:void(0)"  wire:click="priceRange('desc')">Price: High to Low</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @forelse ($items as $item)
                        <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('item', ['slug' => $item->slug ]) }}">
                                            <img class="default-img" src="{{ asset($item->image)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a  href="{{ route('item', ['slug' => $item->slug ]) }}" aria-label="view" class="action-btn hover-up"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div> --}}
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="{{route('category',['slug' =>optional($item->category)->name] )}}">{{optional($item->category)->name}}</a>
                                    </div>
                                    <h2><a href="{{ route('item', ['slug' =>$item->slug ]) }}">{{ $item->name }}</a></h2>
                                    {{-- <div class="rating-result" title="90%">
                                        <span>
                                            <span>90%</span>
                                        </span>
                                    </div> --}}
                                    <div class="product-price">
                                        <span>{{number_format($item->sell_price , 2)}} </span>
                                        {{-- <span class="old-price">$245.8</span> --}}
                                    </div>
                                    {{-- <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="/cart"><i
                                                class="fi-rs-shopping-bag-add"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse


                    </div>
                    <!--pagination-->
                    {{-- <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Subcategory</h5>
                        <ul class="categories">
                            @forelse ($category->subcategories as $subcategory)
                                <li><a href="javascript:void(0)"  wire:click="selectSubCat({{$subcategory->id}})" >{{$subcategory->name}}</a></li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 ">Brand</h5>
                        <ul class="categories">
                            @forelse ($this->brands as $brand)
                                <li><a href="javascript:void(0)" wire:click="selectBrandId({{$brand->id}})" >{{$brand->name}}</a></li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span>
                                        <input type="text" id="amount" name="price"
                                            placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox2" value="">
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green
                                            (78)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue
                                            (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New
                                            (1506)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox21" value="">
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished
                                            (27)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox31" value="">
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used
                                            (45)</span></label>
                                </div>
                            </div>
                        </div> --}}
                        <a href="#" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>


                </div>
            </div>
        </div>
    </section>
</main>

