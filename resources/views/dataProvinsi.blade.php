<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lamjaya Global Solusi</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Table CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <div class="container">
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#inputProvinsiBaru">Input Provinsi Baru</button>
        
        <div class="modal fade" id="inputProvinsiBaru" tabindex="-1" aria-labelledby="inputProvinsi" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputProvinsi">Input Provinsi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route("tambahProvinsi") }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="nama" class="form-label">Nama Provinsi</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Provinsi" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    
        <table class="table table-striped table-bordered" id="tablejs">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provinsi as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td class="text-center px-4">
                            <a class="btn btn-warning my-1" style="color: white;" onclick="showModal({{ $p }})">Edit</a>
    
                            <form action="{{ route("hapusProvinsi", $p->id) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="btn btn-danger my-1 hapusdata">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="modal fade" id="editDataProvinsi" tabindex="-1" aria-labelledby="editProvinsi" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProvinsi">Edit Data Provinsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formEditProvinsi" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="e_nama" class="form-label">Nama Provinsi</label>
                                <input type="text" id="e_nama" name="nama" class="form-control" placeholder="Nama Provinsi" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>

    <!-- Table JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#tablejs').DataTable({
                pageLength : 10,
                lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, 'all']],
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (session()->get('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session()->get('success') }}'
            })
        @elseif(session()->get('error'))
        Toast.fire({
                icon: 'error',
                title: '{{ session()->get('error') }}'
            })
        @endif

        function showModal(provinsi){
            let modal = $('#editDataProvinsi').modal('show')
            $('#e_nama', modal).val(provinsi['nama'])
            $('#formEditProvinsi').attr('action', `/editProvinsi/${provinsi.id}`);
        }

        $('.hapusdata').click(function(event){
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: 'Data tidak dapat dikembalikan setelah dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
    </script>
</body>
</html>