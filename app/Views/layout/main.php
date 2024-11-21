<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/head'); ?>
<!-- Custom style css -->
<?= $this->renderSection('style'); ?>

<body>
    <div class="container-fluid">
        <!-- partial:../../partials/_navbar.html -->
        <?= $this->include('layout/navbar'); ?>
        <!-- partial -->
        <div class="main container">

            <?= $this->renderSection('main-content'); ?>

        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?= $this->include('layout/script'); ?>
    <!-- Page Specific JS File -->
    <?= $this->renderSection('script');  ?>
</body>

</html>