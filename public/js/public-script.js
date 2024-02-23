document.addEventListener('DOMContentLoaded', function() {
    var updatePreview = function(color) {
        // Tutaj możesz dodać logikę zmiany stylów podglądu,
        // na przykład zmieniając kolor tekstu lub tła elementu.
        var previewElement = document.getElementById('neon-preview');
        if (previewElement) {
            previewElement.style.color = color;
        }
    };

    var colorInput = document.getElementById('neon_color_input');
    if (colorInput) {
        colorInput.addEventListener('change', function() {
            updatePreview(colorInput.value);
        });
    }
});
