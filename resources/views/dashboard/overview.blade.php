<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Panel</title>
</head>
<body>
	<!-- Modal para solicitar teléfono -->
    @if (Auth::user()->phone != null)
        <div id="phoneModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-semibold mb-4">Agregar número de teléfono</h2>
                <form id="phoneForm">
                    @csrf
                    <input type="text" id="phone" name="phone"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring"
                           placeholder="Ingresa tu número de teléfono">
                    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                </form>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let modal = document.getElementById('phoneModal');
            let form = document.getElementById('phoneForm');

            if (modal) {
                document.body.style.overflow = 'hidden'; // Bloquea la interacción fuera del modal
            }

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                let phoneNumber = document.getElementById('phone').value;

                fetch("{{ route('update.phone') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ phone: phoneNumber })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        modal.remove();
                        document.body.style.overflow = 'auto';
                    } else {
                        alert('Error al guardar el número de teléfono');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>