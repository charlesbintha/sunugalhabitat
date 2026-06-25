@push('scripts')
  <script>
    (() => {
      const propertyKind = document.getElementById('property_kind');
      const terrainField = document.getElementById('terrain-document-field');

      if (!propertyKind || !terrainField) {
        return;
      }

      const toggleTerrainField = () => {
        terrainField.style.display = propertyKind.value === 'terrain' ? 'block' : 'none';
      };

      propertyKind.addEventListener('change', toggleTerrainField);
      toggleTerrainField();
    })();
  </script>
@endpush
