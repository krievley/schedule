<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <!--script src="{{ asset('/js/default.js') }}" type="text/javascript"></script-->
    <!--script src="{{ asset('/js/jquery-2.1.1.js') }}" type="text/javascript"></script-->
    {{------ Generate a link to a JavaScript file -----}}
    {{ HTML::script('js/default.js') }}
    {{ HTML::script('js/jquery-2.1.1.js') }}
    <body>
        <div id="monday"></div>
        <div id="tuesday"></div>
        <div id="wednesday"></div>
        <div id="thursday"></div>
        <div id="friday"></div>
        <div id="saturday"></div>
        <div id="sunday"></div>
    </body>
</html>