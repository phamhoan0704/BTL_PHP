<?php
    include '../../database/connect.php';
    if(isset($_GET['dateEnd'])) {
        $time = strtotime($_GET['dateEnd']);
        $dateEnd = date('Y-m-d',$time);
    }
    if(isset($_GET['dateStart'])) {
        $time = strtotime($_GET['dateStart']);
        $dateStart = date('Y-m-d',$time);
    }

    $sql = "SELECT tbl_product.product_id, tbl_product.product_name, tbl_product.product_price, sum(tbl_order_detail.order_quantity) as 'sale_amount', tbl_product.product_price*sum(tbl_order_detail.order_quantity) as 'total'
            FROM tbl_product INNER JOIN tbl_order_detail on tbl_product.product_id=tbl_order_detail.product_id
                             INNER JOIN tbl_order on tbl_order.order_id=tbl_order_detail.order_id
                             WHERE tbl_order.order_date >= '$dateStart'
                             and tbl_order.order_date <= '$dateEnd' 
            GROUP BY tbl_product.product_id, tbl_product.product_name, tbl_product.product_price 
    ";
    $result = mysqli_query($conn, $sql);
    $product = array();

    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $product[] = $row;
        }
    require "../../lib/PHPExcel-1.8/Classes/PHPExcel.php";

    //Khởi tạo đối tượng
    $excel = new PHPExcel();
    //Chọn trang cần ghi (là số từ 0->n)
    $excel->setActiveSheetIndex(0);

    //Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

    $excel->getActiveSheet()->setCellValue('B1','THỐNG KÊ DOANH THU');
    $excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
    
    //Xét in đậm cho khoảng cột
    $excel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);
    //Tạo tiêu đề cho từng cột
   
    $excel->getActiveSheet()->setCellValue('A3','Mã Sản Phẩm');
    $excel->getActiveSheet()->setCellValue('B3','Tên Sản Phẩm');
    $excel->getActiveSheet()->setCellValue('C3','Giá Bán');
    $excel->getActiveSheet()->setCellValue('D3','Số Lượng');
    $excel->getActiveSheet()->setCellValue('E3','Doanh Thu');

    // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
    // dòng bắt đầu = 2
    $numRow = 4;

    for($i=0;$i<count($product);$i++)
        {
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $product[$i]['product_id']);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $product[$i]['product_name']);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $product[$i]['product_price']);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $product[$i]['sale_amount']);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $product[$i]['total']);
            $numRow++;
        }
    
    $filename = "TKBC_Tu_" . $dateStart ."_Den_" .$dateEnd. ".xlsx";
    // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file

    // PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save("../../TKDT/$filename");
    header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=$filename"); 
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    exit;