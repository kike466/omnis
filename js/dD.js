$(document).ready(function () {
  $(".items_Menu_Header").hide();
  $(".items_Menu_Categorias").hide();

  $(".menu_1").click(function () {
    $(".items_Menu_Header").toggle();

  });
  $(".menu_2").click(function () {
    $(".items_Menu_Categorias").toggle();
  });


});