<?= $this->extend('template\master') ?>

<?= $this->section('page-title') ?> Uang Keluar <?= $this->endSection() ?>
<?= $this->section('subpage-title') ?> Data <?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="<?= site_url(route_to('uangkeluar.print')) ?>" method="post" target="_blank">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" name="start_date" max="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" name="end_date" max="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-print">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success rounded">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif ?>
        <div class="card">
            <div class="position-absolute card-top-buttons">
                <?php if(session()->get('role') == 'Bendahara') : ?>
                <a href="<?= site_url(route_to('uangkeluar.create')) ?>">
                    <button class="btn btn-header-primary">
                        <i class="simple-icon-plus"></i> Tambah Data
                    </button>
                </a>
                <?php endif ?>
                <!-- <button class="btn btn-header-primary btn-modal">
                    <i class="glyph-icon iconsminds-printer"></i> Cetak Data
                </button> -->
            </div>
            <div class="card-body">
                <div class="card-title"><h3>Data Uang Keluar</h3></div>
                <table class="table table-bordered no-footer table-responsive-lg" id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Jumlah Uang</th>
                            <th>Tujuan</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>User</th>
                            <?php if(session()->get('role') == 'Bendahara') : ?>
                            <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $key => $data) : ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td>Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                                <td><?= esc($data['tujuan']) ?></td>
                                <td><?= esc($data['tanggal']) ?></td>
                                <td><?= esc($data['keterangan']) ?></td>
                                <td><?= esc($data['username']) ?></td>
                                <?php if(session()->get('role') == 'Bendahara') : ?>
                                <td>
                                    <a href="<?= site_url(route_to('uangkeluar.edit', $data['id'])) ?>">
                                        <button type="button" class="btn btn-primary btn-sm mb-1">
                                            <i class="glyph-icon simple-icon-pencil"></i> Edit
                                        </button>
                                    </a>
                                    <form action="<?= site_url(route_to('uangkeluar.delete', $data['id'])) ?>" method="post" class="d-inline delete-form">
                                        <?= csrf_field() ?>
                                        <button type="button" class="btn btn-danger btn-sm mb-1 btn-delete">
                                            <i class="glyph-icon simple-icon-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable();

        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        })

        $('body').on('click', '.btn-modal', function() {
            $('#modal').modal('show');
        })

        // $('body').on('click', '.btn-print', function(e) {
        //     let start_date = $('input[name=start_date]').val();
        //     let end_date = $('input[name=end_date]').val();

        //     if(start_date == '' || end_date == '') {
        //         e.preventDefault();
        //         Swal.fire('Gagal', 'Mohon untuk memilih tanggal', 'warning')
        //     } else {
        //         $.ajax({
        //             type: "post",
        //             url: "url",
        //             data: {
        //                 'start_date' : start_date,
        //                 'end_date' : end_date,
        //             },
        //             dataType: "json",
        //             success: function (response) {
                        
        //             }
        //         });
        //     }
        // })
    });
</script>
<?= $this->endSection() ?>