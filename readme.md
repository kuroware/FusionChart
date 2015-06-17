PHP class for FusionChart that can be assigned chart attributes the PHP way instead of manually concantenating
or passing in a long JSON string of your chart attriubtes. The FusionChart object can then easily be printed out with the
correct JSON format for FusionChart with brackets and all the correct delimiters.

The class was tested for line charts mainly and has not been tested for other types of charts (thought I expect them to operate similarily). 

I do not create FusionCharts, you can view it at: http://www.fusioncharts.com/
AngularJS FusionCharts: http://fusioncharts.github.io/angular-fusioncharts/#/demos/ex1

<strong>How to Use</strong>

The FusionChart class accepts an array as the argument for the constructor. The array should contain the following formatted information:

$args = array(
  'chart_attributes' => array(),
  'dataset' => array(),
  'categories' => array()
);

<strong>'chart_attributes'</strong> should be an associative array whose key holds the chart attribute name and value is the attribute value. 
Example: <br/>
  'chart_attributes' => array('caption' => 'First Chart!', 'xasixname' => 'Date');

<strong>'dataset'</strong> should be an associative array that holds the series name as the key and for the value, an array that holds all the data for that series. Currently, the class checks for uniqueness of series (if you set unique_series to true), but this is a bit redundant because array keys must be unique anyways. Will be removed in the future:<p align="center">
Example:<br/>
   'dataset' => array('seriesa' => array( 1, 2, 3, 4, 5), 'seriesb' => (15, 23, 44, 45, 43));</p>

<strong>'categories'</strong> should be an array of all the categories you want. The number of categories should normally be equal to the maximum number of values you want to be graphed (so if your dataset 'seriesb' has 5 values and 5 is the largest dataset, than categories should theoretically be 5)
Example:
  'cateogories' => array('2014-05-03', '2014-05-04', '2014-05-05', '2014-05-06', 2014-05-07');



