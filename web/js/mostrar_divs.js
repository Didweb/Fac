 $ (document) .ready(function(){

		
		$ ("#accionaProyectos") .click(function () {

				$ ("#targetProyectos") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "block") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","none");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","block");

					});

					}
				
				});

			});

		});	



    $ (document) .ready(function(){

		
		$ ("#accionaCorreo") .click(function () {

				$ ("#targetCorreo") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "block") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","none");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","block");

					});

					}
				
				});

			});

		});		

    $ (document) .ready(function(){

		
		$ ("#accionaDF") .click(function () {

				$ ("#caja_datos") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "block") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","none");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","block");

					});

					}
				
				});

			});

		});	

    $ (document) .ready(function(){
		$ ("#accionaDF2") .click(function () {

				$ ("#caja_datos_activado") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "none") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","block");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","none");

					});

					}
				
				});

			});

		});	

		
    $ (document) .ready(function(){

		
		$ ("#accionaTelefono") .click(function () {

				$ ("#targetTelefono") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "block") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","none");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","block");

					});

					}
				
				});

			});

		});	
		

    $ (document) .ready(function(){

		
		$ ("#accionaDF") .click(function () {

				$ ("#targetDF") .each(function() {

					displaying  = $(this).css("display");

					if(displaying == "block") {

					$(this).fadeOut('slow',function() {

					$(this).css("displaying","none");

					});

					} else {

					$(this).fadeIn('slow',function() {

					$(this).css("display","block");

					});

					}
				
				});

			});

		});