<?php 
    $path = dirname(__DIR__);
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/ArtikelController.php');
    $artikel  = new ArtikelController();
    $total    = $artikel->getTotal();
    $page_now     = 1;
    if(isset($_GET['pagination'])){
        $page_now = $_GET['pagination'];
    }

    $total_page = $total / 5;
    $sisa_total_page = $total % 5;
    $histori  = $artikel->getHistoriArtikel();
    if(isset($_GET['kategori'])){
        $id = $_GET['kategori'];
        $artikel = $artikel->getByCategory($id, $page_now);    
    } else if(isset($_GET['key'])){
        $key = $_GET['key'];
        $artikel = $artikel->getAllNotLogin($page_now, $key);  
    } else{
        $artikel = $artikel->getAllNotLogin($page_now);
    }
?>
    <!-- Hero block -->

    <a class="position-relative" name="home"></a>
    <div id="landing-hero" class="clearfix">
        <div class="container-fluid">
        <!-- Header -->
        <h1 id="judul-web" class="font-weight-semibold">
            MASJID DAARUL FIKRI<br/>
            POLITEKNIK HARAPAN BERSAMA
        </h1>
        </div>
    </div>

    <div id="content-wrapper" class="container">
        <div class="row">
            <!-- main -->

            <div class="col-lg-7 col-content">

                <!-- search -->
                <div class="col-sm-12 col-main">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="key-search" placeholder="Search ..." value="<?php echo isset($key) ? $key : ''; ?>">
                    </div>
                    <div class="col-sm-2">
                        <button class="form-control btn btn-success" id="btn-search" type="button" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
                <!-- end search -->
                
                <?php 
                    if(isset($artikel) && $artikel->rowCount() > 0){ 
                        while($row = $artikel->fetch()){
                    ?>
                    <div class="col-sm-12 col-main">

                        <?php if($row['id_kegiatan'] == null) { ?>
                            <img class="thumbnail" src="uploads/artikel/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:100%;"/>
                        <?php } else { ?>
                            <img class="thumbnail" src="uploads/kegiatan/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:100%;"/>
                        <?php } ?>
                        
                        <p class="text-muted">OLEH <?php echo strtoupper($row['nama_user']);?> | <?php echo date('d-m-Y', strtotime($row['created_at']));?> | <?php echo strtoupper($row['nama_kategori']);?></p>
                        <h4 onclick="chooseArtikel('<?php echo $row['id_artikel']?>')" class="judul-artikel"><?php echo $row['judul'];?></h4>
                        <p>
                            <?php 
                                $str = $row['isi'];
                                if (strlen($row['isi']) > 150){
                                    $str = substr($row['isi'], 0, 150) . ' ...';
                                }
                                echo $str;
                            ?>
                        </p>
                    </div>
                <?php } ?>

                    <!-- pagination -->
                    <ul class="pagination">
                        <?php
                            $page = 1;
                            
                            while($page < $total_page){
                                if($page_now == $page){
                                    echo '<li class="active"><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                } else{
                                    echo '<li><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                }
                                $page++;
                            }

                            if($total_page >= 1 && $sisa_total_page >= 1) {
                                if($page_now == $page){
                                    echo '<li class="active"><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                } else{
                                    echo '<li><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                }
                            }
                        ?>
                    </ul>

                <?php } else { ?>
                    <div class="col-sm-12 col-main">
                        <p class="text-center"><i>Data tidak ditemukan</i></p>
                    </div>
                <?php } ?>
            </div>
            <!-- end main -->

            <!-- side right -->
            <div class="col-lg-4 col-content">
                <!-- kegiatan -->
                <?php include('views/template/_kegiatan.php');?>

                <!-- kategori -->
                <?php include('views/template/_kategori.php');?>

                <!-- artikel populer -->
                <div id="artikel-populer" class="col-sm-12 col-side">
                    <h4>ARTIKEL POPULER</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div>
                        <a href="javascript:void(0)" class="link-kategori"><img src="uploads/artikel/masjid.png" alt="thumbnail" style="width:35px;"> &nbsp;contoh1</a><br>
                        
                        <a href="javascript:void(0)" class="link-kategori"><img src="uploads/artikel/maskam1.jpg" alt="thumbnail" style="width:35px;"> &nbsp;Tata Cara Sholat</a><br>                    
                    </div>
                </div>
                <!-- end artikel populer -->

                <!-- galeri -->
                <?php include('views/template/_galeri.php');?>

            </div>
            <!-- end side right -->
        </div>
    </div>

    <!-- Footer -->

    <div class="px-footer bg-primary text-center">
        <span class="text-white">Copyright © 2018 Masjid Daarul Fikri. All rights reserved.</span>
        </div>
    </div>
    <script>
        $(function(){
            $("#menu-home").addClass('active');

            $("#btn-search").click(function(){
                var key = $("#key-search").val();
                window.location = 'index.php?key='+key;
            });
        });

        function chooseArtikel(id){
            window.location.href = 'index.php?page=artikel&id='+id;
        }
    </script>

<?php require_once('footer.php'); ?>