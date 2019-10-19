<?php 
include 'DBController.php';
$db_handle = new DBController();
$productResult = $db_handle->runQuery("select * from search");

if (isset($_POST["export"])) {
    $fileName = "Export_excel.xls";
    // header("Content-Type: application/vnd.ms-excel");
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    $isPrintHeader = false;
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
?>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = $db_handle->runQuery("select * from search");
                if (! empty($productResult)) {
                    foreach ($productResult as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $productResult[$key]["id"] ?></td>
                            <td><?php echo $productResult[$key]["name"] ?></td>
                            <td><?php echo $productResult[$key]["description"] ?></td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
        <div>
            <form action="" method="post">
                <button type="submit" name="export" value="Export To Excell">
                    Export To Excell
                </button>
            </form>
        </div>
</div>