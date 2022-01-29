@extends('layouts.default')

@section('wrapper')
    @include('components.title', ['title' => 'Создание заказа'])
    @if(Session::get('order') !== null)
       @include('components.success-alert', ['message' => 'Заказ ' . Session::get('order')['id'] . ' успешно создан'])
       @include('components.accordion', ['title' => 'Ответ от /api/v5/orders/create', 'text' => Session::get('order')])
    @endif
    <form action="{{ route('order.create') }}" method="POST">
        @csrf
        @include('components.input', [
            'title' => 'ФИО',
            'name' => 'full_name',
            'id' => 'full_name',
            'placeholder' => 'Иванов Иван Иванович'
        ])
        @error('full_name')
        @include('components.error-alert', ['message' => $message])
        @enderror
        @include('components.textarea', [
            'title' => 'Комментарий',
            'name' => 'comment',
            'id' => 'comment',
        ])
        @error('comment')
        @include('components.error-alert', ['message' => $message])
        @enderror
        @include('components.select', [
            'title' => 'Артикул',
            'id' => 'vendor_code',
            'name' => 'vendor_code',
            'options' => $vendorCodes
        ])
        @error('vendor_code')
        @include('components.error-alert', ['message' => $message])
        @enderror
        @include('components.select', [
            'title' => 'Бренд товара',
            'id' => 'brand',
            'name' => 'brand',
            'options' => array_unique($brands, SORT_REGULAR)
        ])
        @error('brand')
        @include('components.error-alert', ['message' => $message])
        @enderror
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
