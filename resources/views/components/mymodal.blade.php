@props([
    'id' => 'modal',
    'title' => 'Modal',
    'size' => 'md', // sm, md, lg, xl
])

<div id="{{ $id }}" class="modal-overlay" style="display: none;">
    <div class="modal-container modal-{{ $size }}">
        <div class="modal-header">
            <h3>{{ $title }}</h3>
            <button type="button" class="modal-close" onclick="closeModal('{{ $id }}')">&times;</button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>

@once

    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-container {
            background: white;
            border-radius: 8px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-sm {
            width: 90%;
            max-width: 400px;
        }

        .modal-md {
            width: 90%;
            max-width: 600px;
        }

        .modal-lg {
            width: 90%;
            max-width: 800px;
        }

        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #6b7280;
            line-height: 1;
            padding: 0;
            width: 2rem;
            height: 2rem;
        }

        .modal-close:hover {
            color: #111827;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border-radius: 0.375rem;
        }

        .alert-danger {
            background-color: #fee;
            color: #c00;
            border: 1px solid #fcc;
        }

        .alert-success {
            background-color: #efe;
            color: #0a0;
            border: 1px solid #cfc;
        }
    </style>

    <script>
        function openModal(modalId, params = {}) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'flex';

            // Almacenar parámetros en el modal
            modal.dataset.params = JSON.stringify(params);

            // Disparar evento personalizado con los parámetros
            const event = new CustomEvent('modalOpened', {
                detail: params
            });
            modal.dispatchEvent(event);

            // Poblar campos si existen parámetros
            if (Object.keys(params).length > 0) {
                populateModalFields(modal, params);
            }
        }

        /**
         * Poblar campos del formulario con parámetros
         */
        function populateModalFields(modal, params) {
            const form = modal.querySelector('form');

            if (!form) return;

            // Actualizar título si se proporciona
            if (params.title) {
                const titleElement = modal.querySelector('.modal-title');
                if (titleElement) {
                    titleElement.textContent = params.title;
                }
            }

            // Poblar campos ocultos y visibles
            Object.keys(params).forEach(key => {
                if (key === 'title') return; // Saltar el título

                // Buscar input existente
                let input = form.querySelector(`[name="${key}"]`);

                // Si no existe, crear campo oculto
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    form.appendChild(input);
                }

                // Establecer valor
                input.value = params[key];
            });
        }

        /**
         * Obtener parámetros del modal
         */
        function getModalParams(modalId) {
            const modal = document.getElementById(modalId);
            const paramsStr = modal.dataset.params;
            return paramsStr ? JSON.parse(paramsStr) : {};
        }


        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            // Limpiar errores al cerrar
            const modal = document.getElementById(modalId);
            const errors = modal.querySelectorAll('.alert-danger');
            errors.forEach(error => error.remove());

            // Limpiar parámetros
            delete modal.dataset.params;
        }

        // Cerrar modal al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                // No cerrar automáticamente, solo si el usuario hace clic en la X
            }
        });
    </script>
@endonce
