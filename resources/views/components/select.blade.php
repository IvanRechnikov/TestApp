<div class="mb-3">
    <label for="{{ $id ?? 'empty-id' }}" class="form-label">{{ $title ?? 'Empty label' }}</label>
    <select class="form-select" id="{{ $id ?? 'empty-id' }}" name="{{ $name ?? '' }}" aria-label="Default select example">
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
