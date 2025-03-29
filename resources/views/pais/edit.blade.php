<!doctype html> 
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Editar País</title>
  </head>
  <body>
    <div class="container mt-4">
        <h1>Editar País</h1>    
        <form method="POST" action="{{ route('paises.update', ['pais' => $pais->pais_codi]) }}">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="pais_codi" class="form-label">Código</label>
                <input type="text" class="form-control" id="pais_codi" name="pais_codi"
                    value="{{ $pais->pais_codi }}" disabled>
            </div>
            <div class="mb-3">
                <label for="pais_nomb" class="form-label">Nombre del País</label>
                <input type="text" required class="form-control" id="pais_nomb" name="pais_nomb"
                    value="{{ $pais->pais_nomb }}">
            </div>
            <div class="mb-3">
                <label for="pais_capi" class="form-label">Capital</label>
                <input type="text" required class="form-control" id="pais_capi" name="pais_capi"
                    value="{{ $pais->pais_capi }}">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('paises.index') }}" class="btn btn-warning">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
