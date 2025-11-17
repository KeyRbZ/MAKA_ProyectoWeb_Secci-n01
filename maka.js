document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Calculadora MAKA cargada');

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
    const ingresoSemanal = document.getElementById('ingresoSemanal');
    const aportacionAhorro = document.getElementById('aportacionAhorro');
    const totalIngresos = document.getElementById('totalIngresos');
    const totalGastos = document.getElementById('totalGastos');
    const totalAhorro = document.getElementById('totalAhorro');
    const capacidadAhorro = document.getElementById('capacidadAhorro');


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
    
    const clearBtn = document.getElementById('clearBtn');
    const saveBtn = document.getElementById('saveBtn');

    function calcularTotales() {

    const ingresos = parseFloat(ingresoSemanal.value) || 0;
    totalIngresos.textContent = formatCurrency(ingresos);
    

    let gastosFijosObligatorios = 0;
    let gastosFijosReducibles = 0;
    let gastosVariables = 0;
    

    const allInputs = document.querySelectorAll('.expense-amount');
    

    gastosFijosObligatorios += parseFloat(allInputs[0]?.value) || 0;
    gastosFijosObligatorios += parseFloat(allInputs[1]?.value) || 0;
    gastosFijosObligatorios += parseFloat(allInputs[2]?.value) || 0;
    gastosFijosObligatorios += parseFloat(allInputs[3]?.value) || 0;
    

    gastosFijosReducibles += parseFloat(allInputs[4]?.value) || 0;
    gastosFijosReducibles += parseFloat(allInputs[5]?.value) || 0;
    

    gastosVariables += parseFloat(allInputs[6]?.value) || 0;
    gastosVariables += parseFloat(allInputs[7]?.value) || 0;
    

    const totalGastosValor = gastosFijosObligatorios + gastosFijosReducibles + gastosVariables;
    totalGastos.textContent = formatCurrency(totalGastosValor);
    

    const ahorro = parseFloat(aportacionAhorro.value) || 0;
    totalAhorro.textContent = formatCurrency(ahorro);
    

    const capacidadAhorroValor = Math.max(0, ingresos - totalGastosValor - ahorro);
    capacidadAhorro.textContent = formatCurrency(capacidadAhorroValor);
    

    actualizarDistribucion(
        gastosFijosObligatorios, 
        gastosFijosReducibles, 
        gastosVariables, 
        ahorro, 
        capacidadAhorroValor,
        ingresos
    );
    
    console.log('🔢 RESULTADOS:', {
        'Fijos Obligatorios': gastosFijosObligatorios,
        'Fijos Reducibles': gastosFijosReducibles,
        'Variables': gastosVariables,
        'Total Gastos': totalGastosValor
    });
}

    
    function actualizarDistribucion(fijosObligatorios, fijosReducibles, variables, ahorro, ahorroAdicional, ingresos) {

        fijosObligatoriosTotal.textContent = formatCurrency(fijosObligatorios);
        fijosReduciblesTotal.textContent = formatCurrency(fijosReducibles);
        variablesTotal.textContent = formatCurrency(variables);
        ahorroTotal.textContent = formatCurrency(ahorro);
        ahorroAdicionalTotal.textContent = formatCurrency(ahorroAdicional);
        

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
    
    function formatCurrency(value) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(value);
    }
    
    function limpiarFormulario() {
        
        ingresoSemanal.value = '';
        aportacionAhorro.value = '';
        

        const allAmountInputs = document.querySelectorAll('.expense-amount');
        allAmountInputs.forEach(input => {
            input.value = '';
        });
        
        calcularTotales();
        alert('Formulario limpiado correctamente');
    }
    
    function guardarDatos() {
        const datos = {
            ingresoSemanal: ingresoSemanal.value || 0,
            gastos: {
                fijosObligatorios: parseFloat(fijosObligatoriosTotal.textContent.replace(/[$,]/g, '')) || 0,
                fijosReducibles: parseFloat(fijosReduciblesTotal.textContent.replace(/[$,]/g, '')) || 0,
                variables: parseFloat(variablesTotal.textContent.replace(/[$,]/g, '')) || 0
            },
            ahorro: {
                aportacion: aportacionAhorro.value || 0,
                capacidadAdicional: parseFloat(capacidadAhorro.textContent.replace(/[$,]/g, '')) || 0
            },
            fecha: new Date().toLocaleString()
        };
        
        localStorage.setItem('calculadoraGastos', JSON.stringify(datos));
        alert('Datos guardados correctamente');
    }
    
    function cargarDatosGuardados() {
        const datosGuardados = localStorage.getItem('calculadoraGastos');
        if (datosGuardados) {
            try {
                const datos = JSON.parse(datosGuardados);
                
                if (datos.ingresoSemanal) {
                    ingresoSemanal.value = datos.ingresoSemanal;
                }
                
                if (datos.ahorro && datos.ahorro.aportacion) {
                    aportacionAhorro.value = datos.ahorro.aportacion;
                }
                
                calcularTotales();
            } catch (error) {
                console.error('Error al cargar datos guardados:', error);
            }
        }
    }


    ingresoSemanal.addEventListener('input', calcularTotales);
    aportacionAhorro.addEventListener('input', calcularTotales);
    
    document.querySelectorAll('.expense-amount').forEach(input => {
        input.addEventListener('input', calcularTotales);
    });

    clearBtn.addEventListener('click', limpiarFormulario);
    saveBtn.addEventListener('click', guardarDatos);
    

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