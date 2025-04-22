<div class="sort-product-tab-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content tab-animate-zoom">
                    <!-- Start Grid View Product -->
                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                        <div class="row">

                            @foreach($products as $product)
                                <div class="col-xl-4 col-sm-6 col-12">
                                    <!-- Start Product Defautlt Single -->
                                    <div class="product-default-single border-around">
                                        <div class="product-img-warp">
                                            <a href="" class="product-default-img-link">
                                                <img src="assets/images/products_images/aments_products_image_1.jpg" alt="" class="product-default-img img-fluid">
                                            </a>
                                            <div class="product-action-icon-link">
                                                <ul>
                                                    <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                    <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-default-content">
                                            <h6 class="product-default-link"><a href="">{{ $product->title }}</a></h6>

                                            <p class="card-text">Цвета: 
                                                @foreach($product->colors as $color)
                                                    <span class="badge bg-secondary">{{ $color->title }}</span>
                                                @endforeach
                                            </p>

                                            <span class="product-default-price">

                                                Цена: {{ number_format($product->price) }} ₽
                                                    @if($product->old_price != 0)
                                                        <del class="product-default-price-off">{{ number_format($product->old_price) }} ₽</del>
                                                    @endif

                                            </span>
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->
                                </div>
                            @endforeach

                        </div>
                    </div> <!-- End Grid View Product -->
                    <!-- Start List View Product -->
                    <div class="tab-pane sort-layout-single" id="layout-list">
                        <div class="row">

                            @foreach($products as $product)
                                <div class="col-12">
                                    <!-- Start Product Defautlt Single -->
                                    <div class="product-list-single border-around">
                                        <a href="" class="product-list-img-link">
                                            <img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="img-fluid">
                                        </a>
                                        <div class="product-list-content">
                                            <h5 class="product-list-link"><a href="">{{ $product->title }}</a></h5>
                                            <span class="product-list-price">

                                                Цена: {{ number_format($product->price) }} ₽
                                                    @if($product->old_price != 0)
                                                        <del class="product-list-price-off">{{ number_format($product->old_price) }} ₽</del>
                                                    @endif

                                            </span>

                                            <p class="card-text">Цвета: 
                                                @foreach($product->colors as $color)
                                                    <span class="badge bg-secondary">{{ $color->title }}</span>
                                                @endforeach
                                            </p>

                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                            <div class="product-action-icon-link-list">
                                                <ul>
                                                    <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                    <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> <!-- End Product Defautlt Single -->
                                </div>
                            @endforeach

                        </div>
                    </div> <!-- End List View Product -->
                </div>
            </div>
        </div>
    </div>

   <!-- Пагинация -->
   <div class="page-pagination text-center">
        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>