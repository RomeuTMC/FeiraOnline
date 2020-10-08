<?php if (!isset($TRUE) or ($TRUE<>'index.php')) die('LOCKED');
logado('SELLER');
$dados=$_SESSION['dados'];
include_once('topo.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="google-signin-client_id" content="688324217619-69b7jufg2fr6ke0ialc9k0412ct7krlh.apps.googleusercontent.com">
  <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
</head>
<body>
<!-- The Sign-in button. This will run `queryReports()` on success. -->
<p class="g-signin2" data-onsuccess="queryReports"></p>
<!-- The API response will be printed here. 
<textarea cols="80" rows="20" id="query-output"></textarea>-->
<div  style="position: absolute; left: 30%;">
<div id='over'>
<?php 
foreach($dados as $k=>$v){
  echo $k.': '.$v.'<br>';
}
?>
</div>
<div id='google'></div>
</div>
<script>
  // Replace with your view ID.
  var VIEW_ID = '227437552';

  // Query the API and print the results to the page.
  function queryReports() {
    gapi.client.request({
      path: '/v4/reports:batchGet',
      root: 'https://analyticsreporting.googleapis.com/',
      method: 'POST',
      body: {
        reportRequests: [
          {
            viewId: VIEW_ID,
            dateRanges: [
              {
                startDate: '7daysAgo',
                endDate: 'today'
              }
            ],
            "dimensions":[
              {"name": "ga:day"}
            ],
            metrics: [
              {"expression": "ga:users"},
              {"expression": "ga:pageviews"},
              {"expression": "ga:timeOnPage"},
              {"expression": "ga:avgTimeOnPage"}
            ]
          }
        ]
      }
    }).then(displayResults, console.error.bind(console));
  }

  function displayResults(response) {
    //var r = JSON.stringify(response.result, null, 1);
    //document.getElementById('query-output').value = r;
    rd=response.result.reports[0].data.totals[0].values;
    rOut='<p class="rel-out">';
    rOut=rOut+'Visitors:'+rd[0]+'<br>';
    rOut=rOut+'Pages Viewed:'+rd[1]+'<br>';
    var date = new Date(0);
    date.setSeconds(rd[2]); // specify value for SECONDS here
    var timeString = date.toISOString().substr(11, 8);
    rOut=rOut+'Time On Site (visitor):'+timeString+'<br>';
    var date = new Date(0);
    date.setSeconds(rd[3]); // specify value for SECONDS here
    var timeString = date.toISOString().substr(11, 8);
    rOut=rOut+'Time On Page:'+timeString+'<br>';
    rOut=rOut+'</p>'
    $('#google').html(rOut);
    console.log(rOut);
    console.log(response);
  }
</script>

<!-- Load the JavaScript API client and Sign-in library. -->
<script src="https://apis.google.com/js/client:platform.js"></script>

</body>
</html>