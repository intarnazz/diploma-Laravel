<img
    src="{{ $getRecord() ? asset('api/image/' . $getRecord()->image_id) : '' }}"
    style="min-width: {{ $width }}px; height: {{ $height }}px; object-fit: cover; border-radius: 12px;"
    alt="preview"
/>
