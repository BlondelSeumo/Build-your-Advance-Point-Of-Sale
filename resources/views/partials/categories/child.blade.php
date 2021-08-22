<table class="table mt-3">
    <caption>{{ __('Child list') }}</caption>
    <thead>
        <tr class="bg-warning">
            <th scope="row" class="th-width-50">{{ __('Category name') }}</th>
            <th scope="row" class="th-width-20">{{ __('Category code') }}</th>
            <th scope="row" class="th-width-20">{{ __('View') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subcategories as $subcategory)
            <tr>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->code }}</td>
                <td>
                    <a href="{{ route('subcategory.show', $subcategory->id) }}" title="{{ __('View info') }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
