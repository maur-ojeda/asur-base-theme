<?php
$args = array(
    'post_type'      => 'simulator_settings',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC'
);

$contact_query = new WP_Query($args);

if ($contact_query->have_posts()) :
    while ($contact_query->have_posts()) : $contact_query->the_post();
        $title = get_the_title();
        $comunas = carbon_get_the_post_meta('crb_comunas_servicio');
        $techos = carbon_get_the_post_meta('enercity_multiplicadores_techo');
        $medidores = carbon_get_the_post_meta('enercity_multiplicadores_medidor');
        $simulatorData = carbon_get_the_post_meta('enercity_data_table');
        // --- GENERAR NONCE ---
        //$simulation_nonce = wp_create_nonce('simulation_form_nonce');

        // --- PASAR NONCE A JAVASCRIPT ---
        echo '<script type="text/javascript">';
        echo 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";';
        // Opcional: Si usas nonce
        //echo 'var simulationNonce = "' . $simulation_nonce . '";'; // Pasar el nonce
        echo '</script>';

?>






        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">




        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f7f9fb;
            }

            .container {
                max-width: 900px;
            }

            .card {
                border: none;
                border-radius: 1rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                margin-bottom: 2rem;
            }

            .progress-bar {
                background-color: #0d6efd;
                transition: width 0.4s ease;
                font-weight: 600;
            }

            /* ESTILO CRUCIAL PARA LA VALIDACIÓN DEL SELECT */
            .is-invalid+.choices .choices__inner {
                border: 1px solid #dc3545 !important;
                box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            }

            .choices__inner {
                border-radius: 0.375rem;
            }

            /* Estilo para los radio buttons de selección de cliente */
            .radio-tile-group {
                display: flex;
                gap: 1.5rem;
                justify-content: center;
            }

            .input-container {
                position: relative;
                cursor: pointer;
            }

            .radio-tile-group input[type="radio"] {
                opacity: 0;
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                cursor: pointer;
            }

            .radio-tile {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 150px;
                height: 150px;
                border-radius: 0.75rem;
                border: 2px solid #e5e7eb;
                transition: all 0.2s ease-in-out;
                padding: 1rem;
                text-align: center;
                font-weight: 600;
                color: #4b5563;
            }

            .radio-tile-group input[type="radio"]:checked+.radio-tile {
                background-color: #e0f2ff;
                border-color: #0d6efd;
                box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
                color: #0d6efd;
            }

            .radio-tile-group input[type="radio"]:hover+.radio-tile {
                border-color: #adb5bd;
            }

            .radio-tile .bi {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }
        </style>

        </head>

        <body>



            <div class="container my-8">
                <div class="row">
                    <div class="col-12">
                        <h3 class="card-title text-center mb-6 text-xl md:text-2xl font-semibold text-gray-800">Cotiza tu Proyecto Solar en pocos pasos.</h3>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-xl">
                            <div class="card-body p-5">
                                <div class="progress mb-5 h-2">
                                    <div class="progress-bar rounded-full" role="progressbar" id="progressBar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <form id="multiStepForm">
                                    <div id="formSteps">

                                        <!-- PASO 1: TIPO DE CLIENTE -->
                                        <div class="step" data-step="1">
                                            <div class="row g-4 justify-content-center">
                                                <div class="col-12 text-center">
                                                    <h5 class="mb-5 text-2xl font-bold text-gray-700">1. ¿Qué tipo de cliente eres?</h5>
                                                </div>
                                                <div class="radio-tile-group">
                                                    <div class="input-container">
                                                        <input id="cliente_residencial" type="radio" name="clientType" value="residencial" required>
                                                        <label class="radio-tile" for="cliente_residencial">
                                                            <i class="bi bi-house-door-fill"></i>
                                                            Residencial
                                                        </label>
                                                    </div>
                                                    <div class="input-container">
                                                        <input id="cliente_industrial" type="radio" name="clientType" value="industrial" required>
                                                        <label class="radio-tile" for="cliente_industrial">
                                                            <i class="bi bi-factory"></i>
                                                            Industrial/Comercial
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mt-5">
                                                    <div class="invalid-feedback d-block" id="type-feedback" style="display: none;">Por favor, selecciona un tipo de cliente.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 1 -->

                                        <!-- PASO 2: DIRECCIÓN Y COMUNA (RESIDENCIAL) -->
                                        <div class="step" data-step="2" style="display: none;">
                                            <div class="row g-4">
                                                <div class="col-md-4 hidden md:block">
                                                    <img src="https://placehold.co/400x500/0d6efd/ffffff?text=Paso+2%0ADirección" alt="Ilustración de localización" class="img-fluid object-cover">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="mb-4 text-2xl font-bold text-gray-700">2. Dirección y Comuna</h5>

                                                    <div class="mb-4">
                                                        <label class="form-label font-medium" for="select_comunas">Comuna (*)</label>
                                                        <select class="form-select" name="comuna" id="select_comunas" required>
                                                            <option value="" selected disabled>Selecciona una comuna</option>
                                                            <?php
                                                            // Generación dinámica de opciones de Comuna
                                                            if (!empty($comunas)) {
                                                                foreach ($comunas as $comuna) {
                                                                    $value = htmlspecialchars($comuna['comuna_slug']);
                                                                    $text = htmlspecialchars($comuna['nombre']);
                                                                    echo '<option value="' . $value . '">' . $text . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="invalid-feedback">Por favor, selecciona tu comuna.</div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="form-label font-medium" for="input_direccion">Dirección (*)</label>
                                                        <input class="form-control" type="text" id="input_direccion" name="direccion" required placeholder="Ingresa tu dirección exacta" />
                                                        <div class="invalid-feedback">La dirección es necesaria.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 2 -->

                                        <!-- PASO 3: TIPO DE TECHO (RESIDENCIAL) -->
                                        <div class="step" data-step="3" style="display: none;">
                                            <div class="row g-4">
                                                <div class="col-md-4 hidden md:block">
                                                    <img src="https://placehold.co/400x500/0dcaf0/333333?text=Paso+3%0ATecho" alt="Ilustración de techo" class="img-fluid object-cover">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="mb-4 text-2xl font-bold text-gray-700">3. Tipo de Techo</h5>
                                                    <div class="mb-4">
                                                        <label class="form-label font-medium" for="select_techos">Tipo de Techo (*)</label>
                                                        <select class="form-select" name="roofType" id="select_techos" required>
                                                            <option value="" selected disabled>Selecciona el tipo de techo</option>
                                                            <?php
                                                            // Generación dinámica de opciones de Techo
                                                            if (!empty($techos)) {
                                                                foreach ($techos as $techo) {
                                                                    $value = htmlspecialchars($techo['techo_slug']);
                                                                    $text = htmlspecialchars($techo['techo_label']);
                                                                    $multiplier = htmlspecialchars($techo['techo_multiplier']);
                                                                    echo '<option value="' . $value . '" data-multiplier="' . $multiplier . '">' . $text . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="invalid-feedback">Por favor, selecciona el tipo de techo.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 3 -->

                                        <!-- PASO 4: UBICACIÓN DEL MEDIDOR (RESIDENCIAL) -->
                                        <div class="step" data-step="4" style="display: none;">
                                            <div class="row g-4">
                                                <div class="col-md-4 hidden md:block">
                                                    <img src="https://placehold.co/400x500/ffc107/333333?text=Paso+4%0AMedidor" alt="Ilustración de medidor" class="img-fluid object-cover">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="mb-4 text-2xl font-bold text-gray-700">4. Ubicación del Medidor</h5>
                                                    <div class="mb-4">
                                                        <label for="select_medidores" class="form-label font-medium">Ubicación del Medidor (*)</label>
                                                        <select class="form-select" name="meterLocation" id="select_medidores" required>
                                                            <option value="" selected disabled>Selecciona la ubicación del medidor</option>
                                                            <?php
                                                            // Generación dinámica de opciones de Medidor
                                                            if (!empty($medidores)) {
                                                                foreach ($medidores as $medidor) {
                                                                    $value = htmlspecialchars($medidor['medidor_slug']);
                                                                    $text = htmlspecialchars($medidor['medidor_label']);
                                                                    $multiplier = htmlspecialchars($medidor['medidor_multiplier']);
                                                                    echo '<option value="' . $value . '" data-multiplier="' . $multiplier . '">' . $text . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="invalid-feedback">Por favor, selecciona la ubicación del medidor.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 4 -->

                                        <!-- PASO 5: BOLETA MENSUAL (RESIDENCIAL) -->
                                        <div class="step" data-step="5" style="display: none;">
                                            <div class="row g-4">
                                                <div class="col-md-4 hidden md:block">
                                                    <img src="https://placehold.co/400x500/fd7e14/ffffff?text=Paso+5%0ABoleta" alt="Ilustración de factura" class="img-fluid object-cover">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="mb-4 text-2xl font-bold text-gray-700">5. Monto de Boleta Mensual (CLP)</h5>
                                                    <p class="text-sm text-gray-500 mb-4" id="billRangeText">Solo se aceptan montos dentro del rango de simulación automática.</p>
                                                    <div class="mb-4">
                                                        <label class="form-label font-medium" for="input_boleta">Monto de Boleta (CLP) (*)</label>
                                                        <input class="form-control" type="number" id="input_boleta" name="monthlyBillCLP" required min="1000" step="1" placeholder="Ej: 80000" />
                                                        <div class="invalid-feedback" id="boleta-feedback">Por favor, ingresa un monto válido.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 5 -->

                                        <!-- PASO 6: FORMULARIO DE CONTACTO (AMBOS) -->
                                        <div class="step" data-step="6" style="display: none;">
                                            <div class="row g-4">
                                                <div class="col-md-4 hidden md:block">
                                                    <img src="https://placehold.co/400x500/28a745/ffffff?text=Paso+6%0AContacto" alt="Ilustración de contacto" class="img-fluid object-cover">
                                                </div>
                                                <div class="col-md-8">
                                                    <h5 class="mb-4 text-2xl font-bold text-gray-700">6. Datos de Contacto</h5>
                                                    <p class="text-sm text-gray-500 mb-4">Necesitamos esta información para enviarte la simulación y el PDF.</p>

                                                    <div class="mb-3">
                                                        <label class="form-label font-medium" for="input_nombre">Nombre (*)</label>
                                                        <input class="form-control" type="text" id="input_nombre" name="nombre" required placeholder="Tu nombre completo" />
                                                        <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label font-medium" for="input_telefono">Teléfono (*)</label>
                                                        <input class="form-control" type="tel" id="input_telefono" name="telefono" required placeholder="Ej: +56912345678" />
                                                        <div class="invalid-feedback">Por favor, ingresa un número de teléfono válido.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label font-medium" for="input_email">Email (*)</label>
                                                        <input class="form-control" type="email" id="input_email" name="email" required placeholder="ejemplo@email.com" />
                                                        <div class="invalid-feedback">Por favor, ingresa un email válido.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end paso 6 -->

                                        <!-- PASO 7: RESULTADOS (Éxito) -->
                                        <div class="step text-center py-5" data-step="7" style="display: none;">
                                            <i class="bi bi-check-circle-fill text-green-500" style="font-size: 4rem;"></i>
                                            <h2 class="mt-3 text-3xl font-bold text-green-600">¡Registro Completo! 🎉</h2>
                                            <p class="lead mt-3 text-gray-600">
                                                Tu simulación está siendo procesada. Revisa los detalles a continuación y espera el PDF en tu email.
                                            </p>

                                            <div id="resultsSummary" class="mt-5 p-4 bg-gray-100 rounded-lg text-left shadow-inner">
                                                <h6 class="font-bold text-gray-700 border-b pb-2 mb-3">Resumen de Contacto y Simulación</h6>
                                                <div id="summaryContact">
                                                    <h6 class="font-semibold text-gray-600 mb-2">Datos de Contacto:</h6>
                                                    <ul class="list-unstyled text-sm">
                                                        <li><span class="font-semibold">Tipo Cliente:</span> <span id="summaryType"></span></li>
                                                        <li><span class="font-semibold">Email:</span> <span id="summaryEmail"></span></li>
                                                        <li><span class="font-semibold">Teléfono:</span> <span id="summaryPhone"></span></li>
                                                    </ul>
                                                </div>

                                                <!-- Summary de Simulación basado en datos de WordPress -->
                                                <div id="summarySimulation" class="mt-4 border-t pt-3">
                                                    <h6 class="font-semibold text-gray-600 mb-2">Resultados de Simulación Residencial (On Grid Neto):</h6>
                                                    <ul class="list-unstyled text-base space-y-2">
                                                        <li class="p-2 bg-white rounded-lg shadow-sm"><span class="font-bold text-gray-600">Consumo Bruto Mapeado:</span> <span id="simConsumoBruto"></span></li>
                                                        <li class="p-2 bg-white rounded-lg shadow-sm"><span class="font-bold text-blue-600">Potencia Total Sistema FV:</span> <span id="simPotenciaTotalFV"></span></li>
                                                        <li class="p-2 bg-white rounded-lg shadow-sm"><span class="font-bold text-blue-600">Potencia del Inversor:</span> <span id="simPotenciaInversor"></span></li>
                                                        <li class="p-2 bg-white rounded-lg shadow-sm"><span class="font-bold text-blue-600">Cantidad de Paneles:</span> <span id="simCantidadPaneles"></span></li>
                                                        <li class="p-2 bg-white rounded-lg shadow-sm"><span class="font-bold text-red-600">Costo Final Estimado (CLP):</span> <span id="simCost"></span></li>
                                                    </ul>
                                                </div>
                                                <!-- Fin Summary -->

                                                <p id="simulationDetails" class="text-xs mt-3 italic text-gray-500"></p>
                                            </div>

                                            <button type="button" class="btn btn-secondary mt-5" id="resetBtn">Comenzar de Nuevo</button>
                                        </div>
                                        <!-- end paso 7 -->
                                    </div>

                                    <div class="d-flex justify-content-between mt-6" id="navButtons">
                                        <button type="button" class="btn btn-secondary px-4 py-2 rounded-full" id="prevBtn" style="display: none;">&larr; Anterior</button>
                                        <button type="button" class="btn btn-primary px-4 py-2 rounded-full ms-auto" id="nextBtn">Siguiente &rarr;</button>
                                        <button type="submit" class="btn btn-success px-4 py-2 rounded-full ms-auto" id="submitBtn" style="display: none;">Finalizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Choices.js Library -->
            <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // --- CARGA DE DATOS DINÁMICOS DESDE PHP/WORDPRESS ---
                    
                    const SIMULATOR_DATA = <?php echo json_encode($simulatorData); ?>;

                    // --- VARIABLES DE ESTADO Y ELEMENTOS ---
                    let currentStep = 1;
                    let clientType = '';
                    const TOTAL_RESIDENCIAL_STEPS = 6;
                    const TOTAL_INDUSTRIAL_STEPS = 2;
                    const steps = document.querySelectorAll('.step');
                    const progressBar = document.getElementById('progressBar');
                    const nextBtn = document.getElementById('nextBtn');
                    const prevBtn = document.getElementById('prevBtn');
                    const submitBtn = document.getElementById('submitBtn');
                    const resetBtn = document.getElementById('resetBtn');
                    const form = document.getElementById('multiStepForm');
                    const typeFeedback = document.getElementById('type-feedback');
                    const billRangeText = document.getElementById('billRangeText');

                    // LÍMITES DINÁMICOS: Determinados por la tabla de datos cargada
                    let MIN_BILL_LOOKUP = 0;
                    let MAX_BILL_LOOKUP = 0;

                    if (SIMULATOR_DATA.length > 0) {
                        // Asume que los datos están ordenados ascendentemente por consumo_bruto
                        MIN_BILL_LOOKUP = SIMULATOR_DATA[0].consumo_bruto;
                        MAX_BILL_LOOKUP = SIMULATOR_DATA[SIMULATOR_DATA.length - 1].consumo_bruto;
                    }

                    // Actualiza el texto de rango de boleta
                    const numberFormatter = new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP',
                        minimumFractionDigits: 0
                    });
                    billRangeText.textContent = `Solo se aceptan montos desde ${numberFormatter.format(MIN_BILL_LOOKUP)} hasta ${numberFormatter.format(MAX_BILL_LOOKUP)}. Otros montos requieren contacto directo.`;


                    // --- INICIALIZACIÓN DE CHOICES.JS ---
                    const choicesInstances = [];
                    const selectElements = document.querySelectorAll('#select_comunas, #select_techos, #select_medidores');
                    selectElements.forEach(function(element) {
                        choicesInstances.push(new Choices(element, {
                            searchEnabled: true,
                            itemSelectText: 'Presiona Enter para seleccionar',
                            allowHTML: true,
                        }));
                    });

                    // --- FUNCIÓN DE CÁLCULO DE SIMULACIÓN (Lógica Requerida) ---

                    /**
                     * Realiza la simulación de proyecto solar para clientes residenciales.
                     * @param {object} data - Datos del formulario.
                     * @returns {object} Resultados de la simulación.
                     */
                   function runResidentialSimulation(data) {
    const billCLP = parseFloat(data.monthlyBillCLP);

    // 1. Obtener multiplicadores con fallback a 1.0 para evitar NaN
    const selectTecho = document.getElementById('select_techos');
    const selectedTechoOption = selectTecho.options[selectTecho.selectedIndex];
    // Aseguramos que si no hay selección o atributo, el valor sea "1"
    const roofMultiplier = parseFloat(selectedTechoOption?.getAttribute('data-multiplier') || "1.0");

    const selectMedidor = document.getElementById('select_medidores');
    const selectedMedidorOption = selectMedidor.options[selectMedidor.selectedIndex];
    const meterMultiplier = parseFloat(selectedMedidorOption?.getAttribute('data-multiplier') || "1.0");

    // Debug para ver qué valores están llegando
    console.log("Multiplicadores detectados:", { roofMultiplier, meterMultiplier });

    if (roofMultiplier === 0) {
        return { isApt: false, cost: 0, data: null };
    }

    let selectedData = null;

    if (billCLP > MAX_BILL_LOOKUP) {
        return { isApt: 'contactar_max', cost: 0, data: null };
    }

    if (billCLP < MIN_BILL_LOOKUP) {
        selectedData = SIMULATOR_DATA.find(d => Number(d.consumo_bruto) === MIN_BILL_LOOKUP);
    } else {
        const sortedData = [...SIMULATOR_DATA].sort((a, b) => b.consumo_bruto - a.consumo_bruto);
        selectedData = sortedData.find(row => parseFloat(row.consumo_bruto) <= billCLP);
    }

    if (!selectedData) {
        return { isApt: 'error', cost: 0, data: null };
    }

    // 4. Cálculo del Costo Final (Asegurar que on_grid_neto sea número)
    const baseCost = parseFloat(selectedData.on_grid_neto);
    
    if (isNaN(baseCost)) {
        console.error("Error: baseCost es NaN. Verifica que on_grid_neto en SIMULATOR_DATA sea numérico.");
        return { isApt: 'error', cost: 0, data: null };
    }

    const valorOperado1 = baseCost * (roofMultiplier - 1);
    const valorOperado2 = baseCost * (meterMultiplier - 1);

    const finalCost = baseCost + valorOperado1 + valorOperado2;

    return {
        isApt: true,
        totalCostCLP: Math.round(finalCost / 1000) * 1000,
        data: selectedData,
    };
}


                    // --- FUNCIÓN DE NAVEGACIÓN Y PROGRESO ---

                    /**
                     * Calcula el porcentaje de progreso basado en el tipo de cliente.
                     */
                    function calculateProgress(currentStep, type) {
                        const totalFormSteps = (type === 'residencial') ? TOTAL_RESIDENCIAL_STEPS : TOTAL_INDUSTRIAL_STEPS;

                        if (currentStep === 7) return {
                            percentage: 100,
                            text: 'Completado'
                        };

                        let actualStepCount = currentStep;
                        if (type === 'industrial' && currentStep > 1) {
                            actualStepCount = 2; // Industrial solo tiene paso 1 y paso 6 (contacto)
                        } else if (type === 'residencial' && currentStep > 0) {
                            actualStepCount = currentStep;
                        }

                        const percentage = (actualStepCount / totalFormSteps) * 100;
                        let stepText = `Paso ${actualStepCount} de ${totalFormSteps}`;

                        return {
                            percentage: percentage,
                            text: stepText
                        };
                    }

                    /**
                     * Actualiza la visibilidad de los pasos y los botones de navegación.
                     */
                    function updateForm() {

                        steps.forEach(step => {
                            const stepNumber = parseInt(step.getAttribute('data-step'));

                            step.style.display = (stepNumber === currentStep) ? 'block' : 'none';

                            // Ocultar pasos residenciales intermedios si es cliente industrial
                            if (clientType === 'industrial' && (stepNumber >= 2 && stepNumber <= 5)) {
                                step.style.display = 'none';
                            }
                        });

                        // --- Lógica de Botones ---
                        const isFinalStep = currentStep === 7;
                        const isContactStep = currentStep === 6;

                        prevBtn.style.display = (currentStep > 1 && !isFinalStep) ? 'inline-block' : 'none';
                        nextBtn.style.display = (!isFinalStep && !isContactStep) ? 'inline-block' : 'none';
                        submitBtn.style.display = (isContactStep) ? 'inline-block' : 'none';

                        if (isFinalStep) {
                            prevBtn.style.display = 'none';
                            nextBtn.style.display = 'none';
                            submitBtn.style.display = 'none';
                        }

                        // --- Lógica de Barra de Progreso ---
                        const progressInfo = calculateProgress(currentStep, clientType);

                        progressBar.style.width = `${progressInfo.percentage}%`;
                        progressBar.setAttribute('aria-valuenow', progressInfo.percentage);
                        progressBar.textContent = progressInfo.text;

                        if (isFinalStep) {
                            progressBar.classList.remove('bg-primary');
                            progressBar.classList.add('bg-success');
                            displaySummary();
                        } else {
                            progressBar.classList.remove('bg-success');
                            progressBar.classList.add('bg-primary');
                        }
                    }


                    // --- FUNCIÓN DE VALIDACIÓN ---

                    function validateStep(stepNumber) {
                        const currentStepElement = document.querySelector(`.step[data-step="${stepNumber}"]`);
                        const requiredFields = currentStepElement.querySelectorAll('[required]');
                        let isValid = true;

                        // 1. Manejo especial para el Paso 1 (Radio Buttons)
                        if (stepNumber === 1) {
                            const selectedType = document.querySelector('input[name="clientType"]:checked');
                            if (!selectedType) {
                                typeFeedback.style.display = 'block';
                                return false;
                            }
                            typeFeedback.style.display = 'none';
                            clientType = selectedType.value;
                            return true;
                        }

                        // 2. Validación de campos normales
                        requiredFields.forEach(field => {
                            let fieldValue = field.value.trim();
                            let fieldName = field.name;
                            let fieldValid = true;

                            field.classList.remove('is-invalid'); // Limpiar antes de validar

                            if (field.tagName === 'SELECT' && fieldValue === '') {
                                fieldValid = false;
                            } else if (field.tagName === 'INPUT' && fieldValue === '') {
                                fieldValid = false;
                            } else if (field.tagName === 'INPUT') {

                                // Validación de Boleta (Paso 5)
                                if (fieldName === 'monthlyBillCLP') {
                                    const bill = parseInt(fieldValue);
                                    const feedbackElement = document.getElementById('boleta-feedback');

                                    if (bill < 1) {
                                        fieldValid = false;
                                        feedbackElement.textContent = "El monto debe ser un número positivo.";
                                    } else if (bill < MIN_BILL_LOOKUP) {
                                        fieldValid = false;
                                        feedbackElement.textContent = `El monto mínimo de simulación es ${numberFormatter.format(MIN_BILL_LOOKUP)} CLP.`;
                                    } else {
                                        feedbackElement.textContent = "Por favor, ingresa un monto válido.";
                                    }
                                }

                                // Validación de Email (Paso 6)
                                if (fieldName === 'email') {
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(fieldValue)) {
                                        fieldValid = false;
                                    }
                                }
                            }

                            // --- 3. APLICACIÓN DE ESTILOS ---
                            if (!fieldValid) {
                                field.classList.add('is-invalid');
                                isValid = false;
                            }
                        });

                        return isValid;
                    }

                    // --- FUNCIÓN DE RESUMEN FINAL ---

                    function displaySummary() {
                        const formData = new FormData(form);
                        const data = Object.fromEntries(formData.entries());

                        // Reutilizar el numberFormatter
                        const localFormatter = new Intl.NumberFormat('es-CL', {
                            style: 'currency',
                            currency: 'CLP',
                            minimumFractionDigits: 0
                        });

                        // 1. Resumen de Contacto
                        document.getElementById('summaryType').textContent = data.clientType.charAt(0).toUpperCase() + data.clientType.slice(1);
                        document.getElementById('summaryEmail').textContent = data.email || 'N/A';
                        document.getElementById('summaryPhone').textContent = data.telefono || 'N/A';

                        const simulationContainer = document.getElementById('summarySimulation');
                        const simulationDetails = document.getElementById('simulationDetails');

                        // 2. Lógica de Simulación
                        if (data.clientType === 'residencial') {
                            const bill = parseFloat(data.monthlyBillCLP);
                            const formattedBill = localFormatter.format(bill);

                            const results = runResidentialSimulation(data);
                            console.log("DEBUG: Resultados de simulación residencial:", results);
                            simulationContainer.style.display = 'block';

                            if (results.isApt === true) {
                                // Proyecto apto y calculado
                                const consumoBrutoFormateado = localFormatter.format(results.data.consumo_bruto);

                                document.getElementById('simConsumoBruto').textContent = consumoBrutoFormateado;
                                document.getElementById('simPotenciaTotalFV').textContent = results.data.potencia_total_fv;
                                document.getElementById('simPotenciaInversor').textContent = results.data.potencia_inversor;
                                document.getElementById('simCantidadPaneles').textContent = results.data.cantidad_paneles;
                                document.getElementById('simCost').textContent = localFormatter.format(results.totalCostCLP);

                                simulationDetails.innerHTML = `Basado en su boleta de **${formattedBill}**, hemos utilizado la tabla de costos de **${consumoBrutoFormateado}** (el monto más cercano menor o igual). El costo final incluye los ajustes por complejidad de techo y medidor.`;

                            } else if (results.isApt === 'contactar_max') {
                                // Monto muy alto 
                                simulationContainer.style.display = 'none';
                                simulationDetails.innerHTML = `<p class="text-xl text-red-600 font-bold">MONTO EXCEDIDO</p>
        <p class="text-base text-gray-700 mt-2">Su boleta de **${formattedBill}** excede el rango de simulación automática (${localFormatter.format(MAX_BILL_LOOKUP)} CLP). Un ejecutivo especialista se contactará a la brevedad para realizar una cotización personalizada de su proyecto.</p>`;

                            } else if (results.isApt === false) {
                                // Techo no apto (multiplicador 0)
                                simulationContainer.style.display = 'none';
                                const selectTecho = document.getElementById('select_techos');
                                const selectedTechoText = selectTecho.options[selectTecho.selectedIndex].text;
                                simulationDetails.innerHTML = `<p class="text-red-600 font-semibold">AVISO IMPORTANTE:</p>
        <p>El tipo de techo seleccionado (${selectedTechoText}) no es apto para una instalación estándar. Un ejecutivo se contactará para revisar soluciones alternativas.</p>`;
                            } else if (results.isApt === 'error') {
                                // Error de datos
                                simulationContainer.style.display = 'none';
                                simulationDetails.innerHTML = `<p class="text-red-600 font-semibold">ERROR DE DATOS:</p>
        <p>No se pudo encontrar una entrada de simulación válida. Por favor, contacta a soporte.</p>`;
                            }


                        } else { // Industrial/Comercial
                            simulationContainer.style.display = 'none';
                            simulationDetails.innerHTML = `<p class="text-blue-600 font-semibold">PROYECTO INDUSTRIAL/COMERCIAL:</p>
    <p>Un especialista se contactará a la brevedad para analizar sus requerimientos de potencia y consumo y elaborar una propuesta personalizada.</p>`;
                        }
                    }

                    // --- LISTENERS DE NAVEGACIÓN ---

                    nextBtn.addEventListener('click', function() {
                        if (validateStep(currentStep)) {
                            if (currentStep === 1) {
                                currentStep = (clientType === 'industrial') ? 6 : 2;
                            } else {
                                currentStep++;
                            }
                            updateForm();
                        }
                    });

                    prevBtn.addEventListener('click', function() {
                        if (currentStep > 1) {
                            if (currentStep === 6 && clientType === 'industrial') {
                                currentStep = 1;
                            } else if (currentStep === 6 && clientType === 'residencial') {
                                currentStep = 5;
                            } else {
                                currentStep--;
                            }
                            updateForm();
                        }
                    });

                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // --- VERIFICACIÓN CRUCIAL: Existe ajaxurl? ---
                        if (typeof ajaxurl === 'undefined') {
                            console.error("ERROR CRÍTICO: La variable 'ajaxurl' no está definida. No se puede enviar la solicitud AJAX.");
                            alert("Error de configuración. Contacta al administrador.");
                            return; // Salir si no hay ajaxurl
                        }

                        console.log("DEBUG: ajaxurl encontrada:", ajaxurl); // Verificar que se haya definida

                        if (currentStep !== 7) {
                            if (validateStep(currentStep)) {
                                currentStep = 7;
                                updateForm();
                            }
                            return;
                        }

                        if (!validateStep(6)) {
                            console.error("Validación de contacto fallida antes del envío AJAX.");
                            return;
                        }

                        const formData = new FormData(form);

                        // --- VERIFICACIÓN CRUCIAL: Añadir action ---
                        formData.append('action', 'handle_simulation_form'); // <-- Muy importante

                        // Opcional: Agregar el nonce si lo usas
                        // formData.append('simulation_nonce', simulationNonce);

                        console.log("DEBUG: Enviando datos al servidor:", Object.fromEntries(formData.entries()));

                        submitBtn.disabled = true;
                        submitBtn.textContent = "Enviando...";

                        fetch(ajaxurl, { // <-- AHORA USA ajaxurl definida arriba
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => {
                                console.log("DEBUG: Respuesta recibida del servidor. Status:", response.status);
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(response => {
                                console.log("DEBUG: Respuesta JSON del servidor:", response);
                                if (response.success) {
                                    console.log(response.message);
                                } else {
                                    const errorMessage = response.data?.message || "Error desconocido del servidor.";
                                    alert("Hubo un error: " + errorMessage);
                                    console.error("Error del servidor:", response.data);
                                }
                            })
                            .catch(error => {
                                console.error("Error de red, parseo o HTTP en la solicitud AJAX:", error);
                                alert("Hubo un problema con la conexión o la respuesta del servidor. Inténtalo de nuevo.");
                            })
                            .finally(() => {
                                submitBtn.disabled = false;
                                submitBtn.textContent = "Finalizar";
                            });
                    });

                    function resetForm() {
                        currentStep = 1;
                        clientType = '';
                        form.reset();

                        document.querySelectorAll('.is-invalid').forEach(el => {
                            el.classList.remove('is-invalid');
                        });

                        choicesInstances.forEach(instance => {
                            // Resetear la selección visualmente
                            instance.setChoiceByValue('');
                        });

                        selectElements.forEach(select => {
                            select.value = '';
                        });

                        updateForm();
                    }

                    // --- INICIALIZACIÓN ---
                    resetBtn.addEventListener('click', resetForm);
                    updateForm();
                });
            </script>

    <?php
    endwhile;
    wp_reset_postdata();
endif;
    ?>