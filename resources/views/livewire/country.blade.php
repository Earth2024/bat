<div wire:ignore style="display: grid; grid-template-columns: 0.9fr; margin: auto; justify-content: center; ">
    <select id="country-select" name="country" class="form-control" style="width: 100%;">
        <option value="">Select a country</option>
        @foreach($countries as $code => $name)
            <option value="{{ $code }}">{{ $name }}</option>
        @endforeach
    </select>
        @error('country')
            <span class="alert alert-danger">{{$message}}</span>
        @enderror
</div>


<!-- jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function formatCountry(country) {
            if (!country.id) return country.text;

            const code = country.id.toLowerCase();
            return $(
                `<span style="display: flex; align-items: center; gap: 0.5rem;">
                    <span class="flag-icon flag-icon-${code} me-2"></span>${country.text}
                </span>`
            );
        }

        $('#country-select').select2({
            placeholder: 'Select a country',
            //allowClear: true,
            ajax: {
                url: '{{ route("country.search") }}',
                dataType: 'json',
                delay: 250,
                data: params => ({ q: params.term }),
                processResults: data => ({
                    results: data.map(item => ({
                        id: item.id,      // 'ng', 'us', etc.
                        text: item.name   // 'Nigeria', etc.
                    }))
                })
            },
            templateResult: formatCountry,
            templateSelection: formatCountry
        });

        $('#country-select').on('change', function () {
            Livewire.find('{{ $this->getId() }}').set('selectedCountry', $(this).val());
        });
    });
</script>
@endpush
