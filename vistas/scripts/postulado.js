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
    $('#lPostulados').addClass("active");
}

//Función limpiar
function limpiar()
{
	$("#idpostulado").val("");
	$("#nombre").val("");
	$("#e_mail").val("");
	$("#telefono").val("");
	$("#sueldo").val("");
	$("#ciudad").val("");
	$("#estado").val("");
	$("#direccion").val("");
	$("#nivel_estudios").val("");
	$("#clave").val("");
	$("#curriculummuestra").attr("src","");
	$("#curriculumactual").val("");
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
					url: '../ajax/postulado.php?op=listar',
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
		url: "../ajax/postulado.php?op=guardaryeditar",
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

function mostrar(idpostulado)
{
	$.post("../ajax/postulado.php?op=mostrar",{idpostulado : idpostulado}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#e_mail").val(data.e_mail);
		$("#telefono").val(data.telefono);
		$("#sueldo").val(data.sueldo);
		$("#ciudad").val(data.ciudad);
		$("#estado").val(data.estado);
		$("#direccion").val(data.direccion);
		$("#nivel_estudios").val(data.nivel_estudios);
		$("#clave").val(data.clave);
		$("#curriculummuestra").show();
		$("#curriculummuestra").attr("src","../files/articulos/"+data.curriculum);
		$("#curriculumactual").val(data.curriculum);
 		$("#idpostulado").val(data.idpostulado);

 	})
}

//Función para desactivar registros
function desactivar(idpostulado)
{
	bootbox.confirm("¿Está Seguro de desactivar al aspirante?", function(result){
		if(result)
        {
        	$.post("../ajax/postulado.php?op=desactivar", {idpostulado : idpostulado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idpostulado)
{
	bootbox.confirm("¿Está Seguro de activar al aspirante?", function(result){
		if(result)
        {
        	$.post("../ajax/postulado.php?op=activar", {idpostulado : idpostulado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();