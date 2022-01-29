<div class="mb-3">
    <label for="{{ $id ?? 'empty-id' }}" class="form-label">{{ $title ?? 'Empty label' }}</label>
    <textarea name="{{ $name ?? '' }}" class="form-control" id="{{ $id ?? 'empty-id' }}" placeholder="{{ $placeholder ?? '' }}"></textarea>
</div>
