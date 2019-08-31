<?php
    include('connection.php');
    $type = (string)$_GET['type'];

    // Lấy tổng số trang trong database
    if ($type === 'count') {
        $items = (int)$_GET['items'];
        $sql = "SELECT COUNT(id) as countId FROM `products` WHERE `status`=1";
        $result         = mysqli_query($link, $sql);
        $totalItem      = mysqli_fetch_assoc($result)["countId"];
        $total          = array('total' => 0);
        $pages          = ceil($totalItem/$items);
        $total['total'] = $pages;

        echo json_encode($total);
    }

    // Lấy ra các phần tử tương ứng với trang hiện tại
    if ($type === 'list') {
        $items       = (int)$_POST['items'];
        $currentPage = (int)$_POST['currentPage'];
        $offset      = ($currentPage - 1) * $items;
        // LIMIT offset, items
        $sql    = "SELECT `id`, `name` FROM `products` WHERE `status` = 1 ORDER BY `id` ASC LIMIT $offset, $items";
        $result = mysqli_query($link, $sql);
        $books = array();
        while($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }

        echo json_encode($books);
    }

    // Lấy ra 1 phần tử đứng sau id cuối cùng
    if ($type === 'one') {
        $lastId       = (int)$_GET['id'];
   
        $sql    = "SELECT `id`, `name` FROM `products` WHERE `status` = 1 AND `id` > $lastId ORDER BY `id` ASC LIMIT 1";
        $result = mysqli_query($link, $sql);
        $books = mysqli_fetch_assoc($result);

        echo json_encode($books);
    }

    // Lấy ra 1 phần tử đứng sau id cuối cùng
    if ($type === 'delete') {
        $id     = (int)$_GET['id'];
        $sql    = "DELETE FROM `products` WHERE `id` = $id";
        $result = mysqli_query($link, $sql);

        $items = (int)$_GET['items'];
        $sql = "SELECT COUNT(id) as countId FROM `products` WHERE `status`=1";
        $result         = mysqli_query($link, $sql);
        $totalItem      = mysqli_fetch_assoc($result)["countId"];
        $total          = array('total' => 0);
        $pages          = ceil($totalItem/$items);
        $total['total'] = $pages;

        echo json_encode($total);
    }