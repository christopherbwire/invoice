//Table medicStock has two rows, medicID and medicType


<?php
require_once "../config.php";


session_start();

//If not logged in, direct to the login page
if(isset($_SESSION['loggedin'])==false)
{
    // not logged in
    header('Location: ../index.php');
    exit();
}

try
{
    $sqlSelectq = "SELECT DISTINCT medicType FROM medicStock ORDER BY medicType ASC";
    $projresultq = $conn->query($sqlSelectq);
    $projresultq->setFetchMode(PDO::FETCH_ASSOC);
    $data = array();

    // while ( $rowSelectq = $projresultq->fetch() ) 
    //     {
    //         $medicType = $rowSelectq['medicType'];
    //         $data[] = array("medicType" => $medicType); 
    //     }
    //     $json = json_encode($data);
    //     echo $json;

    while ( $rowSelectq = $projresultq->fetch() ) 
        {
            $data[] = $rowSelectq; 
        }
        $json = json_encode($data);
        echo $json;
}catch (PDOException $e)
{   
    die("Some problem getting data from database !!!" . $e->getMessage());
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../node_modules/styles/sedebar.css" >
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../node_modules/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="../node_modules/jquery/dist/jquery.slim.min.js" ></script>
    <script src="../node_modules/popper/popper.min.js" ></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script src="../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js" ></script>
    <script src="../node_modules/bootstrap-select/dist/js/i18n/defaults-*.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="1024px, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Christopher Bire, Karata Technologies">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Al-BHS | INVOICE</title>

    <style>
    .table1{
        right: 0px;
        width: 100%;
    }
    .table1 td{
        background: #DBE9FC;
        font-size: 12px;
    }
    .table1 th{
        background: #E7F9FF;
    }
    .table{
        font-size: 13px;
    }
    .pull-right{
        position: absolute;
        right: 0px;
        margin-right: 100px;
    }
    .tab-pane{
        background-color: #FFFEF1;
    }
    .calculation{
        position: relative;
        right: 0px;
    }







    html {
            background-color1: #f0f3f4;
            position: relative;
            min-height: 100%;
        }
        body {
            background-color: transparent;
            color: #58666e;
            font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857;
            
        }
        .main {
        padding: 20px;
        }
        @media (min-width: 768px) {
        .main {
            padding-right: 40px;
            padding-left: 40px;
        }
        }
        .line {
            font-size: 0;
            height: 2px;
            margin: 10px 0;
            overflow: hidden;
            width: 100%;
            background-color: #2e3344;
        }
        .btn i{
            padding-left:5px;
            padding-right:10px;
        }
        .account-menu .fa, .dropdown-menu li a .fa{
            padding-left:5px;
            padding-right:10px;
            font-size:13px;
        }
        .logout .fa{
            color:#fff !important;	
        }
        .logout .fa:hover, .logout .fa:active, .logout .fa:focus{
            color:#111 !important;
        }
        input[type=number]{ -moz-appearance: textfield; }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        .form-inline .form-group{
            margin-bottom: 20px;
            float: right;
        }
        .dropdown-menu{
            z-index: 9999 !important;
        }
        .message_success{background-color: #78b310; color:#fff;padding: 5px;}
        .message_error{background-color: #e74c3c; color:#fff;padding: 5px;}
        .modal-body{
            position: relative;
            overflow-y: auto;
            max-height: 100%;
        }
        @media print {
            #print_content {
                background-color: white;
                height: 100%;
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
                margin-left: 20px;
                margin-right: 20px;
                padding: 15px;
                font-size: 14px;
                line-height: 18px;
                font-family: "Source Sans Pro","Helvetica Neue",Helvetica,Arial,sans-serif;
            }
        }
        .success-icon{
            font-size:5em;
        }
        .invoice-save-btm{
            height:60px;padding:20px;font-size:20px;
        }

        .bottom-ads{
            padding-left:0%;
        }
        @media (min-width: 768px) {
            .bottom-ads{
                padding-left:9%;
            }
        }
        .demo-heading {
            width: 600px;
            margin: 1% auto;
            padding: 20px;
        }
    </style>
    

    <script>
         $(document).ready(function(){
            $(document).on('click', '#checkAll', function() {          	
                $(".itemRow").prop("checked", this.checked);
            });	
            $(document).on('click', '.itemRow', function() {  	
                if ($('.itemRow:checked').length == $('.itemRow').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
            });  



            var myVar = <?php echo $json; ?>;
            window.alert(myVar);




            //Adding another row after button click
            
            var count = $(".itemRow").length;
            $(document).on('click', '#addRows', function() { 
                count++;
                var htmlRows = '';
                htmlRows += '<tr>';
                htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
                htmlRows += '<td><select class="form-control" id="productCode_'+count+'" name="productCode[]" autocomplete="off" required><option value="">aaaaaaaa</option></select></td>';          
                htmlRows += '<td><select class="form-control" id="productName_'+count+'" name="productName[]" autocomplete="off" required><option value="">bbbbbbbb</option></select></td>';
                htmlRows += '<td><select class="form-control" id="productName_'+count+'" name="productName[]" autocomplete="off" required><option value="">bbbbbbbb</option></select></td>';
                htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
                htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
                htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
                htmlRows += '</tr>';
                $('#invoiceItem').append(htmlRows);
            }); 
            $(document).on('click', '#removeRows', function(){
                $(".itemRow:checked").each(function() {
                    $(this).closest('tr').remove();
                });
                $('#checkAll').prop('checked', false);
                calculateTotal();
            });		
            $(document).on('blur', "[id^=quantity_]", function(){
                calculateTotal();
            });	
            $(document).on('blur', "[id^=price_]", function(){
                calculateTotal();
            });	
            $(document).on('blur', "#taxRate", function(){		
                calculateTotal();
            });	
            $(document).on('blur', "#amountPaid", function(){
                var amountPaid = $(this).val();
                var totalAftertax = $('#totalAftertax').val();	
                if(amountPaid && totalAftertax) {
                    totalAftertax = totalAftertax-amountPaid;			
                    $('#amountDue').val(totalAftertax);
                } else {
                    $('#amountDue').val(totalAftertax);
                }	
            });	
            $(document).on('click', '.deleteInvoice', function(){
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to remove this?")){
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        dataType: "json",
                        data:{id:id, action:'delete_invoice'},				
                        success:function(response) {
                            if(response.status == 1) {
                                $('#'+id).closest("tr").remove();
                            }
                        }
                    });
                } else {
                    return false;
                }
            });
        });	
        function calculateTotal(){
            var totalAmount = 0; 
            $("[id^='price_']").each(function() {
                var id = $(this).attr('id');
                id = id.replace("price_",'');
                var price = $('#price_'+id).val();
                var quantity  = $('#quantity_'+id).val();
                if(!quantity) {
                    quantity = 1;
                }
                var total = price*quantity;
                $('#total_'+id).val(parseFloat(total));
                totalAmount += total;			
            });
            $('#subTotal').val(parseFloat(totalAmount));	
            var taxRate = $("#taxRate").val();
            var subTotal = $('#subTotal').val();	
            if(subTotal) {
                var taxAmount = subTotal*taxRate/100;
                $('#taxAmount').val(taxAmount);
                subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
                $('#totalAftertax').val(subTotal);		
                var amountPaid = $('#amountPaid').val();
                var totalAftertax = $('#totalAftertax').val();	
                if(amountPaid && totalAftertax) {
                    totalAftertax = totalAftertax-amountPaid;			
                    $('#amountDue').val(totalAftertax);
                } else {		
                    $('#amountDue').val(subTotal);
                }
            }
        }

 
    </script>




</head>
<body class="container">

    <div class="pricing-header mx-auto text-center">
        <h1 class="display-8">Al-BHS | INVOIE GENERATION</h1>
    </div>

    <div class="container">

        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="medics-tab" data-toggle="tab" href="#medics" role="tab" aria-controls="medics" aria-selected="true">Medicines</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="medics" role="tabpanel" aria-labelledby="medics-tab">

                <form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
		            <div class="load-animate animated fadeInUp">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mb-3">
                                <h3>From,</h3>
                                <?php echo $_SESSION['firstName']; ?>
                                <?php echo " "; ?>
                                <?php echo $_SESSION['lastName']; ?><br>	
                                <?php echo $_SESSION['workCenter']; ?><br>	
                                <?php echo $_SESSION['username']; ?><br>
                            </div>      		
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <h3>To,</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table class="table table-bordered table-hover" id="invoiceItem">	
                                    <tr>
                                        <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                        <th width="11%">Medic Nature</th>
                                        <th width="35%">Medic Name</th>
                                        <th width="20%">Brand Name</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Price</th>								
                                        <th width="12%">Total</th>
                                    </tr>							
                                    <tr class="added">
                                        <td><input class="itemRow" type="checkbox"></td>
                                        <td>
                                            <select class="form-control selectpicker" id="productCode_1" name="productCode[]" data-show-subtext="true" autocomplete="off" required>
                                                <option class="border-bottom abc" value="" disabled selected></option>
                                                <?php 
                                                    try
                                                    {
                                                        $sqlSelect = "SELECT DISTINCT medicType FROM medicStock ORDER BY medicType ASC";
                                                        $projresult = $conn->query($sqlSelect);
                                                        $projresult->setFetchMode(PDO::FETCH_ASSOC);

                                                        while ( $rowSelect = $projresult->fetch() ) 
                                                            {
                                                                echo '<option class="border-bottom abc" value="'.$rowSelect['medicType'].'">'.$rowSelect['medicType'].'</option>';
                                                            }
                                                    }catch (PDOException $e)
                                                    {   
                                                        die("Some problem getting data from database !!!" . $e->getMessage());
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control selectpicker" id="productName_1" name="productName[]" data-show-subtext="true" autocomplete="off" required>
                                                <option class="border-bottom abc" value="" disabled selected></option>
                                                <?php 
                                                    try
                                                    {
                                                        $sqlSelect1 = "SELECT DISTINCT medicName FROM medicStock WHERE amount <= 1 ORDER BY medicName ASC";
                                                        $projresult1 = $conn->query($sqlSelect1);
                                                        $projresult1->setFetchMode(PDO::FETCH_ASSOC);
                
                                                        while ( $rowSelect1 = $projresult1->fetch() ) 
                                                            {
                                                                echo '<option class="border-bottom abc" value="'.$rowSelect1['medicName'].'">'.$rowSelect1['medicName'].'</option>';
                                                            }
                                                    }catch (PDOException $e)
                                                    {   
                                                        die("Some problem getting data from database !!!" . $e->getMessage());
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control selectpicker" id="productName_1" name="productName[]" data-show-subtext="true" autocomplete="off" required>
                                                <option class="border-bottom abc" value="" disabled selected></option>
                                                <?php 
                                                    try
                                                    {
                                                        $sqlSelect2 = "SELECT DISTINCT medicBrandName FROM medicStock WHERE amount <= 1 ORDER BY medicBrandName ASC";
                                                        $projresult2 = $conn->query($sqlSelect2);
                                                        $projresult2->setFetchMode(PDO::FETCH_ASSOC);
                
                                                        while ( $rowSelect2 = $projresult2->fetch() ) 
                                                            {
                                                                echo '<option class="border-bottom abc" value="'.$rowSelect2['medicBrandName'].'">'.$rowSelect2['medicBrandName'].'</option>';
                                                            }
                                                    }catch (PDOException $e)
                                                    {   
                                                        die("Some problem getting data from database !!!" . $e->getMessage());
                                                    }
                                                ?>
                                            </select>
                                        </td>			
                                        <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                                        <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                                        <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                                    </tr>						
                                </table>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                                <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <h3>Notes: </h3>
                                <div class="form-group">
                                    <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" class="form-control" name="userId">
                                    <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
                                </div>
                                
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <span class="form-inline">
                                    <div class="form-group mb-3">
                                        <label>Subtotal: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tsh.</span>
                                            </div>
                                            <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Tax Rate: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Tax Amount: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tsh.</span>
                                            </div>
                                            <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
                                        </div>
                                    </div>							
                                    <div class="form-group mb-3">
                                        <label>Total: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tsh.</span>
                                            </div>
                                            <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Amount Paid: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tsh.</span>
                                            </div>
                                            <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Amount Due: &nbsp;</label>
                                        <div class="input-group calculations">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tsh.</span>
                                            </div>
                                            <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">&copy; <a href="#">AL-BHS</a> 2020</small>
                </div>
                
            </div>
        </footer>
    </div>
</body>
</html>

