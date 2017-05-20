<?php	
	include('../session.php');
?>

<?php
	
	if (isset($_POST['oppid'])) {			 

		include("../conn.php");
		$oppid = $_POST['oppid'];
		$pricelist = (isset($_POST['pricelist']) ? $_POST['pricelist'] : null);	
		$pid = (isset($_POST['product']) ? $_POST['product'] : null);	
		$price = (isset($_POST['price']) ? $_POST['price'] : null);	
		$qty = (isset($_POST['qty']) ? $_POST['qty'] : null);	
		$disType = (isset($_POST['distype']) ? $_POST['distype'] : null);	
		$dis = (isset($_POST['discount']) ? $_POST['discount'] : null);	
		$total = (isset($_POST['total']) ? $_POST['total'] : null);	
		$nt = (isset($_POST['nettotal']) ? $_POST['nettotal'] : null);	
		$delidate = (isset($_POST['delidate']) ? $_POST['delidate'] : null);
		$order_type = (isset($_POST['ordertype']) ? $_POST['ordertype'] : null);
		$line_type = (isset($_POST['linetype']) ? $_POST['linetype'] : null);
		$payment_terms = (isset($_POST['paymentterms']) ? $_POST['paymentterms'] : null);
		$freight = (isset($_POST['freightterms']) ? $_POST['freightterms'] : null);
		$customer = (isset($_POST['cusid']) ? $_POST['cusid'] : null);
		$outletid = (isset($_POST['ouletid']) ? $_POST['ouletid'] : null);
		$region = (isset($_POST['regionid']) ? $_POST['regionid'] : null);
		$site = (isset($_POST['siteid']) ? $_POST['siteid'] : null);
		$outlet = (int)$outletid;
		$transport_cost = 0;

		if($freight == "Charge to Customer")
		{
			$c = oci_connect("gml", "gml", "//174.10.0.40:1525/sales");

			
			//$customer = 67423;
			//$site = 183452;
			//$region = 1289;

			$trx_type = 0;
			$sales_type = 'CREDIT';
			$item = (int)$pid;
			//$qty = 1000;
			$franco = 'N';
			$franco2 = 'N';
			$partner = 'N';
			$service = null;
			$truck = 'N';
			//echo $site;

			$s = oci_parse($c, "begin :msg := gmobile_calc_transport(trunc(sysdate),:outlet,:customer,:site,:region,:trx_type,:sales_type,:item,:qty,:franco,:franco2,:partner,:service,:truck,
			:vca,:nf,:adjf,:npay,:adjpay,:dist,:rise,:ef,:listhdr,:addlist,:error); end;");


			//INPUT PARAM
			oci_bind_by_name($s, ":outlet", $outlet );
			oci_bind_by_name($s, ":customer", $customer );
			oci_bind_by_name($s, ":site", $site );
			oci_bind_by_name($s, ":region", $region );
			oci_bind_by_name($s, ":trx_type", $trx_type );
			oci_bind_by_name($s, ":sales_type", $sales_type );
			oci_bind_by_name($s, ":item", $item );
			oci_bind_by_name($s, ":qty", $qty);
			oci_bind_by_name($s, ":franco", $franco );
			oci_bind_by_name($s, ":franco2", $franco2 );
			oci_bind_by_name($s, ":partner", $spartner );
			oci_bind_by_name($s, ":service", $service );
			oci_bind_by_name($s, ":truck", $truck );
			//OUTPUT PARAM
			oci_bind_by_name($s, ":msg", $msg, 3000);
			oci_bind_by_name($s, ":vca", $vca, 300);
			oci_bind_by_name($s, ":nf", $nf, 10);
			oci_bind_by_name($s, ":adjf", $adjf, 10);
			oci_bind_by_name($s, ":npay", $npay, 10);
			oci_bind_by_name($s, ":adjpay", $adjpay, 10);
			oci_bind_by_name($s, ":dist", $dist, 10);
			oci_bind_by_name($s, ":rise", $rise, 10);
			oci_bind_by_name($s, ":ef", $ef, 10);
			oci_bind_by_name($s, ":listhdr", $listhdr, 10);
			oci_bind_by_name($s, ":addlist", $addlist, 10);
			oci_bind_by_name($s, ":error", $error, 1000);

			oci_execute($s);
			

			$transport_cost = $adjpay;
		}	
		else
		{
			$transport_cost = 0;
		}
		//echo $transport_cost;
		
		$total_after = "";
		if($dis == "")
	        {
	        	$total_after = $total;
	        }
	        else
	        {
	        	$total_after =  $nt;
	        }
		$dicount_per = 0;


		if($disType == 1) // fixed
		{
			$dicount_per = ($dis/$total)*100;
		}
		else if($disType == 2)
		{
			$dicount_per = $dis;

		}
		else
		{
			$dicount_per = 0;
		}

	       	$sql="CALL GML_CRM_CREATE_OPP_ITEM ('$oppid', '$pricelist', '$pid', '$price', '$qty', '$disType', '$dis', '$total', '$total_after', '$uid', to_date('". $delidate ."','dd-mm-yyyy hh24:mi:ss'), '$dicount_per', '$order_type', '$line_type', '$payment_terms', '$freight', '$transport_cost')";

			$stmt = oci_parse($conn,$sql);
			$rc=oci_execute($stmt);
		
					
			oci_commit($conn);
		
		
	}	
?>



	
	


		