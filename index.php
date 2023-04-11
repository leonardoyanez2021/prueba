<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Formulario de votaci&oacute;n</title>
</head>
<body>
	<H1>Formulario de votaci&oacute;n</H1>
	<table>
		<tr>
			<td>Nombre y apellido</td><td><input type="text" id="nombre"></td>
		</tr>
		<tr>
			<td>Alias</td><td><input type="text" id="alias"></td>
		</tr>
		<tr>
			<td>Rut</td><td><input type="text" id="rut"></td>
		</tr>
		<tr>
			<td>Email</td><td><input type="text" id="email"></td>
		</tr>
		<tr>
			<td>Regi&oacute;n</td>
			<td>
				<select name="id_region" id="id_region">
					<option value="0">Seleccione</option>
					<?php
					$conn = new mysqli('localhost', 'root', '', 'bd_prueba');
					$result = $conn->query("SELECT * FROM region");
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {                
							echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Comuna</td><td><select name="id_comuna" id="id_comuna"></select></td>
		</tr>
		<tr>
			<td>Candidato</td>
			<td>
				<select name="id_candidato" id="id_candidato">
					<option value="0">Seleccione</option>
					<?php
					$conn = new mysqli('localhost', 'root', '', 'bd_prueba');
					$result = $conn->query("SELECT * FROM candidato");
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {                
							echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>C&oacute;mo se enter&oacute; de nosotros</td>
			<td>
				<input type="checkbox" name="entero" id="checkbox-1" value="Web"/>
				<label for="checkbox-1">Web</label>
				<input type="checkbox" name="entero" id="checkbox-2" value="TV"/>
				<label for="checkbox-2">TV</label>
				<input type="checkbox" name="entero" id="checkbox-3" value="RRSS"/>
				<label for="checkbox-3">RRSS</label>
				<input type="checkbox" name="entero" id="checkbox-4" value="Amigo"/>
				<label for="checkbox-4">Amigo</label>
			</td>
		</tr>
		<tr>
			<td colspan=2><button type="submit" id="button">Votar</button></td>
		</tr>
	</table>
	
	
    <script>
	
	//valida campos
	function valida() {

		if ($("#nombre").val().trim().length==0) {
			alert("Por favor ingrese un nombre");
			return false;
		}
		
		if (!/\d/.test($("#alias").val().trim()) ) {
			alert("El alias debe tener algún número.");
			return false;
		}


		if (!/[a-zA-Z]/g.test($("#alias").val().trim()) ) {
			alert("El alias debe tener alguna letra.");
			return false;
		}

		if ($("#alias").val().trim().length<5) {
			alert("El alias debe contener al menos 5 caracteres.");
			return false;
		}

		if(!Fn.validaRut($("#rut").val().trim())){
			alert("Rut inválido, formato: 12345678-9.");
			return false;
		}
		
		
		// Define la expresion regular del correo.
		var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

		if(!validEmail.test($("#email").val().trim())){
			alert('Email inválido.');
			return false;
		}

		if($("#id_region").val().trim()==0){
			alert('Seleccione una región.');
			return false;
		}

		if($("#id_candidato").val().trim()==0){
			alert('Seleccione un candidato.');
			return false;
		}
		
		if ($('input:checkbox:checked').length < 2) {
			alert('Seleccione al menos 2 opciones de cómo se enteró de nosotros.');
			return false;
		}
	
		return true;
	}	
	
	$(document).ready(function(){
		$("#button").click(function(){ //envía a grabar
		
			//valida campos
			if (!valida()) {
				return false;
			}	
				
			var nombre=$("#nombre").val();
			var alias=$("#alias").val();
			var rut=$("#rut").val();
			var email=$("#email").val();
			var id_region=$('#id_region option:selected').val();
			var id_comuna=$('#id_comuna option:selected').val();
			var id_candidato=$('#id_candidato option:selected').val();
			var entero=$('input[name="entero"]:checked').serialize()
			$.ajax({
				url:'insert.php',
				method:'POST',
				data:{
					nombre:nombre,
					alias:alias,
					rut:rut,
					email:email,
					id_region:id_region,
					id_comuna:id_comuna,
					id_candidato:id_candidato,
					entero:entero
				},
			   success:function(data){
				   alert(data);
			   }
			});
		});
		$("#id_region").on('change', function () { //carga comunas por region
			$("#id_region option:selected").each(function () {
				var id_region = $(this).val();
				$.post("comunas.php", { id_region: id_region }, function(data) {
					$("#id_comuna").html(data);
				});			
			});
	   });
	});
		
		
	var Fn = {
		// Valida el rut con su cadena completa "XXXXXXXX-X"
		validaRut : function (rutCompleto) {
			if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
				return false;
			var tmp 	= rutCompleto.split('-');
			var digv	= tmp[1]; 
			var rut 	= tmp[0];
			if ( digv == 'K' ) digv = 'k' ;
			return (Fn.dv(rut) == digv );
		},
		dv : function(T){
			var M=0,S=1;
			for(;T;T=Math.floor(T/10))
				S=(S+T%10*(9-M++%6))%11;
			return S?S-1:'k';
		}
	}
		
    </script>
</body>
</html>