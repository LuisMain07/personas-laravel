<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Listado de países</title>
  </head>

  <body>
    <div class="container mt-4">
        <h1>Listado de países</h1>
        <a href="{{ route('paises.create') }}" class="btn btn-success mb-3">Agregar País</a>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Código</th>
              <th scope="col">País</th>
              <th scope="col">Capital</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($paises as $pais_)
            <tr>
              <td>{{ $pais_->pais_codi }}</td>
              <td>{{ $pais_->pais_nomb }}</td>
              <td>{{ $pais_->pais_capi }}</td>
              <td>
                <a href="{{ route('paises.edit', ['pais' => $pais_->pais_codi]) }}" class="btn btn-info">Editar</a>

                <form action="{{ route('paises.destroy', ['pais' => $pais_->pais_codi]) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este país?')">Eliminar</button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
