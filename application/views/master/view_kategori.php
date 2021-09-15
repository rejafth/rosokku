<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="" class="text-dark">
                                <i class="fa fa-fw fa-home"></i>
                                Main
                            </a>
                        </li>
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active">View Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header text-right">
                            <a href="<?= base_url('master/edit_kategori/' . $this->uri->segment(3)) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit mr-1"></i>Edit</a>
                            <a href="<?= base_url('master/delete_kategori/' . $this->uri->segment(3)) ?>" class="delete btn btn-sm btn-outline-danger"><i class="fa fa-trash mr-1"></i>Delete</a>
                        </div>
                        <div class="card-body">
                            <table class="table border">
                                <tr>
                                    <td class="font-weight-bold">Nama kategori</td>
                                    <td>:</td>
                                    <td><?= $kategori['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Harga satuan</td>
                                    <td>:</td>
                                    <td><?= number_format($kategori['harga']) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#master-drop').addClass('menu-open');
    $('#master').addClass('active');
    $('#master-kategori').addClass('active');
</script>