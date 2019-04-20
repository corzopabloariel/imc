<!DOCTYPE html>
<html lang="es-ES">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{!! $trabajo["nombre"] !!}</h2>
        <p><strong>Rango de edad:</strong> {!! $trabajo["rango"] !!}</p>
        <p><strong>Años de experiencia:</strong> {!! $trabajo["experiencia"] !!}</p>
        <p><strong>Orientación:</strong> {!! $trabajo["orientacion"] !!}</p>
        <hr/>
        <p><strong>Provincia:</strong> {!! $provincia !!}</p>
        <hr/>
        <h3>Datos personales:</h3>
        <p><strong>Nombre completo:</strong> {!! $data["nombre"] !!} {!! $data["apellido"] !!}</p>
        <p><strong>Email:</strong> <a href="mailto:{!! $data['email'] !!}">{!! $data["email"] !!}</a></p>
        @if(!empty($data["formacion"]))
        <p><strong>Formación:</strong> {!! $data["formacion"] !!}</p>
        @endif
    </body>
</html>