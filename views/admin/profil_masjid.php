<?php
    session_start();  
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
    } else{
      require_once('../../controller/AuthController.php');
      $auth = new AuthController();
      $user_login = $auth->getUserLogin();
    }

    require_once('../template/header.php');
    require_once('../template/navbar.php');
    require_once('../../controller/InfoUmumController.php');
    $info = new InfoUmumController();
    $data = $info->getAll();
?>

<!-- Content -->
<div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="javascript:void(0)">Setting</a></li>
        <li class="active">Profil Masjid</li>
    </ol>

    <div class="page-header">
      <h1><i class="px-nav-icon ion-gear-b"></i><span class="px-nav-label"></span>Setting</h1>
    </div>
        <div class="row">
            <!-- Form data masjid -->
            <div class="col-sm-12" id="div-form-edit">
                <div class="panel">
                    <div id="judul_form" class="panel-title">Informasi Masjid</div>
                    <small id="sub_judul_form" class="panel-subtitle text-muted">Informasi Umum Masjid</small>
                    <div class="panel-body">

                        <div id="div_form_info" class="form-horizontal">

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <img src="../../uploads/profil/masjid.jpg" alt="Masjid" style="width:320px; height: 240px; display:block; margin:auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Nama Masjid</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="nama_masjid" name="nama_masjid" value="Masjid Daarul Fikri" placeholder="Masukan Nama Masjid..." class="form-control" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Ketua Takmir</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="ketua_takmir" name="ketua_takmir" value="Ginanjar Wiro Sasmito, M.Kom" placeholder="Masukan nama ketua takmir ..." class="form-control" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Tanggal Berdiri</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="tanggal_berdiri" value="05-05-2009" placeholder="dd-mm-yyyy" class="form-control" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Tanah</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_tanah" name="luas_tanah" value="200 meter" placeholder="Masukan luas tanah ..." class="form-control" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Bangunan</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_bangunan" name="luas_bangunan" value="150 meter" placeholder="Masukan luas bangunan ..." class="form-control" required="" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Keterangan</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" required="" readonly="">lorem ipsum dolor sit amet lorem ipsum dolor sit amet</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="button" id="btn-edit" class="btn btn-primary" name="submit-update"><i class="fa fa-edit"></i> Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End form data masjid -->

        </div>
    </div>
    <br /><br />
</div>

<script>
    $(function(){
        $("#menu-setting").addClass("active");
        $("#sub-profil-masjid").addClass("active");
    });

    $(function() {
        $('#tanggal_berdiri').datepicker();
    });

    $(function(){
        $("#btn-edit").click(function(){
            $("#judul_form").text("Edit Informasi Umum");
            $("#sub_judul_form").text("Edit Data Informasi Umum Masjid");
            $("#div_form_info").hide();
            $("#form_info").show();
        });
    });

    
</script>

<?php 
    require_once('../template/footer.php');
?>