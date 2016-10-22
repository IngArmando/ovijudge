<?php
   ob_start ("ob_gzhandler");
   $offset = 60 * 60 *3600;
   $expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
   header ($expire);
?>
//Nota: les recuerdo que validen del lado del servidor.
	jQuery.fn.lemez_aceptar = function (a,z) {
		
	    $(this).attr("autocomplete", "off");
		//$(this).css("border-color","red");
		//alert($(this).css("border-color"));
		//$(this).css("border-color","");
	    var c = true;
	    var d = false;
	    var e = "#CC0000";
		
	    var f = $(this).css("border-top-color");
		var f2 = $(this).css("border-bottom-color");
		var f3 = $(this).css("border-left-color");
		var f4 = $(this).css("border-right-color");
	    var g = $(this);
	    switch (a) {
	    case "texto":
	        var h = /^[a-zA-Z \u00C0-\u00ff\s]+$/;
	        var i = "Solo se acepta Texto";
	        break;

	    case "texto_numero":
	        var h = /^[a-zA-Z0-9 \u00C0-\u00ff\s]+$/;
	        var i = "Solo se acepta Texto y Numeros";
	        break;
	    case "texto_especial":
	        var h = /^[a-zA-Z., \u00C0-\u00ff\s]+$/;
	        var i = "Solo se acepta texto comas y puntos";
	        break;
	    case "numero":
	        var h = /^[\d]+$/;
	        var i = "Solo se aceptan Numeros";
	        break;
         case "numero_final":
	        var h = /^[\d]+$/;
			var d = true;
	        var i = "Solo se aceptan Numeros";
	        break;
	    case "numero_para_autocomplete":
	        var h = /^[\d]+$/;
	        var d = true;
	        var i = false;
	        break;
	    case "numero_especial":
	        var h = /^[\d.,]+$/;
	        var i = "Solo se aceptan Numeros";
	        break;
	    case "correo":
	        var h = /([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}/;
	        var d = true;
	        var i = "Debe introducir un correo electronico valido Ej: pagina@pagina.com";
	        break;
	    case "todo":
	        var h = /[^\s]/;
	        var d = true;
	        var i = "No deje espacios en blanco";
	        break;
		case "url":
	        var h = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/;
	        var d = true;
	        var i = "Debe introducir una URL valida Ej: http://google.com";
	        break;
		case "telefono":
	        var h = /^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/;
	        var d = true;
	        var i = "Debe introducir un telefono valido Ej: 0255-1111222";
	        break;
		case "ip":
	        var h = /\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/;
	        var d = true;
	        var i = "Debe introducir una ip valida Ej: 192.168.1.1";
	        break;
		case "fecha":
	        var h = /^(?:(?:0?[1-9]|1\d|2[0-8])(\/|-)(?:0?[1-9]|1[0-2]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:31(\/|-)(?:0?[13578]|1[02]))|(?:(?:29|30)(\/|-)(?:0?[1,3-9]|1[0-2])))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(29(\/|-)0?2)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/;
	        var d = true;
	        var i = "Debe introducir una fecha valida Ej: 29-02-1988";
	        break;
		case "contrasena":
	        var h = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;
	        var d = true;
	        var i = "Debe introducir una contraseña que contenga entre 8 a 10 caracteres, estos deben contener letras y numeros.";
	        break;
				  
	    default:
	        {
	            var h = a;
	            var d = true;
	            var i = "Existe un error de Validacion, Por Favor Verifique sus campos."
	        }
	    }
	    posicion = g.position();
	    var j = document.createElement("div");
	    j.id = "div_msj" + g.attr("id");
	    var k = g.height() + 4;
	    $(j).css({
	        border: "1px solid #777",
	        background: "#E6E6E6",
	        position: "absolute",
	        "border-radius": "3px",
	        top: posicion.top + k,
	        left: posicion.left
	    });
	    j.innerHTML = i;
	    $("body").append(j);
	    $(j).hide();
	    $(this).keypress(function (a) {
	        if (d == false) {
	            c = h.test(String.fromCharCode(a.which));
				
	            if (a.which == 8 || a.which == 0) c = true;
	            return c
	        }
	    });
	    $(this).keyup(function () {
	        j.innerHTML = i;
	        if (d == false) {
	            if (c == false) {
	               tool_tip(g,i)
	            } else {
	               destruir_tol_tip(g)
	            }
	        }
	    });
	    $(this).blur(function () {
	        if (z != "" && g.val()) {
	            if (h.test(g.val()) == false) {
	                $(g).css("border-color", e);
	                $(g).focus();
	                if(i!=false)
	                alert(i);
	                return false
	            } else {
	                $(g).css("border-color", f);
	                $("#div_msj" + g.attr("id")).hide();
	                return true
	            }
	        }
	    });
		
		//if(!z) {z="form"; b="no"};
	    $("button,input[type=submit],input[type=button]").click(function () {
			
			recolorear();
			if($(this).attr("id") && z){
				
				boton_clic=$(this).attr("id");
				todo_id_boton=z;
				
				id_boton=todo_id_boton.split(",");
				
				for (ii=0;ii<id_boton.length;ii++){
					if(boton_clic!=id_boton[ii]) {b="no";} else {b="si";ii=10000;}
				}
				
			}else{
				b="no";
			}
	        if (b == "si" && g.val() == "") {
	          	tool_tip(g,"Campo obligatorio");
	        } else {
	              destruir_tol_tip(g);
	        } if (b == "si" || b == "no" && g.val() != "") {
	            if (h.test(g.val()) == false) {
	                $(g).css("border-color", e);
					 
	                return false
	            } else {
					recolorear();
					//$("form:first").submit();
	                return true
	            }
	        }
	    })
			function recolorear(){
			        $(g).css("border-top-color", f);
					$(g).css("border-bottom-color", f2);
					$(g).css("border-left-color", f3);
					$(g).css("border-right-color", f4);
		}
        
        function tool_tip(g,i){
        $(g).tooltip('destroy');
         $(g).attr('data-toggle','tooltip');
         $(g).attr('title',i);
         $(g).attr('data-placement','top');
          $(g).attr('data-trigger','manual');
         
         $(g).tooltip('show');
        }
 
        function destruir_tol_tip(g){
        	$(g).tooltip('destroy');
        }
	}
