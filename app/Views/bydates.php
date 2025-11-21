<html>
<head>
  <style>
  table { border-collapse: collapse; } 
  table tr { border: 1px solid #F00; border-top: 1px solid #0F0; } 
  table td { border: 1px solid #F00; padding: 5px; }
  </style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.min.js"></script> <script type="text/javascript" language="javascript"> </script>
  <script>
$(document).on('change', '#selelement', function () {
//$(document).on('ready', function () {
  //alert('john');
var sv = $(this).val();
//alert(sv);
var thelist, items;
var grocdate, storename, itemname, ppu, nunits, totalprice; 
$.ajax({
type: "POST",
url: "getitemsbydateajax",
data: {'thedate': sv},
success: function (data) {
//console.log(data);
$('#ttable').html("<table><tr><th>Date</th><th>Store Name</th><th>Item Name</th><th>Price Per Unit</th><th>N Units</th><th>Price</th></tr>");
  thelist=JSON.parse(data);
  items = thelist.itemslist;
            totalprice = 0;
            $.each(items, function(index, titem){ 
              grocdate = titem.thedate;
              storename = titem.store_name;
              itemname = titem.item_name;
              ppu = titem.price_per_unit;
              nunits = titem.n_units;
              rowprice=ppu*nunits;
              totalprice+=rowprice;
              $('#ttable').append('<tr><td>'+grocdate+'</td><td>'+storename+'</td><td>'+itemname+'</td><td>'+ppu+'</td><td>'+nunits+'</td><td>'+rowprice+'</td></tr>')
            });
            $('#ttable').append('<tr><td>Total Price: </td><td></td><td></td><td></td><td></td><td>P'+totalprice+'</td></tr>')

  
          
}
})
});

</script>
</head>
<body>

<div id='selectdiv' name='selectdiv'>
  <select id='selelement' name='selelement'>
    
  <?php //var_dump($thedates[30]->thedate); die();
    for ($i=0; $i<count($thedates); $i++)
    {
//      echo "<option id='$thedates[$i]->thedate' name='$thedates[$i]->thedate'>$thedates[$i]->thedate</option>";
      $s=$thedates[$i]->thedate;
      echo "<option value='$s'>$s</option>";
    }
    echo "</select>";
  ?>
</div>  
<div id='tablediv' name='tablediv'></div>
<table id='ttable' name='ttable'></table>
</body>
</html>
