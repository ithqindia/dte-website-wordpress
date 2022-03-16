<?php $title="Store"; include 'inc-header.php' ?>
<body class="hold-transition skin-black sidebar-mini layout-top-nav">
<div class="wrapper">
  <?php include_once 'inc-nav.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Stores </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Which store do you want to check in?</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="col-md-6" action="store-action.php" method="POST">
                  <div class="form-group">
                      <label for="js-states">Select Store to check in</label>
                      <select class="form-control select2-container step2-select" id="storeList" name="store" data-width="100%" >
                        <option value="0" disabled selected="selected"> - Please select - </option>
                      </select>
                      <p>&nbsp;</p>
                      <button type="submit" class="btn btn-primary btn-lg">Check in <i class="fa fa-share"></i> </button>
                      <?php if($session->id < 6): ?>
                        <a href="store-add.php" class="btn btn-info btn-lg ">Add new Store <i class="fa fa-star"></i> </a>
                      <?php endif; ?>
                  </div>
              </form>
            </div>
            <div class="box-footer">
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'inc-footer.php' ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="assets/plugins/toastr/toastr.min.js"></script>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/fastclick/fastclick.min.js"></script>
<script src="assets/plugins/validator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$(function($) {
  $.ajax({
      url: 'api/v4/store/stores-get.php',
      method: 'GET',
      dataType: 'json'
    })
    .done(function(res) {
      $.each(res, function (key, data) {
        $('#storeList').append( $('<option></option>').val(data.stid).html(data.storeName));
      });
    })
    .fail(function(xhr, textStatus, errorThrown) {
      logFailure([xhr.responseText, window.location.href, $("form").serializeArray()]);
    });

    $("#storeList").select2({ allowClear: false });
});
$("form").submit(function(event) {
  if($("#storeList").val() === null) {
    event.preventDefault();
    toastr.error("Please select a store from the list", "Error");
  }
});
</script>
</body>
</html>
