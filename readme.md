PHP class for FusionCharts that can:
<ul>
  <li> Be assigned FusionChart attributes the PHP way</li>
  <li> No need to manage or manually concanetenate a JSON string for creating a graph</li>
  <li> Can echo'd out into the correct FusionChart JSON string</li>
  <li> Can be used for parsing by a Javascript file after being printed or used to PHP display</li>
</ul>

The class was tested for line charts mainly and has not been tested for other types of charts (thought I expect them to operate similarily).

I did not create FusionCharts, you can view it at: http://www.fusioncharts.com/
AngularJS FusionCharts: http://fusioncharts.github.io/angular-fusioncharts/#/demos/ex1

<h2>How to Use</h2>

<strong>First require the file</strong> `FusionChart.php`: <br/>
require_once('FusionChart.php');<br/>
This will give the current PHP script access to the class

<strong>Create the FusionChart object:</strong>
<br/>
$x = new FusionChart($args);
<br/>Follow the argument criteria to create the object correctly

<strong>Argument Criteria</strong>
<br/>
The FusionChart class accepts an array as the argument for the `constructor`. The array should contain the following formatted information:
<p align="center">
```php
$args = array(
  'chart_attributes' => array(),
  'dataset' => array(),
  'categories' => array()
);
```
</p>
<strong>'chart_attributes'</strong> should be an associative array whose key holds the chart attribute name and value is the attribute value. 
<p align="center">
Example: <br/>
  'chart_attributes' => array('caption' => 'First Chart!', 'xasixname' => 'Date');
  </p>

<strong>'dataset'</strong> should be an associative array that holds the series name as the key and for the value, an array that holds all the data for that series. Currently, the class checks for uniqueness of series (if you set unique_series to true), but this is a bit redundant because array keys must be unique anyways. Will be removed in the future:<p align="center">
Example:<br/>
   'dataset' => array(<br/>'seriesa' => array( 1, 2, 3, 4, 5), <br/>'seriesb' => (15, 23, 44, 45, 43));</p>

<strong>'categories'</strong> should be an array of all the categories you want. The number of categories should normally be equal to the maximum number of values you want to be graphed (so if your dataset 'seriesb' has 5 values and 5 is the largest dataset, than categories should theoretically be 5)
<p align="center">
Example:
  'cateogories' => array('2014-05-03', '2014-05-04', '2014-05-05', '2014-05-06', 2014-05-07');
  </p>



