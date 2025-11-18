document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const ingresoSemanal = document.getElementById('ingresoSemanal');
    const aportacionAhorro = document.getElementById('aportacionAhorro');
    const totalIngresos = document.getElementById('totalIngresos');
    const totalGastos = document.getElementById('totalGastos');
    const totalAhorro = document.getElementById('totalAhorro');
    const capacidadAhorro = document.getElementById('capacidadAhorro');
    
    // Elementos de distribución
    const fijosObligatoriosTotal = document.getElementById('fijosObligatoriosTotal');
    const fijosObligatoriosPorcentaje = document.getElementById('fijosObligatoriosPorcentaje');
    const fijosReduciblesTotal = document.getElementById('fijosReduciblesTotal');
    const fijosReduciblesPorcentaje = document.getElementById('fijosReduciblesPorcentaje');
    const variablesTotal = document.getElementById('variablesTotal');
    const variablesPorcentaje = document.getElementById('variablesPorcentaje');
    const ahorroTotal = document.getElementById('ahorroTotal');
    const ahorroPorcentaje = document.getElementById('ahorroPorcentaje');
    const ahorroAdicionalTotal = document.getElementById('ahorroAdicionalTotal');
    const ahorroAdicionalPorcentaje = document.getElementById('ahorroAdicionalPorcentaje');
    
    // Botones
    const clearBtn = document.getElementById('clearBtn');
    const saveBtn = document.getElementById('saveBtn');

    function calcularTotales() {

    const ingresos = parseFloat(ingresoSemanal.value) || 0;
    totalIngresos.textContent = formatCurrency(ingresos);
    
    // Categorías de gastos
    const expenseCategories = document.querySelectorAll('.expense-category');
    
    // Inicializar eventos
    initEvents();
    
    function initEvents() {
        // Eventos para inputs principales
        ingresoSemanal.addEventListener('input', calcularTotales);
        aportacionAhorro.addEventListener('input', calcularTotales);
        
        // Eventos para categorías de gastos
        expenseCategories.forEach(category => {
            const title = category.querySelector('h3');
            const inputsContainer = category.querySelector('.expense-inputs');
            const addButton = category.querySelector('.add-expense');
            
            // Alternar visibilidad de inputs
            title.addEventListener('click', function() {
                inputsContainer.classList.toggle('hidden');
            });
            
            // Agregar nuevo campo de gasto
            addButton.addEventListener('click', function() {
                const newExpenseItem = document.createElement('div');
                newExpenseItem.className = 'expense-item';
                newExpenseItem.innerHTML = `
                    <input type="text" class="expense-name" placeholder="Concepto">
                    <input type="number" class="expense-amount" min="0" placeholder="0">
                `;
                inputsContainer.insertBefore(newExpenseItem, addButton);
                
                // Agregar evento al nuevo input
                const amountInput = newExpenseItem.querySelector('.expense-amount');
                amountInput.addEventListener('input', calcularTotales);
            });
            
            // Eventos para inputs de gastos existentes
            const amountInputs = category.querySelectorAll('.expense-amount');
            amountInputs.forEach(input => {
                input.addEventListener('input', calcularTotales);
            });
        });
        
        // Eventos para botones
        clearBtn.addEventListener('click', limpiarFormulario);
        saveBtn.addEventListener('click', guardarDatos);
    }
    
    function calcularTotales() {
        // Calcular ingresos
        const ingresos = parseFloat(ingresoSemanal.value) || 0;
        totalIngresos.textContent = ingresos.toFixed(2);
        
        // Calcular gastos por categoría
        let gastosFijosObligatorios = 0;
        let gastosFijosReducibles = 0;
        let gastosVariables = 0;
        
        // Fijos obligatorios
        const fijosObligatoriosInputs = document.querySelectorAll('#fijosObligatorios .expense-amount');
        fijosObligatoriosInputs.forEach(input => {
            gastosFijosObligatorios += parseFloat(input.value) || 0;
        });
        
        // Fijos reducibles
        const fijosReduciblesInputs = document.querySelectorAll('#fijosReducibles .expense-amount');
        fijosReduciblesInputs.forEach(input => {
            gastosFijosReducibles += parseFloat(input.value) || 0;
        });
        
        // Variables
        const variablesInputs = document.querySelectorAll('#variables .expense-amount');
        variablesInputs.forEach(input => {
            gastosVariables += parseFloat(input.value) || 0;
        });
        
        // Calcular total de gastos
        const totalGastosValor = gastosFijosObligatorios + gastosFijosReducibles + gastosVariables;
        totalGastos.textContent = totalGastosValor.toFixed(2);
        
        // Calcular ahorro
        const ahorro = parseFloat(aportacionAhorro.value) || 0;
        totalAhorro.textContent = ahorro.toFixed(2);
        
        // Calcular capacidad de ahorro adicional
        const capacidadAhorroValor = ingresos - totalGastosValor - ahorro;
        capacidadAhorro.textContent = capacidadAhorroValor.toFixed(2);
        
        // Actualizar distribución de gastos
        actualizarDistribucion(
            gastosFijosObligatorios, 
            gastosFijosReducibles, 
            gastosVariables, 
            ahorro, 
            capacidadAhorroValor,
            ingresos
        );
    }
    
    function actualizarDistribucion(fijosObligatorios, fijosReducibles, variables, ahorro, ahorroAdicional, ingresos) {
        // Actualizar valores absolutos
        fijosObligatoriosTotal.textContent = fijosObligatorios.toFixed(2);
        fijosReduciblesTotal.textContent = fijosReducibles.toFixed(2);
        variablesTotal.textContent = variables.toFixed(2);
        ahorroTotal.textContent = ahorro.toFixed(2);
        ahorroAdicionalTotal.textContent = ahorroAdicional.toFixed(2);
        
        // Calcular porcentajes (basados en ingresos)
        if (ingresos > 0) {
            fijosObligatoriosPorcentaje.textContent = ((fijosObligatorios / ingresos) * 100).toFixed(1) + '%';
            fijosReduciblesPorcentaje.textContent = ((fijosReducibles / ingresos) * 100).toFixed(1) + '%';
            variablesPorcentaje.textContent = ((variables / ingresos) * 100).toFixed(1) + '%';
            ahorroPorcentaje.textContent = ((ahorro / ingresos) * 100).toFixed(1) + '%';
            ahorroAdicionalPorcentaje.textContent = ((ahorroAdicional / ingresos) * 100).toFixed(1) + '%';
        } else {
            fijosObligatoriosPorcentaje.textContent = '0%';
            fijosReduciblesPorcentaje.textContent = '0%';
            variablesPorcentaje.textContent = '0%';
            ahorroPorcentaje.textContent = '0%';
            ahorroAdicionalPorcentaje.textContent = '0%';
        }
    }
    
    function limpiarFormulario() {
        
        ingresoSemanal.value = '';
        aportacionAhorro.value = '';
        
        // Limpiar inputs de gastos
        const allAmountInputs = document.querySelectorAll('.expense-amount');
        allAmountInputs.forEach(input => {
            input.value = '';
        });
        
        const allNameInputs = document.querySelectorAll('.expense-name');
        allNameInputs.forEach(input => {
            input.value = '';
        });
        
        // Recalcular para actualizar la interfaz
        calcularTotales();
        alert('Formulario limpiado correctamente');
    }
    
    function guardarDatos() {
        // En una implementación real, aquí se enviarían los datos a un servidor
        // Por ahora, solo simulamos el guardado
        
        const datos = {
            ingresoSemanal: ingresoSemanal.value || 0,
            gastos: {
                fijosObligatorios: parseFloat(fijosObligatoriosTotal.textContent) || 0,
                fijosReducibles: parseFloat(fijosReduciblesTotal.textContent) || 0,
                variables: parseFloat(variablesTotal.textContent) || 0
            },
            ahorro: {
                aportacion: aportacionAhorro.value || 0,
                capacidadAdicional: capacidadAhorro.textContent || 0
            }
        };
        
        // Guardar en localStorage para persistencia en el navegador
        localStorage.setItem('calculadoraGastos', JSON.stringify(datos));
        alert('Datos guardados correctamente');
    }
    
    // Cargar datos guardados al iniciar (si existen)
    function cargarDatosGuardados() {
        const datosGuardados = localStorage.getItem('calculadoraGastos');
        if (datosGuardados) {
            const datos = JSON.parse(datosGuardados);
            
            // Cargar ingresos
            if (datos.ingresoSemanal) {
                ingresoSemanal.value = datos.ingresoSemanal;
            }
            
            // Cargar ahorro
            if (datos.ahorro && datos.ahorro.aportacion) {
                aportacionAhorro.value = datos.ahorro.aportacion;
            }
            
            // Recalcular para actualizar la interfaz
            calcularTotales();
        }
    }


    ingresoSemanal.addEventListener('input', calcularTotales);
    aportacionAhorro.addEventListener('input', calcularTotales);
    
    document.querySelectorAll('.expense-amount').forEach(input => {
        input.addEventListener('input', calcularTotales);
    });

    clearBtn.addEventListener('click', limpiarFormulario);
    saveBtn.addEventListener('click', guardarDatos);
    
    // Inicializar cargando datos guardados
    cargarDatosGuardados();
    calcularTotales();
});


document.getElementById('saveBtn').addEventListener('click', function() {
    const ingreso = parseFloat(document.getElementById('ingresoSemanal').value) || 0;
    

    const fijosObligatorios = Array.from(document.querySelectorAll('.expense-category:first-child .expense-amount'))
        .reduce((sum, input) => sum + (parseFloat(input.value) || 0), 0);
    

    const fijosReducibles = Array.from(document.querySelectorAll('.expense-category:nth-child(2) .expense-amount'))
        .reduce((sum, input) => sum + (parseFloat(input.value) || 0), 0);
    

    const variables = Array.from(document.querySelectorAll('.expense-category:nth-child(3) .expense-amount'))
        .reduce((sum, input) => sum + (parseFloat(input.value) || 0), 0);
    
    const ahorro = parseFloat(document.getElementById('aportacionAhorro').value) || 0;
    const capacidadAhorro = parseFloat(document.getElementById('capacidadAhorro').textContent) || 0;
    

    document.getElementById('inputIngresoSemanal').value = ingreso;
    document.getElementById('inputFijosObligatorios').value = fijosObligatorios;
    document.getElementById('inputFijosReducibles').value = fijosReducibles;
    document.getElementById('inputVariables').value = variables;
    document.getElementById('inputAportacionAhorro').value = ahorro;
    document.getElementById('inputCapacidadAhorro').value = capacidadAhorro;
    

    document.getElementById('presupuestoForm').submit();
});

function togglePresupuestos() {
    const lista = document.getElementById('presupuestosLista');
    const boton = document.querySelector('.toggle-presupuestos');
    
    if (lista.style.display === 'none') {
        lista.style.display = 'block';
        boton.textContent = '📊 Ocultar Presupuestos';
    } else {
        lista.style.display = 'none';
        boton.textContent = '📊 Mostrar Presupuestos (<?php echo count($presupuestos); ?>)';
    }
}