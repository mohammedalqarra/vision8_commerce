<div class="product-item">
    <div class="product-thumb">
        <span class="bage">Sale</span>
        <img class="img-responsive" src="{{ asset('uploads/products/' . $product->image) }}"
            alt="product-img" />
        {{-- <div class="preview-meta">
            <ul>
                <li>
                    <span data-toggle="modal" data-target="#product-modal">
                        <i class="tf-ion-ios-search-strong"></i>
                    </span>
                </li>
                <li>
                    <a href="#!"><i class="tf-ion-ios-heart"></i></a>
                </li>
                <li>
                    <a href="#!"><i class="tf-ion-android-cart"></i></a>
                </li>
            </ul>
        </div> --}}
    </div>
    <div class="product-content">
        <h4><a href="{{ route('site.product' ,  $product->id ) }}">{{ $product->trans_name }}</a></h4>
        <p class="price">${{ $product->price }}</p>
    </div>
</div>
