document.addEventListener('DOMContentLoaded', function() {

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
    
    initEvents();
    
    function initEvents() {
        ingresoSemanal.addEventListener('input', function() {
            if (this.value < 0) this.value = 0;
            calcularTotales();
        });
        
        aportacionAhorro.addEventListener('input', function() {
            if (this.value < 0) this.value = 0;
            calcularTotales();
        });
        
        const amountInputs = document.querySelectorAll('.expense-amount');
        amountInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 0) this.value = 0;
                calcularTotales();
            });
        });

        clearBtn.addEventListener('click', limpiarFormulario);
        saveBtn.addEventListener('click', guardarDatos);
        
        calcularTotales();
    }
    
    function calcularTotales() {
        const ingresos = Math.max(0, parseFloat(ingresoSemanal.value) || 0);
        totalIngresos.textContent = formatCurrency(ingresos);
        
        let gastosFijosObligatorios = Math.max(0, calcularGastosCategoria('.expense-category:nth-of-type(1)'));
        let gastosFijosReducibles = Math.max(0, calcularGastosCategoria('.expense-category:nth-of-type(2)'));
        let gastosVariables = Math.max(0, calcularGastosCategoria('.expense-category:nth-of-type(3)'));
        
        const totalGastosValor = Math.max(0, gastosFijosObligatorios + gastosFijosReducibles + gastosVariables);
        totalGastos.textContent = formatCurrency(totalGastosValor);
        
        const ahorro = Math.max(0, parseFloat(aportacionAhorro.value) || 0);
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
    }
    
    function calcularGastosCategoria(selector) {
        const inputs = document.querySelectorAll(`${selector} .expense-amount`);
        let total = 0;
        inputs.forEach(input => {
            const valor = parseFloat(input.value) || 0;
            total += Math.max(0, valor);
        });
        return total;
    }
    
    function actualizarDistribucion(fijosObligatorios, fijosReducibles, variables, ahorro, ahorroAdicional, ingresos) {
        fijosObligatoriosTotal.textContent = formatCurrency(fijosObligatorios);
        fijosReduciblesTotal.textContent = formatCurrency(fijosReducibles);
        variablesTotal.textContent = formatCurrency(variables);
        ahorroTotal.textContent = formatCurrency(ahorro);
        ahorroAdicionalTotal.textContent = formatCurrency(ahorroAdicional);
        

        if (ingresos > 0) {
            fijosObligatoriosPorcentaje.textContent = calcularPorcentaje(fijosObligatorios, ingresos);
            fijosReduciblesPorcentaje.textContent = calcularPorcentaje(fijosReducibles, ingresos);
            variablesPorcentaje.textContent = calcularPorcentaje(variables, ingresos);
            ahorroPorcentaje.textContent = calcularPorcentaje(ahorro, ingresos);
            ahorroAdicionalPorcentaje.textContent = calcularPorcentaje(ahorroAdicional, ingresos);
        } else {
            // Si no hay ingresos, todos los porcentajes son 0%
            fijosObligatoriosPorcentaje.textContent = '0%';
            fijosReduciblesPorcentaje.textContent = '0%';
            variablesPorcentaje.textContent = '0%';
            ahorroPorcentaje.textContent = '0%';
            ahorroAdicionalPorcentaje.textContent = '0%';
        }
    }
    
    function calcularPorcentaje(valor, total) {
        return ((valor / total) * 100).toFixed(1) + '%';
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
        // Limpiar inputs principales
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
                localStorage.removeItem('calculadoraGastos');
            }
        }
    }
    
    cargarDatosGuardados();
});