<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
    <?php
        require '../Faker_src/autoload.php';
        $faker = Faker\Factory::create("ru_RU");
        $faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Goods($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Ggroup($faker));

        require_once 'connection.php';
        mysqli_query($link, "set names utf8");
	
        function addCity() {
            echo "работает, addCity функция выполняется";
            global $faker;
            global $link;
            $InputNumCity = $_POST['InputNumCity'];
            for ($i=0; $i < $InputNumCity; $i++) {
                $query1 ="INSERT INTO city (city_name) VALUES ('$faker->city')";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }
    
        function addContractor() {
            echo "работает, addContractor функция выполняется";
            global $faker;
            global $link;
            $InputNumContractor = $_POST['InputNumContractor'];
            $rows_city = mysqli_query($link,"SELECT * FROM city") or trigger_error(mysqli_error($link));
            $num_rows_city = mysqli_num_rows($rows_city);
            for ($i=0; $i < $InputNumContractor; $i++) {
                $contractor_cityid=$faker->numberBetween(1,$num_rows_city);
                $query1 ="INSERT INTO contractor (contr_name, contr_address, contr_contact, contr_type, city_id) 
                            VALUES ('$faker->name', '$faker->address', '$faker->PhoneNumber', '$faker->boolean', $contractor_cityid )";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }
    
        function addGoodsgroup() {
            echo "работает, addGoodsgroup функция выполняется";
            global $faker;
            global $link;
            $InputNumGoodgroup = $_POST['InputNumGoodgroup'];
            for ($i=0; $i < $InputNumGoodgroup; $i++) {
                $txtrus=$faker->realText(50);
                $query1 ="INSERT INTO goods_group (gg_name, gg_desc) 
                            VALUES ('$faker->ggname', '$txtrus')";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }
    
        function addGoods() {
            echo "работает, addGoods функция выполняется";
            global $faker;
            global $link;
            $InputNumGoods = $_POST['InputNumGoods'];
            $rows_gg = mysqli_query($link,"SELECT * FROM goods_group") or trigger_error(mysqli_error($link));
            $num_rows_gg = mysqli_num_rows($rows_gg);
						$instock_good = $faker->numberBetween(1,7000, "sqrt"); 
            for ($i=0; $i < $InputNumGoods; $i++) {
                $goods_ggid=$faker->numberBetween(1,$num_rows_gg);
								$instock_good = $faker->numberBetween(1,7000, "sqrt");
                $query1 ="INSERT INTO goods (goods_name, goods_cost, goods_instock, gg_id) 
                            VALUES ('$faker->good', $instock_good, '$faker->randomDigit', $goods_ggid)";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }
    
        function addInvoice() {
            echo "работает, addInvoice функция выполняется";
            global $faker;
            global $link;
            $InputNumInvoice = $_POST['InputNumInvoice'];
            $rows_contractor = mysqli_query($link,"SELECT * FROM contractor") or trigger_error(mysqli_error($link));
            $num_rows_contractor = mysqli_num_rows($rows_contractor);
            for ($i=0; $i < $InputNumInvoice; $i++) {
                $invoice_contrid = $faker->numberBetween(1,$num_rows_contractor);
                $query1 ="INSERT INTO invoice (inv_type, inv_date, inv_totalprice, contr_id) 
                            VALUES ('$faker->boolean', '$faker->date', '$faker->randomFloat', $invoice_contrid)";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }
    
        function addInvoicedetail() {
            echo "работает, addInvoicedetail функция выполняется";
            global $faker;
            global $link;
            $InputNumInvoicedetail = $_POST['InputNumInvoicedetail'];
            $rows_goods = mysqli_query($link,"SELECT * FROM goods") or trigger_error(mysqli_error($link));
            $num_rows_goods = mysqli_num_rows($rows_goods);
            $rows_invoice = mysqli_query($link,"SELECT * FROM invoice") or trigger_error(mysqli_error($link));
            $num_rows_invoice = mysqli_num_rows($rows_invoice);
            for ($i=0; $i < $InputNumInvoicedetail; $i++) {
                $rand_quantity_invoicedetail = $faker->numberBetween(1,50);
                $invoicedetail_goodid = $faker->numberBetween(1,$num_rows_goods);
                $invoicedetail_invoiceid = $faker->numberBetween(1,$num_rows_invoice);
                $query1 ="INSERT INTO invoice_detail (quantity, good_id, invoice_id) 
                            VALUES ($rand_quantity_invoicedetail, $invoicedetail_goodid, $invoicedetail_invoiceid)";
                $result1= mysqli_query($link, $query1) or trigger_error(mysqli_error($link));
            }
        }

        if (isset($_POST['submitCity'])) {
            addCity();
        }
    
        if (isset($_POST['submitContractor'])) {
            addContractor();
        }
    
        if (isset($_POST['submitGoodsgroup'])) {
            addGoodsgroup();
        }
    
        if (isset($_POST['submitGoods'])) {
            addGoods();
        }
    
        if (isset($_POST['submitInvoice'])) {
            addInvoice();
        }
    
        if (isset($_POST['submitInvoicedetail'])) {
            addInvoicedetail();
        }
    
        if(isset($_POST['submitDB'])) {
            if(isset($_POST['CheckboxCity'])) {
                echo "CheckboxCity";
                addCity();
            }
            
            if(isset($_POST['CheckboxContractor'])) {
                echo "CheckboxContractor";
                addContractor();
            }
            
            if(isset($_POST['CheckboxGoodsgroup'])) {
                echo "CheckboxGoodsgroup";
                addGoodsgroup();
            }
            
            if(isset($_POST['CheckboxGoods'])) {
                echo "CheckboxGoods";
                addGoods();
            }
            
            if(isset($_POST['CheckboxInvoice'])) {
                echo "CheckboxInvoice";
                addInvoice();
            }
            
            if(isset($_POST['CheckboxInvoicedetail'])) {
                echo "CheckboxInvoicedetail";
                addInvoicedetail();
            }
        }
    
        echo "<pre>";
        print_r ($_POST);
        echo "</pre>";
    ?>

</body>
</html>