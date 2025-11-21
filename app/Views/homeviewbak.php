<!Doctype html>

<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" /> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.min.js"></script> <script type="text/javascript" language="javascript"> </script>
<script>
$(document).on('keydown', '#t_itemname', function () {
var datastring = $("#t_itemname").val();
//alert(datastring);
//alert('jj');
$.ajax({
type: "POST",
url: "itemprice",
async:false,
data: {'itemname': datastring},
//dataType: "json",
success: function (data2) {
  //data3 = json_decode(data2);
  //alert(data2);
  //data3=data2.item_wise;
  //alert(data3);
  var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses']]);
          var i, td, ppu, data3; // using the $ prefix to use the "jQuery wrapped var" convention x = []; 
          data3=JSON.parse(data2);
          data4=data3.item_wise;
          console.log(data4);
          console.log(data4.length);
          
          /*
          for (i=0; i<$data4.length; i++ ) { 
            tdate = $data4[i].thedate;
            ppu = $data4[i].price_per_unit;
            alert(tdate); alert(ppu);
            data.push(Array(td, ppu, 10)); 
            
          }*/
          $.each(data4, function(index, Item){ 
            console.log(index);
            console.log(Item);
            $.each (Item,function(key,value)
            { //console.log(key); 
            //console.log(value); 
              a=[];
              if (key=='thedate')
              {
                tdate=value;
                a.push(tdate);
              }
              if (key=='price_per_unit')
              {
                a.push(value);
                a.push(10);
              }            
            //console.log(a);            
            })
            data.push(a);
            data.push(100, 100, 100);
          }); 


        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
}//success
});//ajax
});//document
</script>


  <title>Google Date Wise Bar and Line Chart Codeigniter Tutorial</title>
<body>
<!--  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

  <script type="text/javascript">

      google.charts.load('visualization', "1", {

          packages: ['corechart']

      });

  </script>

</head>

<body>

<div class="row">

  <div class="col-md-12">
    <input type='text' id='t_itemname'></input>
    <div id="line_date_wise" style="width: 900px; height: 500px; margin: 0 auto"></div>

    <div id="bar_date_wise" style="width: 900px; height: 500px; margin: 0 auto"></div>

  </div>  

</div>

</body>
<script language="JavaScript">
  // Draw the pie chart for registered users month wise
  google.charts.setOnLoadCallback(lineChart);
 
  // Draw the pie chart for registered users year wise
  google.charts.setOnLoadCallback(barChart);
   
  //for
  function lineChart() {
 
        /* Define the chart to be drawn.*/
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Users Count'],
            //var data = new google.visualization.arraytoDataTable();    
    //data.addColumn('date', 'Date'); data.addColumn('number', 'Users Count'); 

            <?php 
             //foreach ($day_wise as $row){
             //echo "['".$row->itemname."',".$row->count."],";
             //for ($i=1; $i<10; $i++){
             //echo "[1,2]";
               
             //}
             ?>
        ]);
 
        var options = {
          title: 'Day Wise Registered Users Of Line Chart',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        /* Instantiate and draw the chart.*/
        var chart = new google.visualization.LineChart(document.getElementById('line_date_wise'));
        chart.draw(data, options);
  }
  // for
  function barChart() {
 
    /* Define the chart to be drawn.*/
    var data = google.visualization.arrayToDataTable([
        ['Date', 'Users Count'],
//var data = new google.visualization.arraytoDataTable();    
  //  data.addColumn('date', 'Date'); data.addColumn('number', 'Users Count'); 

        <?php 
         //foreach ($day_wise as $row){
         //echo "['".$row->itemname."',".$row->count."],";
         //}
         ?>
    ]);
    var options = {
        title: 'Date wise Registered Users Bar Chart',
        is3D: true,
    };
    /* Instantiate and draw the chart.*/
    var chart = new google.visualization.BarChart(document.getElementById('bar_date_wise'));
    chart.draw(data, options);
  }
</script>-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          //['2004',  1000,      400],
          //['2005',  1170,      460],
          //['2006',  660,       1120],
          //['2007',  1030,      540],
          <?php foreach ($item_wise as $row){
         //var_dump($item_wise);
         echo "['".$row->thedate."',".$row->price_per_unit.",0],";
         //echo "[20221101, 11.5, 12],";
         //echo "[20221201, 1.9, 1],";
         }?>
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<body>
  <input type='text' id='t_itemname' name='t_itemname' ></input>
    
  <div id="curve_chart" style="width: 900px; height: 500px"></div></body>
  

</body>
<html>

