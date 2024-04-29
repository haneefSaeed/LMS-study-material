<?php
require_once("includes/classes.php");
$page = new AllPagesOperation();
$page->head("Home | QuizTime");
?>

<body class="normalmbody">

<div class="container">
    <div class="container-fluid">
        <?php
        //Menu Items
        $page->localMenus();
        ?>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="tblue">Digital Marketing </h1><br>
                <p>Nulla facilisis gravida lorem sed sollicitudin. Nullam varius turpis ante, eu sodales lorem sollicitudin vehicula. Donec quis nunc ut tellus pretium volutpat. Duis vitae nibh facilisis, feugiat elit id, consectetur ex. Phasellus lobortis tortor eu venenatis scelerisque. Morbi vestibulum eros ligula, sit amet finibus lectus ultricies bibendum. Vestibulum sed elit vitae nunc pretium mattis.
                </p><br>
                <div class="panel pan-5">
                    <h4><a class="twhite" href="chapters.php?ch=1">Chapter 1</a> </h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 2</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 3</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 4</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 5</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 6</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 7</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 8</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 9</h4>
                </div>
                <div class="panel pan-5">
                    <h4>Chapter 10</h4>
                </div>

            </div>
        </div>
    </div>
</div>

<!--end of row -->

<!-- Javascript -->

</body>
</html>
<?php
$page->footer();
?>