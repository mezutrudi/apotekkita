
   <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>public/gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
      $(document).on("click",".btnproseslaporan",function(){
         var id_jenis = $("#id_jenis").val();
         var tgl_awal = $("#tgl_awal").val();
         var tgl_akhir = $("#tgl_akhir").val();

         if(id_jenis == '' || id_jenis == null ){
            swal("Peringatan", "Jenis obat harus dipilih", "error");
            $("id_jenis").focus();
            return;
         };

         if(tgl_awal == '' || tgl_awal == null ){
            swal("Peringatan", "Tanggal dari harus diisi", "error");
            $("tgl_awal").focus();
            return;
         };

         if(tgl_akhir == '' || tgl_akhir == null ){
            swal("Peringatan", "Tanggal sampai dengan harus diisi", "error");
            $("tgl_akhir").focus();
            return;
         };

         var value = {
            id_jenis: id_jenis,
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir
         };

         $.ajax({
            url: "<?= base_url() ?>expired/laporan",
            type: "POST",
            data : value,
            success: function (data){
               $("#get_dataexpired").html(data);
            }
         });

      });

      $(document).on("click",".btnedit",function(){
         var id =$(this).attr("data-id");
         var value = {
            id: id
         };

         $.ajax({
         url : "<?= base_url()?>api/obat",
         type: "GET",
         data : value,
            success: function(result, textStatus, jqXHR)
            {
               let obat = result.data[0];
               $("#modal_edit").modal('show');
               $("#e_id_obat").val(obat.id_obat);
               $("#e_id_jenis").val(obat.id_jenis);
               $("#e_nama_obat").val(obat.nama_obat);
               $("#e_harga_obat").val(obat.harga_obat);
               $("#e_stok_obat").val(obat.stok_obat);
               $("#e_tanggal_expired").val(obat.tanggal_expired);
            }
         });
      });

      $(document).on("click",".btnhapus",function(){
         var id =$(this).attr("data-id");
         swal({
            title: "Peringatan!",
            text: "Apakah anda ingin menghapus data ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
            .then((willDelete) => {
            if (willDelete) {
               window.location = "<?= base_url() ?>obat/delete/"+id;
            } else {
               swal("Cancelled", "Batal :)", "error");
            }
         });
      });

   </script>