
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
      $(document).on("click",".btncarilaporan",function(){
         var tgl_awal = $("#tgl_awal").val();
         var tgl_akhir = $("#tgl_akhir").val();

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
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir
         };

            $.ajax({
               url: "<?= base_url() ?>laporan/cari",
               type: "POST",
               data : value,
               success: function (data){
                  $("#datatable").html(data);
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
               window.location = "<?= base_url() ?>laporan/delete/"+id;
            } else {
               swal("Cancelled", "Batal :)", "error");
            }
         });
      });



   </script>