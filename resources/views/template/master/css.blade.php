<!-- Stylesheets -->
@if( preference('assets', 'hosted') == 'hosted')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
@else
<link rel="stylesheet" href="/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/fontawesome-all.min.css">
@endif

<link rel="stylesheet" href="/css/custom.css?{{ rand(0, 10000000) }}">
