<?php
$koneksi     = mysqli_connect("localhost", "root", "", "penjualan");
$laptop      = mysqli_query($koneksi, "SELECT * FROM salespermonth WHERE produk='Americano'");
$pc          = mysqli_query($koneksi, "SELECT * FROM salespermonth WHERE produk='Indomie'");
$monitor     = mysqli_query($koneksi, "SELECT * FROM salespermonth WHERE produk='LaisCoffe'");
$printer     = mysqli_query($koneksi, "SELECT * FROM salespermonth WHERE produk=' RotiBakar'");
$accessories = mysqli_query($koneksi, "SELECT * FROM salespermonth WHERE produk='V60'");
?>

<script src="./js/Chart.js"></script>

<canvas id="linechart" width="600" height="200"></canvas>

<script  type="text/javascript">
  var ctx = document.getElementById("linechart").getContext("2d");
  var data = {
            labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
            datasets: [
                  {
                    label: "Americano",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#29B0D0",
                    borderColor: "#29B0D0",
                    pointHoverBackgroundColor: "#29B0D0",
                    pointHoverBorderColor: "#29B0D0",
                    data: [<?php while ($p = mysqli_fetch_array($laptop)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dec'] . '",';}?>]
                  },
                  {
                    label: "Indomie",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#2A516E",
                    borderColor: "#2A516E",
                    pointHoverBackgroundColor: "#2A516E",
                    pointHoverBorderColor: "#2A516E",
                    data: [<?php while ($p = mysqli_fetch_array($pc)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dec'] . '",';}?>]
                  },
                  {
                    label: "LaisCoffe",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#F07124",
                    borderColor: "#F07124",
                    pointHoverBackgroundColor: "#F07124",
                    pointHoverBorderColor: "#F07124",
                    data: [<?php while ($p = mysqli_fetch_array($monitor)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dec'] . '",';}?>]
                  },
                  {
                    label: "RotiBakar",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#CBE0E3",
                    borderColor: "#CBE0E3",
                    pointHoverBackgroundColor: "#CBE0E3",
                    pointHoverBorderColor: "#CBE0E3",
                    data: [<?php while ($p = mysqli_fetch_array($printer)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dec'] . '",';}?>]
                  },
                  {
                    label: "V60",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "#979193",
                    borderColor: "#979193",
                    pointHoverBackgroundColor: "#979193",
                    pointHoverBorderColor: "#979193",
                    data: [<?php while ($p = mysqli_fetch_array($accessories)) { echo '"' . $p['jan'] . '","' . $p['feb'] . '","' . $p['mar'] . '","' . $p['apr'] . '","' . $p['may'] . '","' . $p['jun'] . '","' . $p['jul'] . '","' . $p['aug'] . '","' . $p['sep'] . '","' . $p['oct'] . '","' . $p['nov'] . '","' . $p['dec'] . '",';}?>]
                  }
                  ]
          };

  var myBarChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
            legend: {
              display: true
            },
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                  ticks: {
                      min: 0,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>