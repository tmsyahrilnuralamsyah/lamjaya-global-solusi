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
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#inputPegawaiBaru">Input Pegawai Baru</button>
        
        <div class="modal fade" id="inputPegawaiBaru" tabindex="-1" aria-labelledby="inputPegawai" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputPegawai">Input Pegawai Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route("tambahPegawai") }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
    
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nama" class="form-label">Nama Pegawai</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Pegawai" required/>
                            </div>
                            <div class="col">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jk" name="jk" required>
                                    <option selected>Open this select menu</option>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="tl" class="form-label">Tempat Lahir</label>
                                <input type="text" id="tl" name="tl" class="form-control" placeholder="Tempat Lahir" required/>
                            </div>
                            <div class="col">
                                <label for="tgl_l" class="form-label">Tanggal Lahir</label>
                                <input type="date" id="tgl_l" name="tgl_l" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" id="agama" name="agama" required>
                                    <option selected>Open this select menu</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Budha</option>
                                    <option>Konghucu</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="kel" class="form-label">Kelurahan</label>
                                <select class="form-select" id="kel" name="kel" required>
                                    @foreach ($kelurahan as $k)
                                        <option>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
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
                    <th style="white-space: nowrap;">Nama Pegawai</th>
                    <th style="white-space: nowrap;">Tempat Lahir</th>
                    <th style="white-space: nowrap;">Tanggal Lahir</th>
                    <th style="white-space: nowrap;">Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Provinsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->tl }}</td>
                        <td>{{ $p->tgl_l }}</td>
                        <td>{{ $p->jk }}</td>
                        <td>{{ $p->agama }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->kelurahan }}</td>
                        <td>{{ $p->kecamatan }}</td>
                        <td>{{ $p->provinsi }}</td>
                        <td class="text-center px-4">
                            <a class="btn btn-warning my-1" style="color: white;" onclick="showModal({{ $p }})">Edit</a>
    
                            <form action="{{ route("hapusPegawai", $p->id) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="btn btn-danger my-1 hapusdata">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="modal fade" id="editDataPegawai" tabindex="-1" aria-labelledby="editPegawai" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawai">Edit Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formEditPegawai" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
    
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="e_nama" class="form-label">Nama Pegawai</label>
                                <input type="text" id="e_nama" name="nama" class="form-control" placeholder="Nama Pegawai" required/>
                            </div>
                            <div class="col">
                                <label for="e_jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="e_jk" name="jk" required>
                                    <option selected>Open this select menu</option>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="e_tl" class="form-label">Tempat Lahir</label>
                                <input type="text" id="e_tl" name="tl" class="form-control" placeholder="Tempat Lahir" required/>
                            </div>
                            <div class="col">
                                <label for="e_tgl_l" class="form-label">Tanggal Lahir</label>
                                <input type="date" id="e_tgl_l" name="tgl_l" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="e_agama" class="form-label">Agama</label>
                                <select class="form-select" id="e_agama" name="agama" required>
                                    <option selected>Open this select menu</option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Budha</option>
                                    <option>Konghucu</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="e_alamat" class="form-label">Alamat</label>
                                <input type="text" id="e_alamat" name="alamat" class="form-control" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="e_kel" class="form-label">Kelurahan</label>
                                <select class="form-select" id="e_kel" name="kel" required>
                                    @foreach ($kelurahan as $k)
                                        <option>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
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

        function showModal(pegawai){
            let modal = $('#editDataPegawai').modal('show')
            $('#e_nama', modal).val(pegawai['nama'])
            $('#e_jk', modal).val(pegawai['jk'])
            $('#e_tl', modal).val(pegawai['tl'])
            $('#e_tgl_l', modal).val(pegawai['tgl_l'])
            $('#e_agama', modal).val(pegawai['agama'])
            $('#e_alamat', modal).val(pegawai['alamat'])
            $('#e_kel', modal).val(pegawai['kelurahan'])
            $('#formEditPegawai').attr('action', `/editPegawai/${pegawai.id}`);
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