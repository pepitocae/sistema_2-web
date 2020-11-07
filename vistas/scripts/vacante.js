var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	});
    $('#mAlmacen').addClass("treeview active");
    $('#lVacantes').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idvacante").val("")
	$("#puesto").val("");
	$("#ubicacion").val("");
	$("#fecha_inicio").val("");
	$("#fecha_final").val("");
	$("#cliente").val("");
	$("#requisitos").val("");
	$("#clave").val("");
	
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}


//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: '<Bl<f>rtip>',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/vacante.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"language": {
            "lengthMenu": "Mostrar : _MENU_ registros",
            "buttons": {
            "copyTitle": "Tabla Copiada",
            "copySuccess": {
                    _: '%d líneas copiadas',
                    1: '1 línea copiada'
                }
            }
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/vacante.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idvacante)
{
	$.post("../ajax/vacante.php?op=mostrar",{idvacante : idvacante}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#puesto").val(data.puesto);
		$("#ubicacion").val(data.ubicacion);
		$("#fecha_inicio").val(data.fecha_inicio);
		$("#fecha_final").val(data.fecha_final);
		$("#cliente").val(data.cliente);
		$("#requisitos").val(data.requisitos);
		$("#clave").val(data.clave);
		$("#idvacante").val(data.idvacante);

 	})
}

//Función para desactivar registros
function desactivar(idvacante)
{
	bootbox.confirm("¿Está Seguro de desactivar la Vacante?", function(result){
		if(result)
        {
        	$.post("../ajax/vacante.php?op=desactivar", {idvacante : idvacante}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idcategoria)
{
	bootbox.confirm("¿Está Seguro de activar la Vacante?", function(result){
		if(result)
        {
        	$.post("../ajax/vacante.php?op=activar", {idvacante : idvacante}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();