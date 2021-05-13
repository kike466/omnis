$(document).ready(function () {
   
  
    $("#AZ").click(function () {

        if (document.categorias.AZ.checked=true) {
            document.categorias.ZA.checked=false;
        }
       
  
    });
    $("#ZA").click(function () {

        if (document.categorias.ZA.checked=true) {
            document.categorias.AZ.checked=false;
        }
        
  
    });
    $("#menor").click(function () {

      
        if (document.categorias.menor.checked=true) {
            document.categorias.mayor.checked=false;
        }
  
    });
    $("#mayor").click(function () {

        
        if (document.categorias.mayor.checked=true) {
            document.categorias.menor.checked=false;
        }
        
  
    });

  });