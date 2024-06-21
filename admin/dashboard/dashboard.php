<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDirectory = "C:\\laragon\\www\\rstation\admin\uploads\\"; 

    $img1Name = "img1.png";
    $img2Name = "img2.png";
    $img3Name = "img3.png";

    $img1Path = $uploadDirectory . $img1Name;
    $img2Path = $uploadDirectory . $img2Name;
    $img3Path = $uploadDirectory . $img3Name;


    function uploadAndRename($inputName, $targetPath)
    {
        if (isset($_FILES[$inputName]["name"])) {
            $targetFile = $targetPath;
            move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile);
        }
    }

    uploadAndRename("formFile1", $img1Path);
    uploadAndRename("formFile2", $img2Path);
    uploadAndRename("formFile3", $img3Path);
    $msg = "Imagens carregafas com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <title>Rock Station </title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.html"><b>
                        <!--This is dark logo icon-->   <!--This is light logo icon--><img src="C:\laragon\www\rstation\assets\img\profile-img.png" alt="home" class="light-logo" />
                     </b>
                    
                     </span> </a>
                </div>
                <!-- /Logo -->

            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="index.html" class="waves-effect"><i class="fa fa-picture-o" aria-hidden="true"></i> Envio de Imagens</a>
                    </li>
                </ul>
                <div class="center p-20">
                     <a href="logout.php" target="_blank" class="btn btn-danger btn-block waves-effect waves-light"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                 </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Envio de Imagens</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Envio de Imagens</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                <form method="post" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Envio de Imagens - Slider</h3>
            <div class="mb-3">
                <label for="formFile1" class="form-label">1º Imagem</label>
                <input class="form-control" type="file" id="formFile1" name="formFile1" >
            </div>
            <div class="mb-3">
                <label for="formFile2" class="form-label">2º Imagem</label>
                <input class="form-control" type="file" id="formFile2" name="formFile2" >
            </div>
            <div class="mb-3">
                <label for="formFile3" class="form-label">3º Imagem</label>
                <input class="form-control" type="file" id="formFile3" name="formFile3" >
            </div><br>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <?php if(isset($msg)) echo $msg; ?>
        </div>
        <hr>
    </div>
</form>
<div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Template de Imagem</h3>
            <a href="./admin/assets/template/template.png" download="template.png">
                <button type="button" class="btn btn-primary">Download Imagem</button>
            </a>
        </div>
        <hr>
    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?php echo date("Y");?> - Rock Station Music </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
</body>

</html>
