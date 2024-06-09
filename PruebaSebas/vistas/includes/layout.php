<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head_tags.php'); ?>
</head>

<body>
    <?php include('encabezado.php'); ?>

    <main class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-left">
           

            <div class="col main pt-5 mt-3">
                <?= $content ?>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>

</html>