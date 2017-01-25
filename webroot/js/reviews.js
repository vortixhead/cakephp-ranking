jQuery(document).ready(function($) {

  //Actualizar cada 30 segundos
  // setTimeout(function(){
  //   console.log("30 segundos");
  // }, 3000);
  function startRefresh() {
      $.get('', function(data) {
          $(document.body).html(data);
      });
  }
  $(function() {
      setTimeout(startRefresh,30000);
  });


  // setInterval(function() {
  //   console.log("30 segundos");
  //   location.reload();
  // }, 30000);

  /**
   * Rankings Selection
   */
  var location_select = $('#locacion-select');
  var location_value = location_select.val();
  $('#locacion-select').change(function(){
    location_value = location_select.val();
    console.log('cambiado a: '+location_value);
  })

  $('#locacion-submit').click(function(){
    console.log('ir a: '+location_value);
  })


  /**
   * Single Ranking
   */


}); //document.ready
