<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Information Retrieval</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="http://localhost/utsdiendra/">
        <div class="sidebar-brand-icon">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Welcome Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="hello.php">
          <i class="fas fa-globe-americas"></i>
          <span>Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="katadasar.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Kata Dasar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Upload File PDF</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="query.php">
          <i class="fas fa-fw fa-search"></i>
          <span>Pencarian Kata</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="hasil_tokenisasi.php">
          <i class="fas fa-table"></i>
          <span>Tabel Tokenisasi</span></a>
      </li>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">





            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small font-weight-bold">Kukuh Tri Nur Iman</span>
              </a>

            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-center">
              <tr>
                <th class="font-weight-bold">Nama File</th>
                <th class="font-weight-bold">Tokenisasi</th>
                <th class="font-weight-bold">TokenStem</th>
              </tr>
            </thead>

            <?php



            ///
            ?>

            <?php

            //https://dev.mysql.com/doc/refman/5.5/en/fulltext-boolean.html
            //ALTER TABLE dokumen
            //ADD FULLTEXT INDEX `FullText` 
            //(`token` ASC, 
            //`tokenstem` ASC);

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "utsinre";
            $katakunci = "";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            $hasil = $_POST['katakunci'];
            //$sql = "SELECT distinct nama_file,token,tokenstem FROM `dokumen` where token like '%$hasil%'";
            $sql = "SELECT distinct nama_file,token,tokenstem FROM `dokumen` WHERE MATCH (token,tokenstem) AGAINST ('$hasil' IN BOOLEAN MODE)";
            echo $sql . "<br>";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<tbody>
                                  <tr>
                                    <td> ' . $row['nama_file'] . '</td>
                                    <td> ' . $row['token'] . '</td>
                                    <td> ' . $row['tokenstem'] . '</td>
                                  </tr>
                                </tbody';
              }
            } else {
              echo "Hasil dengan kata " . $hasil . "tidak ditemukan";
            }
            $conn->close();
            ?>
          </table>





        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <h1>Hasil Pencarian Kata Kunci</h1>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>