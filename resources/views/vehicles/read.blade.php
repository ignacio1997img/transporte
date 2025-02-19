@extends('voyager::master')

@section('page_title', 'Ver Vehículos')

@section('page_header')
    <h1 class="page-title">
        <i class="fa-solid fa-van-shuttle"></i> Vehículos
        <a href="{{ route('voyager.vehicles.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            Volver a la lista
        </a>
    </h1>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nro Placa / Nro de Registro</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{$vehicle->numberRegistration}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Año</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{$vehicle->year}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Color</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{$vehicle->color}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Modelo</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{$vehicle->model}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Marca</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->brand }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Capacidad</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->ability }} Asientos "Sin el Chofer"</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nro de Chasis</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->numberChassis }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nro de Motor</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->numberEngine}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>


                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Nro de Motor</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->numberEngine}}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        

                        <div class="col-md-6">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Imagen</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>
                                    @if($vehicle->image)
                                        @php
                                            $image = asset('storage/'.str_replace('.', '-cropped.', $vehicle->image));
                                        @endphp
                                        {{-- <img src="{{ Voyager::image($vehicle->image) }}" alt="Image" style="max-width: 100%; height: auto;"> --}}
                                        <img src="{{$image}}" alt="Image" style="max-width: 100%; height: auto;">
                                    @else
                                        <p>No image available.</p>
                                    @endif
                                </p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                        <div class="col-md-12">
                            <div class="panel-heading" style="border-bottom:0;">
                                <h3 class="panel-title">Descripcíon</h3>
                            </div>
                            <div class="panel-body" style="padding-top:0;">
                                <p>{{ $vehicle->description }}</p>
                            </div>
                            <hr style="margin:0;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <h3>Configuración de Asientos</h3>
                    <!-- Contenedor para los asientos -->
                    <div  id="seat-layout" style="position: relative; width: 290px; height: 500px; border: 2px solid #000; margin-top: 20px;">
                        <!-- Aquí se generarán los asientos dinámicamente -->
                    </div>
                
                    <!-- Botón para guardar la configuración -->
                    <button id="save-seats" class="btn btn-success mt-3">Guardar Configuración</button>
                </div>
            </div>
        </div>
    </div>





@stop

@section('css')
<style>
    /* Estilos generales */
    .seat-layout-container {
        position: relative;
        width: 100%;
        max-width: 290px;
        height: 500px;
        border: 2px solid #000;
        margin-top: 20px;
        overflow: hidden;
    }

    .seat-container {
        position: absolute;
        width: 60px;
        padding: 10px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-align: center;
        cursor: move;
        transition: transform 0.2s ease;
    }

    .seat-container:hover {
        background-color: #e9ecef;
    }

    .seat-icon {
        font-size: 24px;
        margin-bottom: 5px;
        font-weight: bold; /* Negrita para el ícono */
        color: #000000; /* Color negro para el ícono */
    }

    .seat-number {
        font-size: 14px;
        font-weight: bold; /* Negrita para el número */
        color: #000000; /* Color negro para el número */
    }

    .seat-input {
        width: 100%;
        margin-top: 5px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 3px;
        font-size: 12px;
        color: #000000; /* Color negro para el texto del input */
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .seat-layout-container {
            height: 400px;
        }

        .seat-container {
            width: 50px;
            padding: 8px;
        }

        .seat-icon {
            font-size: 20px;
        }

        .seat-number {
            font-size: 12px;
        }

        .seat-input {
            font-size: 10px;
        }
    }

    @media (max-width: 576px) {
        .seat-layout-container {
            height: 300px;
        }

        .seat-container {
            width: 40px;
            padding: 5px;
        }

        .seat-icon {
            font-size: 16px;
        }

        .seat-number {
            font-size: 10px;
        }

        .seat-input {
            font-size: 8px;
        }
    }
</style>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.min.js"></script>
<script>
    const seatLayout = document.getElementById('seat-layout');
    const saveButton = document.getElementById('save-seats');//Para guardar los asientos
    const seatCountInput = document.getElementById('seat_count'); // Input para la cantidad de asientos

    $(document).ready(function(){
        var seats = @json($seats);
        if(seats == 0)
        {
            const seatCount = {{$vehicle->ability}}
            // Limpiar asientos anteriores
            seatLayout.innerHTML = '';
            seats = [];

            // Generar el asiento del chofer
            createSeat(null, true); // Asiento del chofer

            // Generar nuevos asientos
            if (seatCount > 0) {
                for (let i = 1; i <= seatCount; i++) {
                    createSeat(i);
                }
            } else {
                alert('Por favor, ingresa una cantidad válida de asientos.');
            }
        }
    })

    let seats = [];

    // Función para crear un asiento
    function createSeat(seatNumber, isDriver = false) {
        const seatContainer = document.createElement('div');
        seatContainer.className = 'seat-container';
        seatContainer.style.position = 'absolute';
        seatContainer.style.width = '60px'; // Ajusta el ancho según sea necesario
        seatContainer.style.cursor = 'move';

        // Contenedor para el icono y el número
        const seatIconContainer = document.createElement('div');
        seatIconContainer.style.display = 'flex';
        seatIconContainer.style.alignItems = 'center';
        seatIconContainer.style.marginBottom = '5px';

        // Icono de asiento (usando Font Awesome)
        const seatIcon = document.createElement('i');
        seatIcon.className = isDriver ? 'fas fa-user-tie seat-icon' : 'fas fa-chair seat-icon'; // Icono diferente para el chofer
        seatIcon.style.fontSize = '24px';
        seatIcon.style.marginRight = '5px'; // Espacio entre el icono y el número

        // Número del asiento (no mostrar número para el chofer)
        const seatNumberElement = document.createElement('span');
        seatNumberElement.className = 'seat-number';
        seatNumberElement.textContent = isDriver ? '' : seatNumber; // Texto diferente para el chofer

        // Input de texto (mostrar input para todos los asientos)
        const seatInput = document.createElement('input');
        seatInput.type = 'text';
        seatInput.className = 'seat-input';
        seatInput.placeholder = isDriver ? 'Nombre del chofer' : 'Ingrese texto'; // Placeholder diferente para el chofer

        // Agregar icono, número e input al contenedor principal
        seatIconContainer.appendChild(seatIcon);
        seatIconContainer.appendChild(seatNumberElement);
        seatContainer.appendChild(seatIconContainer);
        seatContainer.appendChild(seatInput);

        // Hacer el contenedor arrastrable con restricciones
        interact(seatContainer).draggable({
            onmove: function (event) {
                const target = event.target;
                let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                // Obtener las dimensiones del contenedor y del asiento
                const containerRect = seatLayout.getBoundingClientRect();
                const seatRect = target.getBoundingClientRect();

                // Restringir el movimiento dentro del contenedor
                const maxX = containerRect.width - seatRect.width;
                const maxY = containerRect.height - seatRect.height;

                x = Math.max(0, Math.min(x, maxX)); // Limitar en el eje X
                y = Math.max(0, Math.min(y, maxY)); // Limitar en el eje Y

                target.style.transform = `translate(${x}px, ${y}px)`;
                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
        });

        seatLayout.appendChild(seatContainer);
        seats.push({ number: isDriver ? 'Chofer' : seatNumber, x: 0, y: 0, text: '', isDriver });
    }

    // Guardar la configuración de los asientos
    saveButton.addEventListener('click', () => {
        const data = seats.map((seat, index) => {
            const seatContainer = document.querySelectorAll('.seat-container')[index];
            const seatInput = seatContainer.querySelector('input');
            return {
                number: seat.number,
                x: parseFloat(seatContainer.getAttribute('data-x')) || 0,
                y: parseFloat(seatContainer.getAttribute('data-y')) || 0,
                text: seatInput ? seatInput.value : '', // Guardar el texto ingresado (si existe)
                isDriver: seat.isDriver // Indicar si es el asiento del chofer
            };
        });

        fetch('/admin/save-seats', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                vehicle_id: {{ $vehicle->id }}, // Asegúrate de pasar el ID del vehículo
                seats: data
            })
        }).then(response => response.json())
            .then(data => {
                // alert('Configuración guardada exitosamente');
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
    });

    // Cargar asientos guardados al iniciar la página
    window.addEventListener('load', () => {
        // Cargar el valor de ability en el input
        const ability = {{ $vehicle->ability }}; // Obtener la capacidad de asientos del vehículo

        // Cargar los asientos guardados (si existen)
        const savedSeats = @json($seats); // Convertir los asientos guardados a JSON

        savedSeats.forEach(seat => {
            createSeat(seat.seatNumber, seat.is_driver);

            // Posicionar el asiento en las coordenadas guardadas
            const seatContainer = document.querySelectorAll('.seat-container')[seats.length - 1];
            seatContainer.style.transform = `translate(${seat.position_x}px, ${seat.position_y}px)`;
            seatContainer.setAttribute('data-x', seat.position_x);
            seatContainer.setAttribute('data-y', seat.position_y);

            // Llenar el input con el texto guardado
            const seatInput = seatContainer.querySelector('input');
            if (seatInput) {
                seatInput.value = seat.label;
            }
        });
    });
</script>
@stop