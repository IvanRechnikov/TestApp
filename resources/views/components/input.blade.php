<div class="mb-3">
    <label for="{{ $id ?? 'empty-id' }}" class="form-label">{{ $title ?? 'Empty label' }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" class="form-control" id="{{ $id ?? 'empty-id' }}" placeholder="{{ $placeholder ?? '' }}">
</div>
