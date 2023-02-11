<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label>English name</label>
            <input type="text" name="name_en" placeholder="English name" class="form-control"
                value="{{ $product->name_en }}" />
        </div>
    </div>
    <diuv class="col-md-6">
        <div class="mb-3">
            <label>Arabic name</label>
            <input type="text" name="name_ar" placeholder="Arabic name" class="form-control"
                value="{{ $product->name_ar }}" />
        </div>
    </diuv>
</div>
<div class="mb-3">
    <label for="image">Image</label>
    <input type="file" id="image" name="image" class="form-control" />
    @if ($product->image)
        <img width="80" src="{{ asset('uploads/products/' . $product->image) }}">
    @endif
</div>
<div class="mb-3">
    <label>Album</label>
    <input type="file" name="album[]" multiple class="form-control" />
    @foreach ($product->album as $img)
        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this' )"
            href="{{ route('admin.products.delete_image', $img->id) }}"><i class="fa fa-trash"></i></a>
        <img width="60" src="{{ asset('uploads/products/' . $img->path) }}">
    @endforeach
</div>
<div class="mb-3">
    <label> English content</label>
    <textarea name="content_en" placeholder="English content" class="myeditor" rows="10"> {{ $product->content_en }}</textarea>
</div>
<div class="mb-3">
    <label>Arabic content</label>
    <textarea name="content_ar" placeholder="English content" class="myeditor" rows="10"> {{ $product->content_ar }} </textarea>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" placeholder="price" class="form-control"
                value="{{ $product->price }}" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label>Sale Price</label>
            <input type="text" name="sale_price" placeholder="sale_price" class="form-control"
                value="{{ $product->sale_price }}" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label>Quantity</label>
            <input type="text" name="quantity" placeholder="Quantity" class="form-control"
                value="{{ $product->quantity }}" />
        </div>
    </div>
</div>
<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control">
        <option value="">Select</option>
        @foreach ($categories as $item)
            {{-- <option value="{{ $Category->id }}">{{ $Category->name }}</option> --}}
            <option @selected($product->category_id == $item->id) value="{{ $item->id }}">{{ $item->trans_name }}</option>
        @endforeach
    </select>
</div>



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"
        integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        tinymce.init({
            selector: '.myeditor'
        });
    </script>
@stop
