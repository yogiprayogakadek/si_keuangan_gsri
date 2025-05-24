<script src="<?= base_url() ?>assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/js/vendor/mousetrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/dore.script.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
<!-- <script src="<?= base_url() ?>assets/js/vendor/datatables.min.js"></script> -->
<script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function () {
        $('body').on('click', '.print-menu', function() {
            $('#printModal').modal('show');
        });

        const $form = $('#formPrint');
        const baseUrlMasuk = "<?= site_url(route_to('uangmasuk.print')) ?>";
        const baseUrlKeluar = "<?= site_url(route_to('uangkeluar.print')) ?>";

        $('body').on('change', '#kategori', function () {
            const kategori = $(this).val();
            
            if (kategori === 'keluar') {
                $form.attr('action', baseUrlKeluar);
            } else if (kategori == 'masuk') {
                $form.attr('action', baseUrlMasuk);
            } else {
                $form.attr('action', '');
            }
        });
    });
</script>

<?= $this->renderSection('script') ?>