<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Soal</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .action-buttons {
            white-space: nowrap;
        }
        .action-buttons a {
            color:#000;
            text-decoration:none;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Daftar Soal</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err) 
                    <li>{{ $err }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <!-- TABEL -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Tahun</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <!-- DATA CONTOH -->
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->matkul }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->tipe }}</td>
                        <td class="action-buttons">

                            
                            <button class="btn btn-sm btn-warning">
                                <a href="{{ route('soal.edit',$item->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </button>

                            <form action="{{ route('soal.destroy',$item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>

                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{ $data->links('pagination::bootstrap-5') }}

    <!-- FORM -->
    <div class="mt-4 p-3 bg-light rounded">
        <h3>{{ isset($soalDetail) ? 'Edit Soal':'Tambah Soal' }}</h3>
    
        <form method="POST" action="{{ isset($soalDetail) ? route('soal.update',$soalDetail->id) :
        route('soal.store') }}">
            @csrf
            @if (isset($soalDetail))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Mata Kuliah</label>
                <input type="text" name="matkul" class="form-control" value="{{ old('matkul',$soalDetail->matkul ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ old('tahun',$soalDetail->tahun ?? '')  }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe</label>
                <input type="text" name="tipe" class="form-control" value="{{ old('tipe',$soalDetail->tipe ?? '')  }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

</body>
</html>