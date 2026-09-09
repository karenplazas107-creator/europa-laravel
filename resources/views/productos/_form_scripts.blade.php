<script>
(function () {
    /* ── Preview de imagen ── */
    var input       = document.getElementById('imagen-input');
    var dropzone    = document.getElementById('img-dropzone');
    var preview     = document.getElementById('img-preview');
    var placeholder = document.getElementById('img-placeholder');
    var previewImg  = document.getElementById('preview-img');
    var removeBtn   = document.getElementById('img-remove');

    function showPreview(file) {
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src    = e.target.result;
            preview.style.display     = 'flex';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    if (input) {
        input.addEventListener('change', function () {
            if (this.files && this.files[0]) showPreview(this.files[0]);
        });
    }

    if (removeBtn) {
        removeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            input.value = '';
            previewImg.src            = '';
            preview.style.display     = 'none';
            placeholder.style.display = 'flex';
        });
    }

    /* Drag & drop */
    if (dropzone) {
        dropzone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropzone.classList.add('drag-over');
        });
        dropzone.addEventListener('dragleave', function () {
            dropzone.classList.remove('drag-over');
        });
        dropzone.addEventListener('drop', function (e) {
            e.preventDefault();
            dropzone.classList.remove('drag-over');
            var file = e.dataTransfer.files[0];
            if (file) {
                // Assign to input via DataTransfer
                var dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                showPreview(file);
            }
        });
    }

    /* ── Contador de caracteres descripción ── */
    var textarea  = document.getElementById('descripcion');
    var descCount = document.getElementById('desc-count');
    if (textarea && descCount) {
        descCount.textContent = textarea.value.length;
        textarea.addEventListener('input', function () {
            descCount.textContent = this.value.length;
        });
    }

    /* ── Calculadora de margen ── */
    var compraInput  = document.getElementById('precio_compra');
    var ventaInput   = document.getElementById('precio_venta');
    var margenValor  = document.getElementById('margen-valor');
    var margenDisplay= document.getElementById('margen-display');

    function calcMargen() {
        var compra = parseFloat(compraInput ? compraInput.value : 0) || 0;
        var venta  = parseFloat(ventaInput  ? ventaInput.value  : 0) || 0;
        if (compra <= 0 || venta <= 0) {
            margenValor.textContent = '—';
            margenDisplay.style.color = '#0d1b35';
            return;
        }
        var ganancia = venta - compra;
        var pct      = ((ganancia / compra) * 100).toFixed(1);
        margenValor.textContent = (ganancia >= 0 ? '+' : '') + '$' +
            ganancia.toLocaleString('es-CO', {minimumFractionDigits: 2}) +
            '  (' + pct + '%)';
        margenDisplay.style.color = ganancia >= 0 ? '#16a34a' : '#dc2626';
    }

    if (compraInput) compraInput.addEventListener('input', calcMargen);
    if (ventaInput)  ventaInput.addEventListener('input', calcMargen);
    calcMargen();

    /* ── Checkbox eliminar imagen activa preview ── */
    var chkEliminar = document.getElementById('eliminar_imagen');
    if (chkEliminar) {
        chkEliminar.addEventListener('change', function () {
            if (this.checked) {
                preview.style.display     = 'none';
                placeholder.style.display = 'flex';
            }
        });
    }
})();
</script>
