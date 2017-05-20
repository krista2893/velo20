<?php
	include('session.php');
?>
<?php
	require('conn.php')
?>
<?php
	include('assets/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gamma Materials | CRM</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="assets/_css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/_css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="assets/_css/bootstrap-datepicker3.css" />
	<link rel="stylesheet" href="assets/_css/morris.css">
	<link rel="stylesheet" href="assets/_css/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="assets/_css/gamma.css" />
	<link rel="stylesheet" href="assets/_css/toastr.min.css" />
	<link rel="stylesheet" href="assets/_css/font-awesome.css" />

	<script src="assets/_js/jquery.min.js"></script>	
	<script src="assets/_js/bootstrap.min.js"></script>
	<!--<script src="assets/_js/0f9f5859c1.js"></script>-->
	<script src="assets/_js/jquery.dataTables.min.js"></script>
	<script src="assets/_js/toastr.min.js"></script>
	<script src="assets/_js/bootstrap-datepicker.js"></script>
	<script src="assets/_js/raphael-min.js"></script>
	<script src="assets/_js/morris.min.js"></script>
	<script src="assets/_js/bootstrap-multiselect.js"></script>
	<script src="assets/_js/jquery.number.min.js"></script>
	<link rel='shortcut icon' href='favicon.png' type='image/x-icon'/ >

	<style>
		#fixed_opp
		{
			height: 300px;
			overflow-y: scroll;
		}
	</style>
</head>

<body>
	<br />

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-md-offset-1">
				<img src="assets/_images/logo.png" width="150" height="80" />
			</div>

			<div class="col-md-1 col-md-offset-5">
				<img src="assets/_images/findus.png" width="100" height="50" class="hidden-xs"/>
			</div>

			<div class="col-md-2">
				<img src="assets/_images/callus.png" width="120" height="50" class="hidden-xs" />
			</div>
		</div>
	</div>

	
	<nav class="navbar navbar-inverse">
  		<div class="container-fluid">
    		<div class="navbar-header">
      			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span> 
      			</button>
      
      		<a class="navbar-brand" href="#"></a>
    		</div>
    		
    		<div class="collapse navbar-collapse" id="myNavbar">
      			<ul class="nav navbar-nav">
			        <li><a href="home.php">Home</a></li>
			       <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="lead.php">Leads
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				        	<li><a href="lead.php"></span>Search Lead</a></li>
				         	<li><a href="add_lead.php"></span>Add Lead</a></li>
					       
					        <li><a href="addcontact.php">Add Contact</a></li>
						<li><a href="add_draft_lead.php">Add Draft Lead</a></li>
						<li><a href="view_draft_notes.php">View Draft Leads</a></li>
	
				        </ul>
				    </li>
			         
			         
			        <li class="active"><a href="opportunity.php">Opportunities</a></li>			       
			        <li><a href="task.php">Interactions</a></li> 
<li><a href="orders.php">Orders</a></li>
 
				<li><a href="campaign.php">Campaign</a></li>
				 <li><a href="product.php">Products</a></li>

      			</ul>

      			<ul class="nav navbar-nav navbar-right">
      				<li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome <span id="login_user_id"><?php echo $login_session; ?>!</span>
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				         
				          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
				        </ul>
				      </li>
        			
      			</ul>
    		</div>
  		</div>
	</nav>

		
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<h3>Customer Information</h3>

			</div>
		</div>
	</div>



	<div class="container-fluid">
		 <div class="jumbotron">
	<?php

		if(isset($_GET['cusid']))
		{
			$id = $_GET['cusid'];
			$ooid = $_GET['oppid'];
				$sql = 'SELECT * FROM GML_CRM_CUSTOMERS
				WHERE GML_CRM_CUSTOMERS.CUSTOMER_ID = :didbv';
				
				$stid = oci_parse($conn, $sql);
				$didbv = $id;
				oci_bind_by_name($stid, ':didbv', $didbv);
		 		
				oci_execute($stid);

				
				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) 
				{
					$cus_id = $row['CUSTOMER_ID'];
					$ltype = (isset($row['CUSTOMER_TYPE']) != '' ? $row['CUSTOMER_TYPE'] : null);
			    	$fname = (isset($row['FIRST_NAME']) != '' ? $row['FIRST_NAME'] : null);
			    	$sname = (isset($row['LAST_NAME']) != '' ? $row['LAST_NAME'] : null);
			    	$orgname = (isset($row['CUSTOMER_NAME']) != '' ? $row['CUSTOMER_NAME'] : null);
			    	$add1 = (isset($row['ADDRESS1']) != '' ? $row['ADDRESS1'] : null);
			    	$city = (isset($row['LEAD_CITY'])!= '' ? $row['LEAD_CITY'] : null);
			    	$title = (isset($row['TITLE'])!= '' ? $row['TITLE'] : null);
			    	$org_vatno = (isset($row['TAX_REFERENCE'])!= '' ? $row['TAX_REFERENCE'] : null);
			    	$org_brn = (isset($row['BUSINESS_REG_NO'])!= '' ? $row['BUSINESS_REG_NO'] : null);
			    	$add2 = (isset($row['ADDRESS2'])!= '' ? $row['ADDRESS2'] : null);
			    	$add3 = (isset($row['ADDRESS3'])!= '' ? $row['ADDRESS3'] : null);
			    	$location = (isset($row['LEAD_LOCATION'])!= '' ? $row['LEAD_LOCATION'] : null);
			    	$region = (isset($row['LEAD_REGION'])!= '' ? $row['LEAD_REGION'] : null);
			    	$homeno = (isset($row['LANDLINE_NO'])!= '' ? $row['LANDLINE_NO'] : null);
			    	$mobileno = (isset($row['LEAD_MOBILENO'])!= '' ? $row['LEAD_MOBILENO'] : null);
			    	$email1 = (isset($row['EMAIL_ADDRESS'])!= '' ? $row['EMAIL_ADDRESS'] : null);
			    	$email2 = (isset($row['LEAD_EMAIL2'])!= '' ? $row['LEAD_EMAIL2'] : null);
			    	$cus_class = (isset($row['CUSTOMER_CLASS_CODE'])!= '' ? $row['CUSTOMER_CLASS_CODE'] : null);
					
					$c_title = (isset($row['CONTACT_TITLE'])!= '' ? $row['CONTACT_TITLE'] : null);	
					$c_fname = (isset($row['CONTACT_FNAME'])!= '' ? $row['CONTACT_FNAME'] : null);
					$c_lname = (isset($row['CONTACT_SNAME'])!= '' ? $row['CONTACT_SNAME'] : null);
					$c_job = (isset($row['JOB_TITLE'])!= '' ? $row['JOB_TITLE'] : null);
					$c_landline = (isset($row['LANDLINE'])!= '' ? $row['LANDLINE'] : null);
					$c_mobile = (isset($row['MOBILE'])!= '' ? $row['MOBILE'] : null);
					$c_email = (isset($row['EMAIL'])!= '' ? $row['EMAIL'] : null);
					$c_prim = (isset($row['PRIMARY'])!= '' ? $row['PRIMARY'] : null);

					
				}

				

				if($fname == null)
				{
					echo "
					<div class='row'>
						<div class='col-md-4'>
							<span class='lblTx'>Organization name: </span>" .$orgname . "
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>BRN: </span>" . $org_brn . "
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>VAT No.: </span>" . $org_vatno . "
						</div>
					</div>";
				}
				else
				{
					echo "
					<div class='row'>
						<div class='col-md-12'>
							<span class='lblTx'>Name: </span>" .$title . " " . $fname . " " . $sname . "
						</div>
					</div>";
				}

				echo "

					<div class='row'>
						<div class='col-md-12'>
							<span class='lblTx'>Address: </span>" .$add1 . " " . $add2 . " " . $add3 . "
						</div>
					</div>

					<div class='row'>
						<div class='col-md-4'>
							<span class='lblTx'>City: </span>" .$city . " 
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>Region: </span>" .$region . " 
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>Location: </span>" .$location . " 
						</div>

					</div>

					<div class='row'>
						<div class='col-md-4'>
							<span class='lblTx'>Home No: </span>" .$homeno . " 
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>Mobile No: </span>" .$mobileno . " 
						</div>

						<div class='col-md-4'>
							<span class='lblTx'>Email 1: </span>" .$email1 . " 
						</div>
					</div>


				";

				echo '<br /><button class="btn btn-round" data-toggle="collapse" data-target="#constagehis">View Construction Stage History</button>';

				echo '<div id="constagehis" class="collapse">';
					
					getConstructionHistory($_GET['cusid'], $_GET['oppid']);
				
				echo '</div>';


				echo "<h4>Primary Contacts</h4>";
				RecallPrimaryContacts($cus_id);

				if($ltype == "PERSON")
				{
					echo '';
				}
				else
				{
					echo "<h4>Project</h4>";
				
					$sql_p = 'SELECT opportunity_id, project_id, project_name, customer_name FROM gml_crm_opportunity 
						LEFT OUTER JOIN gml_crm_lead ON gml_crm_lead.lead_id = project_id
						WHERE opportunity_id = :didbvp';
			
					$stid_p = oci_parse($conn, $sql_p);	
					$didbv_p = $_GET['oppid'];		
					oci_bind_by_name($stid_p, ':didbvp', $didbv_p);						
					oci_execute($stid_p);	
					$p_name_p = "";
					while (($row = oci_fetch_array($stid_p, OCI_ASSOC)) != false) 
					{
				
						$oppid_p = (isset($row['OPPORTUNITY_ID']) != '' ? $row['OPPORTUNITY_ID'] : null);
						$project_id_p = (isset($row['PROJECT_ID']) != '' ? $row['PROJECT_ID'] : null);
						$project_name_p = (isset($row['PROJECT_NAME']) != '' ? $row['PROJECT_NAME'] : null);
						$cus_name_p = (isset($row['CUSTOMER_NAME']) != '' ? $row['CUSTOMER_NAME'] : null);
						if ($project_name_p == null)
						{
							$p_name_p = $cus_name_p;
						}
						else
						{
							$p_name_p = $project_name_p;
						}
						echo '<div class="row"><div class="col-md-12">' . $p_name_p . ' </div></div>';

					}

				}

				
				echo "<br /><h4>Ship to site</h4>";
				
				RecallShippingOppCus($ooid);

			
			

				echo '<div id="sa" class="collapse">
				<form action="" method="post">
			      	<div class="container-fluid">
			      		<div class="row">
			      			<div class="col-md-3 col-md-offset-1">
			      				<div class="form-group">
						  <label for="usr">Address 1:</label>
						  <input type="text" class="form-control" id="usr" name="tadd1">
						</div>
			      			</div>

			      			<div class="col-md-3 col-md-offset-1">

			      				<div class="form-group">
						  <label for="usr">Address 2:</label>
						  <input type="text" class="form-control" id="usr" name="tadd2">
						</div>
			      			</div>

			      			<div class="col-md-3 col-md-offset-1">

			      				<div class="form-group">
						  <label for="usr">Address 3:</label>
						  <input type="text" class="form-control" id="usr" name="tadd3">
						</div>

			      			</div>
			      		</div>

			      		<div class="row">
			      			<div class="col-md-3 col-md-offset-1">
			      				<div class="form-group">
						  <label for="usr">City:</label>
						  <input type="text" class="form-control" id="usr" name="tcity3">
						</div>
			      			</div>

			      			<div class="col-md-3 col-md-offset-1">
							

							<div class="form-group">	
												<label for="Location">Location:</label>	<br />						
													<select id="txtLocation" name="tlocation3">
														<option value="0">Select</option>';									
														getLocations(); 
													echo '</select>
											</div>
			   				
			      			</div>

			      			<div class="col-md-3 col-md-offset-1">   				

							<div class="form-group">	
										<label for="Region1">Region:</label>	<br />						
										<select id="txtRegion" name="tregion3">	
											<option value="0">Select</option>';
												getRegions(); 
										echo '</select>
									</div>


			      			</div>
			      		</div>

					<div class="row">	
						<div class="col-md-3 col-md-offset-1">
							<div class="form-group">
						  	<label for="usr">District:</label>
						  	<input type="text" class="form-control" id="txtDistrict" name="tdistrict3">
							</div>
						
						</div>

						<div class="col-md-8">
							<br />

							<button type="submit" class="btn btn-default pull-right" name="save_shipping">Add Address</button>
						</div>

					</div>
			      		

			      	</div>
			</form>
							</div>';


		if(isset($_POST['save_shipping']))
		{
			$ta1 = $_POST['tadd1'];
			$ta2=$_POST['tadd2'];
			$ta3 = $_POST['tadd3'];
			$tc = $_POST['tcity3'];
			$tr = $_POST['tregion3'];
			$tl = $_POST['tlocation3'];
			$district = $_POST['tdistrict3'];
			$c_type = 1;
			$x1 = str_replace("'","''", $ta1);
			$x2 = str_replace("'","''", $ta2);
			$x3 = str_replace("'","''", $ta3);
			$x4 = str_replace("'","''", $tc);
			$x5 = str_replace("'","''", $tr);
			$x6 = str_replace("'","''", $tl);		
			$x7 = str_replace("'","''", $district);


			$userid = $uid;
	       	$isql="CALL GML_CRM_CREATE_SHIPPING('$cus_id', '$x1', '$x2', '$x3', '$x4', '$x5', '$x6', '$uid', '$x7', '$c_type')";

			$stmt = oci_parse($conn,$isql);

			$rc=oci_execute($stmt);
			if(!$rc)
			{
				$e=oci_error($stmt);
				var_dump($e);
			}
			else
			{
				echo "<script>toastr.success('Shipping address successfully added.')</script>";
				
			}
				oci_commit($conn);

				//oci_free_statement($stmt);
		}



				
				
				}	
		
			?>



		</div>
		
	</div>

	<?php 
		if(isset($_GET['oppid']))
		{
			include("conn.php");
			$oppid = $_GET['oppid'];
			$sql = 'SELECT  gml_crm_sites.region_id FROM gml_crm_sites  LEFT JOIN gml_crm_opportunity a ON a.shipping_id = site_id WHERE opportunity_id = :didbv';

			$stid = oci_parse($conn, $sql);	
			oci_bind_by_name($stid, ':didbv', $oppid);
						
			oci_execute($stid);
			
			

			
			while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) 
			{
				$s1 = (isset($row['REGION_ID']) != '' ? $row['REGION_ID'] : null);
				
		    	echo '<input type="hidden" id="hdShiRegionID" value="' . $s1. '" />';
			}
		}

	?>

	<?php 
		if(isset($_GET['oppid']))
		{
			include("conn.php");
			$oppid = $_GET['oppid'];
			
			$sql = 'SELECT shipping_id FROM gml_crm_opportunity where opportunity_id = :didbv';
				
			$stid = oci_parse($conn, $sql);			
			oci_bind_by_name($stid, ':didbv', $oppid);
		 	
			oci_execute($stid);
		
			while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) 
			{
				
				
				$siteid = (isset($row['SHIPPING_ID'])!= '' ? $row['SHIPPING_ID'] : null);

				
				echo '<input type="hidden" id="hdShipToId" value="' . $siteid . '" />';
			}
		}
	?>


	<div class="table-responsive">
		<table class="table table-hovered table-striped">
			<thead>
				<tr>
					<th>Price List Name</th>
					<th>Product</th>
					<th>Std Price</th>
					<th>Opp Qty</th>
					<th>UOM</th>
					<th>Total ex Trans</th>
					<th>Discount Type</th>
					<th id="swDisc">Discount</th>
					<th id="swNettotal">Sub Total with Dis</th>
					<th>Delivery Date</th>
					<th>Order Type</th>				
					<th>Freigh Terms</th>
					<th>Transport</th>
					<th>Net Total with Trans ex VAT</th>
					<th>Total incl Trans &amp; VAT</th>
					<th>Opp Unit Rate ex Trans &amp; VAT</th>
					<th>Trans Rate / Unit</th>
					<th>Total Rate / Unit</th>
				</tr>
			</thead>

			<tbody>
				<tr>

					<td>	
						<div class="form-group">
	  						
	  						<select id="price_list" name="price_list_outlet">
								<?php getPriceListName(); ?>
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">	
												
							<select id="product" name="product_name" class="multidrp">
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">												 
							<input type="text" class="form-control spec_width" id="std_price" name="txtStdPrice">
						</div>
					</td>

					<td>
						<div class="form-group">
										 
							<input type="text" class="form-control spec_width" id="qty" name="txtQty">
						</div>
					</td>

					<td>
						<div class="form-group">										 
							<input type="text" class="form-control spec_width" id="uom" disabled/>
						</div>
					</td>

					<td>
						<div class="form-group">	
									 
							<input type="text" class="form-control spec_width" id="total" name="txtTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<select required class="form-control spec_width" id="dpDiscountType" name="DisType">
							    	<option value="0">Select</option>
							    	<option value="1">Fixed</option>
							    	<option value="2">Percent</option>
							</select>
				  		</div>
					</td>

					<td>
						<div class="form-group">
												 
							<input type="text" class="form-control spec_width" id="discount" name="txtDiscount" onchange="GetMaxDiscount();" value="0">
						</div>
					</td>

					<td>
						<div class="form-group">
													 
							<input type="text" class="form-control spec_width" id="nettotal" name="txtNetTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<div class="input-group date" data-provide="datepicker">
								<input type="text" class="form-control spec_width" name="delidate" id="txtDeliDate">
								<div class="input-group-addon">									        
								<i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>
						</div>
					</td>


					<td>
						<div class="form-group">
	  						
	  						<select id="order_type" name="paymentterms" class="multidrp">
							
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">
		  					<select id="freight_terms" name="freightterms" onchange="GetTransportCostVelo();">
								<?php getFreightTerms(); ?>
							</select>
					
						</div>

					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_transport_cost" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_with_trans" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_tot_inc_trans_vat" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_unit_rate_ex_trans_vat" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_trans_rate" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_rate" class="form-control spec_width" />
						</div>
					</td>


					<td>
						<input type="hidden" id="hdOpid" value="<?php echo $_GET['oppid']; ?>" />
						<input type="hidden" id="hdCusID" value="<?php echo $_GET['cusid']; ?>" />
						<!--<button type="submit" name="create_opp" class="btn btn-default">Create Opportunity</button>-->
						<button type="submit" id="btnCreateOpp" onclick="create_opportunity();" class="btn btn-default"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
						
					</td>
				</tr>

				<tr>

					<td>	
						<div class="form-group">
	  						
	  						<select id="price_list2" name="price_list_outlet">
								<?php getPriceListName(); ?>
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">	
												
							<select id="product2" name="product_name" class="multidrp">
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">												 
							<input type="text" class="form-control spec_width" id="std_price2" name="txtStdPrice">
						</div>
					</td>

					<td>
						<div class="form-group">
										 
							<input type="text" class="form-control spec_width" id="qty2" name="txtQty">
						</div>
					</td>

					<td>
						<div class="form-group">										 
							<input type="text" class="form-control spec_width" id="uom2" disabled/>
						</div>
					</td>


					<td>
						<div class="form-group">	
									 
							<input type="text" class="form-control spec_width" id="total2" name="txtTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<select required class="form-control spec_width" id="dpDiscountType2" name="DisType">
							    	<option value="0">Select</option>
							    	<option value="1">Fixed</option>
							    	<option value="2">Percent</option>
							</select>
				  		</div>
					</td>

					<td>
						<div class="form-group">
												 
							<input type="text" class="form-control spec_width" id="discount2" name="txtDiscount" onchange="GetMaxDiscount2();" value="0">
						</div>
					</td>

					<td>
						<div class="form-group">
													 
							<input type="text" class="form-control spec_width" id="nettotal2" name="txtNetTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<div class="input-group date" data-provide="datepicker">
								<input type="text" class="form-control spec_width" name="delidate" id="txtDeliDate2">
								<div class="input-group-addon">									        
								<i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>
						</div>
					</td>


					<td>
						<div class="form-group">
	  						
	  						<select id="order_type2" name="paymentterms" class="multidrp">
							
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">
		  					<select id="freight_terms2" name="freightterms" onchange="GetTransportCostVelo2();">
								<?php getFreightTerms(); ?>
							</select>
					
						</div>

					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_transport_cost2" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_with_trans2" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_tot_inc_trans_vat2" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_unit_rate_ex_trans_vat2" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_trans_rate2" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_rate2" class="form-control spec_width" />
						</div>
					</td>


					<td>
						
						<button type="submit" id="btnCreateOpp" onclick="create_opportunity2();" class="btn btn-default"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
						
					</td>
				</tr>


				<tr>

					<td>	
						<div class="form-group">
	  						
	  						<select id="price_list3" name="price_list_outlet">
								<?php getPriceListName(); ?>
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">	
												
							<select id="product3" name="product_name" class="multidrp">
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">												 
							<input type="text" class="form-control spec_width" id="std_price3" name="txtStdPrice">
						</div>
					</td>

					<td>
						<div class="form-group">
										 
							<input type="text" class="form-control spec_width" id="qty3" name="txtQty">
						</div>
					</td>

						<td>
						<div class="form-group">										 
							<input type="text" class="form-control spec_width" id="uom3" disabled/>
						</div>
					</td>

					<td>
						<div class="form-group">	
									 
							<input type="text" class="form-control spec_width" id="total3" name="txtTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<select required class="form-control spec_width" id="dpDiscountType3" name="DisType">
							    	<option value="0">Select</option>
							    	<option value="1">Fixed</option>
							    	<option value="2">Percent</option>
							</select>
				  		</div>
					</td>

					<td>
						<div class="form-group">
												 
							<input type="text" class="form-control spec_width" id="discount3" name="txtDiscount" onchange="GetMaxDiscount3();" value="0">
						</div>
					</td>

					<td>
						<div class="form-group">
													 
							<input type="text" class="form-control spec_width" id="nettotal3" name="txtNetTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<div class="input-group date" data-provide="datepicker">
								<input type="text" class="form-control spec_width" name="delidate" id="txtDeliDate3">
								<div class="input-group-addon">									        
								<i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>
						</div>
					</td>


					<td>
						<div class="form-group">
	  						
	  						<select id="order_type3" name="paymentterms" class="multidrp">
							
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">
		  					<select id="freight_terms3" name="freightterms" onchange="GetTransportCostVelo3();">
								<?php getFreightTerms(); ?>
							</select>
					
						</div>

					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_transport_cost3" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_with_trans3" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_tot_inc_trans_vat3" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_unit_rate_ex_trans_vat3" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_trans_rate3" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_rate3" class="form-control spec_width" />
						</div>
					</td>


					<td>
						
						<button type="submit" id="btnCreateOpp" onclick="create_opportunity3();" class="btn btn-default"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
						
					</td>
				</tr>
				
				<tr>

					<td>	
						<div class="form-group">
	  						
	  						<select id="price_list4" name="price_list_outlet">
								<?php getPriceListName(); ?>
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">	
												
							<select id="product4" name="product_name" class="multidrp">
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">												 
							<input type="text" class="form-control spec_width" id="std_price4" name="txtStdPrice">
						</div>
					</td>

					<td>
						<div class="form-group">
										 
							<input type="text" class="form-control spec_width" id="qty4" name="txtQty">
						</div>
					</td>

					<td>
						<div class="form-group">										 
							<input type="text" class="form-control spec_width" id="uom4" disabled/>
						</div>
					</td>

					<td>
						<div class="form-group">	
									 
							<input type="text" class="form-control spec_width" id="total4" name="txtTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<select required class="form-control spec_width" id="dpDiscountType4" name="DisType">
							    	<option value="0">Select</option>
							    	<option value="1">Fixed</option>
							    	<option value="2">Percent</option>
							</select>
				  		</div>
					</td>

					<td>
						<div class="form-group">
												 
							<input type="text" class="form-control spec_width" id="discount4" name="txtDiscount" onchange="GetMaxDiscount4();" value="0">
						</div>
					</td>

					<td>
						<div class="form-group">
													 
							<input type="text" class="form-control spec_width" id="nettotal4" name="txtNetTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<div class="input-group date" data-provide="datepicker">
								<input type="text" class="form-control spec_width" name="delidate" id="txtDeliDate4">
								<div class="input-group-addon">									        
								<i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>
						</div>
					</td>


					<td>
						<div class="form-group">
	  						
	  						<select id="order_type4" name="paymentterms" class="multidrp">
							
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">
		  					<select id="freight_terms4" name="freightterms" onchange="GetTransportCostVelo4();">
								<?php getFreightTerms(); ?>
							</select>
					
						</div>

					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_transport_cost4" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_with_trans4" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_tot_inc_trans_vat4" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_unit_rate_ex_trans_vat4" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_trans_rate4" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_rate4" class="form-control spec_width" />
						</div>
					</td>


					<td>
						
						<button type="submit" id="btnCreateOpp" onclick="create_opportunity4();" class="btn btn-default"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
						
					</td>
				</tr>

				<tr>

					<td>	
						<div class="form-group">
	  						
	  						<select id="price_list5" name="price_list_outlet">
								<?php getPriceListName(); ?>
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">	
												
							<select id="product5" name="product_name" class="multidrp">
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">												 
							<input type="text" class="form-control spec_width" id="std_price5" name="txtStdPrice">
						</div>
					</td>

					<td>
						<div class="form-group">
										 
							<input type="text" class="form-control spec_width" id="qty5" name="txtQty">
						</div>
					</td>

						<td>
						<div class="form-group">										 
							<input type="text" class="form-control spec_width" id="uom5" disabled/>
						</div>
					</td>

					<td>
						<div class="form-group">	
									 
							<input type="text" class="form-control spec_width" id="total5" name="txtTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<select required class="form-control spec_width" id="dpDiscountType5" name="DisType">
							    	<option value="0">Select</option>
							    	<option value="1">Fixed</option>
							    	<option value="2">Percent</option>
							</select>
				  		</div>
					</td>

					<td>
						<div class="form-group">
												 
							<input type="text" class="form-control spec_width" id="discount5" name="txtDiscount" onchange="GetMaxDiscount5();" value="0">
						</div>
					</td>

					<td>
						<div class="form-group">
													 
							<input type="text" class="form-control spec_width" id="nettotal5" name="txtNetTotal">
						</div>
					</td>

					<td>
						<div class="form-group">
							
							<div class="input-group date" data-provide="datepicker">
								<input type="text" class="form-control spec_width" name="delidate" id="txtDeliDate5">
								<div class="input-group-addon">									        
								<i class="fa fa-calendar" aria-hidden="true"></i>
							    </div>
							</div>
						</div>
					</td>


					<td>
						<div class="form-group">
	  						
	  						<select id="order_type5" name="paymentterms" class="multidrp">
							
							</select>
						</div>
					</td>

					<td>
						<div class="form-group">
		  					<select id="freight_terms5" name="freightterms" onchange="GetTransportCostVelo5();">
								<?php getFreightTerms(); ?>
							</select>
					
						</div>

					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_transport_cost5" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_with_trans5" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_tot_inc_trans_vat5" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_unit_rate_ex_trans_vat5" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_trans_rate5" class="form-control spec_width" />
						</div>
					</td>

					<td>
						<div class="form-group">
							<input type="text" id="calc_total_rate5" class="form-control spec_width" />
						</div>
					</td>


					<td>
						
						<button type="submit" id="btnCreateOpp" onclick="create_opportunity5();" class="btn btn-default"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></button>
						
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div id="update_cons_stage" class="modal fade" role="dialog">
  			<div class="modal-dialog">
        			<div class="modal-content">
				<form action="" method="post">
     					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        					<h4 class="modal-title">Update Construction Stage</h4>
      					</div>

     	 				<div class="modal-body">
						<div class="container">
       							<div class="row">
								<div class="col-md-6">							
									<div class="form-group">
							    			<label for="dpCS">Construction Stage:</label>
								    		<select class="form-control" id="dpConsStage" name="cons_stage">
								    			<option value="0">Select</option>
											<?php GetConstructionStage(); ?>				 
								    		</select>
			  						</div>	
								</div>
							</div>
						</div>
      					</div>

      					<div class="modal-footer">
        					<button type="submit" class="btn btn-default" name="update_cons_state">Update Construction Stage</button>
      					</div>
				</form>

				<?php
					if(isset($_POST['update_cons_state']))
					{
						$opp = $_GET['oppid'];
						$c = $_GET['cusid'];

						$cons_id = $_POST['cons_stage'];

						$isql="CALL GML_CRM_UPDATE_CONS_STAGE('$opp', '$c', '$cons_id', '$uid')";

						$stmt = oci_parse($conn,$isql);
						oci_bind_by_name($stmt, ":oid", $opp);
						oci_bind_by_name($stmt, ":sid", $sid);

						$rc=oci_execute($stmt);
						if(!$rc)
						{
							$e=oci_error($stmt);
							var_dump($e);
						}
						else
						{
							echo "<script>window.open('cus_oppor.php?cusid=$c&oppid=$opp', '_self');</script>";
							echo "<script>toastr.success(Construction stage successfully updated.')</script>";
				
						}
						oci_commit($conn);

					}
				?>
    				</div>

  			</div>
		</div>

		<div id="update_cons_stage1" class="modal fade" role="dialog">
  			<div class="modal-dialog">
        			<div class="modal-content">
				
     					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal">&times;</button>
        					<h4 class="modal-title">Update Construction Stage</h4>
      					</div>

     	 				<div class="modal-body">
						<div class="container">
       							<div class="row">
								<div class="col-md-6">	
									<input type="hidden" id="num" />
									<input type="hidden" id="opcloseid" value="<?php echo $_GET['oppid']; ?>" />
									<input type="hidden" id="cuscloseid" value="<?php echo $_GET['cusid']; ?>" />					
									<div class="form-group">
							    			<label for="dpCS">Construction Stage:</label>
								    		<select class="form-control" id="dpConsStage1" name="cons_stage">
								    			<option value="0">Select</option>
											<?php GetConstructionStage(); ?>				 
								    		</select>
			  						</div>	
								</div>
							</div>
						</div>
      					</div>

      					<div class="modal-footer">
        					<button type="submit" class="btn btn-default" onclick="update_close_cons();">Update Construction Stage</button>
      					</div>
				

				
    				</div>

  			</div>
		</div>

	
	
	<?php 

	$oppid = $_GET['oppid'];

	?>

<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="btn-group">
					<button type="button" class="btn gp" onclick="selectshippingaddress(<?php echo $_GET['oppid']; ?>);">Select Shipping Address</button>
					<!--<button type="button" class="btn gp" data-toggle="modal" data-target="#addship">Select Shipping Address</button>-->
					<?php
						if($ltype == "PERSON")
						{
							echo '';
						}
						else
						{
							echo '<button type="button" class="btn gp" onclick="selectprojectid('.$_GET['oppid'].');">Select Project</button>';
						}
					?>
					
					<!--<button type="button" class="btn gp" data-toggle="modal" data-target="#addproject">Select Project</button>-->
					<a href="cus_inter.php?oid=<?php echo $_GET['oppid']; ?>" class="btn gp">Add Interaction</a>
					<a href="deleteopp.php?oid=<?php echo $_GET['oppid']; ?>" class="btn gp">Delete Opportunity</a>
					<!--<button type="button" class="btn gp" data-toggle="modal" data-target="#closeOpp">Close Opportunity</button>-->
							  
				</div>				
			</div>
		</div>
	</div>
	<br />

	<!-- add pro modal -->
	
<div id="addproject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Project</h4>
      </div>
      <div class="modal-body">
        
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="form-group">
						<label>Project Name:</label>							
				
						<select id="pro_opp" name="project_name_opp">
							<option value="0">Select</option>									
							<?php getProOpp(); ?>
						</select>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<input type="submit" class="btn btn-default pull-right" value="Save Project" name="add_pro_oppor" />							
				</div>
			</div>			
		</form>

		<?php
			if(isset($_POST['add_pro_oppor']))
		{
			$opp = $_GET['oppid'];
			$c = $_GET['cusid'];
			$pid = $_POST['project_name_opp'];
			$isql="UPDATE gml_crm_opportunity SET PROJECT_ID = :pid WHERE OPPORTUNITY_ID = :oid";

			$stmt = oci_parse($conn,$isql);
			oci_bind_by_name($stmt, ":oid", $opp);
			oci_bind_by_name($stmt, ":pid", $pid);

			$rc=oci_execute($stmt);
			if(!$rc)
			{
				$e=oci_error($stmt);
				var_dump($e);
			}
			else
			{
				echo "<script>window.open('cus_oppor.php?cusid=$c&oppid=$opp', '_self');</script>";
				echo "<script>toastr.success('Project successfully added.')</script>";
				
			}
				oci_commit($conn);

				//oci_free_statement($stmt);
		}

	


		?>

	
		
							

	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<!-- add pro modal ends -->

	

<div id="addship" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
    	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Shipping Address</h4>
      </div>
      <div class="modal-body">


      <form action="" method="post">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="form-group">
						<label>Shipping Site:</label>							
				
						<select id="shippin_opp" name="shipping_name_opp">
							<option value="0">Select</option>									
							<?php 
								$leadid = $_GET[cusid];
								getShippingAddOppCus($leadid); ?>
						</select>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<input type="submit" class="btn btn-default pull-right" value="Save Shipping Address" name="add_shipping_oppor" />							
				</div>
			</div>			
		</form>

		<?php
			if(isset($_POST['add_shipping_oppor']))
		{
			$opp = $_GET['oppid'];
			$c = $_GET['cusid'];
			$sid = $_POST['shipping_name_opp'];
			$isql="UPDATE gml_crm_opportunity SET SHIPPING_ID = :sid WHERE OPPORTUNITY_ID = :oid";

			$stmt = oci_parse($conn,$isql);
			oci_bind_by_name($stmt, ":oid", $opp);
			oci_bind_by_name($stmt, ":sid", $sid);

			$rc=oci_execute($stmt);
			if(!$rc)
			{
				$e=oci_error($stmt);
				var_dump($e);
			}
			else
			{
				echo "<script>window.open('cus_oppor.php?cusid=$c&oppid=$opp', '_self');</script>";
				echo "<script>toastr.success(Shipping address successfully added.')</script>";
				
			}
				oci_commit($conn);

				//oci_free_statement($stmt);
		}

	


		?>     	
	        
      	</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  


    </div>

  </div>
</div>

<div id="err_add_ship" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
    	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Error - Shipping Address</h4>
      </div>
      <div class="modal-body">

		A shipping address has already been selected for this opportunity.

		<br /><br />
		Please create a new opportunity for a new shipping address.
  
		      	
	        
      	</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  


    </div>

  </div>
</div>

<div id="err_add_pro" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
    	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Error - Project Selection</h4>
      </div>
      <div class="modal-body">

		A project has already been selected for this opportunity.

		<br /><br />
		Please create a new opportunity for this project with the respective ship to address.
  
		      	
	        
      	</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  


    </div>

  </div>
</div>


	
	
	<?php
		
				$sql = 'SELECT gml_crm_opportunity.OPPORTUNITY_ID, gml_crm_opp_item.*,
gml_crm_opp_item.TOTAL, gml_crm_opp_item.TOTAL_AFTER_DIS,
GML_CRM_ITEM_PRICES_all.DESCRIPTION As PRODUCT_NAME, GML_CRM_ITEM_PRICES_ALL.PRICE_LIST_NAME
 FROM gml_crm_opportunity
 LEFT OUTER JOIN gml_crm_opp_item ON gml_crm_opp_item.OPPID = gml_crm_opportunity.OPPORTUNITY_ID
 LEFT OUTER JOIN gml_crm_item_prices_all ON GML_CRM_ITEM_PRICES_all.INVENTORY_ITEM_ID = GML_CRM_OPP_ITEM.PRODUCT_ID
 AND GML_CRM_ITEM_PRICES_ALL.LIST_HEADER_ID = GML_CRM_OPP_ITEM.PRICE_LIST
LEFT OUTER JOIN gml_crm_opp_wl_reason ON gml_crm_opp_wl_reason.reason_id = gml_crm_opp_item.OPP_STATUS_COMMENT
				WHERE lead_id = :didbl AND OPPORTUNITY_ID = :didbo AND gml_crm_opp_item.PRICE_LIST IS NOT NULL';
				
				$stid = oci_parse($conn, $sql);

				//$didbv = $uid;
				$didbl = $cus_id;
				$didbo = $_GET['oppid'];
				//oci_bind_by_name($stid, ':didbv', $didbv);
				oci_bind_by_name($stid, ':didbl', $didbl);
				oci_bind_by_name($stid, ':didbo', $didbo);
				oci_execute($stid);

				echo "

					<div class='table-responsive'>
			    			<table class='table table-striped' id='tbl_oppor'>

			    				<thead>
			    					<tr>
			    						<th>Status</th>	
			    						<th>Close Opp</th>											
										<th>Create Order</th>			    						
			    						<th>Product</th>
										<th>Opp Price/Unit</th>
										<th>Opp Qty</th>
										<th>Remaining Qty</th>
										<th>Next Deli. Date</th>
										<th>Op Total ex Trans</th>
										<th>Transport</th>
										<th>Net Total with Trans ex VAT</th>
										<th>Total inc Trans & VAT</th>
										<th>Transport Rate/Unit</th>										
										<th>Total Rate/Unit</th>										
										<th>Reason for Win/Lose</th>
										<th>Edit</th>		
										<th>Delete</th>					
			    					</tr>
			    				</thead>
			    				<tbody>

						";
				$grand_total = 0;
				$netincvat = 0;
				$net_total1 = 0;
				$lid = $_GET['cusid'];
				$ooid = $_GET['oppid'];
				$oppitemstatus;
				$total_inc_v = 0;

				while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) 
				{
					$oppitemid = $row['OPP_ITEM'];

					$oppid = $row['OPPORTUNITY_ID'];
					$price_list1 = (isset($row['PRICE_LIST_NAME']) != '' ? $row['PRICE_LIST_NAME'] : null);
					$pro_name1 = (isset($row['PRODUCT_ID']) != '' ? $row['PRODUCT_NAME'] : null);
					$std_price1 = (isset($row['STD_PRICE']) != '' ? $row['STD_PRICE'] : null);
			    	$qty1 = (isset($row['QUANTITY']) != '' ? $row['QUANTITY'] : null);
			    	$total1 = (isset($row['TOTAL']) != '' ? $row['TOTAL'] : null);
			    	$total_after1 = (isset($row['TOTAL_AFTER_DIS']) != '' ? $row['TOTAL_AFTER_DIS'] : null);
			    	$discounttype1	= (isset($row['DISCOUNT_TYPE']) != '' ? $row['DISCOUNT_TYPE'] : null);
			    	$discount1 = (isset($row['DISCOUNT']) != '' ? $row['DISCOUNT'] : null);
			    	$opp_stat = (isset($row['OPPORTUNITY_STATUS']) != '' ? $row['OPPORTUNITY_STATUS'] : null);
			    	$opp_stat2 = (isset($row['OPP_STATUS']) != '' ? $row['OPP_STATUS'] : null);
			    	$reason = (isset($row['REASON']) != '' ? $row['REASON'] : null);
			    	$remaining_qty = (isset($row['REMAINING_QTY']) != '' ? $row['REMAINING_QTY'] : null);
			    	$next_date = (isset($row['NEXT_DE_DATE']) != '' ? $row['NEXT_DE_DATE'] : null);
			    	$trans_cost = (isset($row['TRANSPORT_COST']) != '' ? $row['TRANSPORT_COST'] : null);

			    	$total_with_trans = (isset($row['TOTAL_TRANS']) != '' ? $row['TOTAL_TRANS'] : null);
			    	$total_inc_vat = (isset($row['TOTAL_TRANS_VAT']) != '' ? $row['TOTAL_TRANS_VAT'] : null);
			    	$unit_rate = (isset($row['UNIT_RATE']) != '' ? $row['UNIT_RATE'] : null);
			    	$trans_rate = (isset($row['TRANS_RATE']) != '' ? $row['TRANS_RATE'] : null);
			    	$total_rate = (isset($row['TOTAL_RATE']) != '' ? $row['TOTAL_RATE'] : null);


			    	$grand_total = $grand_total + $total1;
			    	$net_total1 = $net_total1 + $total_after1;
 					$discnt;
			    	$dt = "";
					$total_inc_v = $total_after1 * 1.15;

			    	if($discounttype1 == 1)
			    	{
			    		$dt = "Fixed";
			    		$discnt = number_format($discount1, 2);
			    	}
			    	else if($discounttype1 == 2)
			    	{
			    		$dt = "Percent";
			    		$discnt = $discount1 . "%";
			    	}
			    	else
			    	{
			    		$dt = "N/A";
			    		$discnt = "N/A";
			    	}

					if($opp_stat2 == 1)
					{
						$oppitemstatus = "Won";
					}
					else if($opp_stat2 == 2)
					{
						$oppitemstatus = "Lost";
					}
					else if($opp_stat2 == 3)
					{
						$oppitemstatus = "Others";
					}
					else
					{
						$oppitemstatus = "In Progress";
					}

					

			    	echo "

			    		<tr>

			    			<td>" . $oppitemstatus . "</td>

			    			<td style='text-align: center;'><button class='btn btn-default fontawesomeicon' onclick='close_opportunity($oppitemid);'><i class='fa fa-times fa-2x' aria-hidden='true'></i></button></td>
		    				

		    				";

						if($opp_stat2 == 1)
						{
							
						 echo "	<td style='text-align: center;'><button class='btn btn-default fontawesomeicon' onclick='create_order(" .$oppitemid . ");'><i class='fa fa-file-text-o fa-2x' aria-hidden='true'></i></button></td>	
						 ";
						
						}
						else
						{
						 echo " <td style='text-align: center;'></td>";
						}

						echo "
			    			
			    			<td>" . $pro_name1 . "</td>
			    			<td>" . number_format($unit_rate, 2) . "</td>			    			
			    			<td>" . $qty1 . "</td>
			    			<td>" . $remaining_qty . "</td>
			    			<td>" . $next_date . "</td>
			    			<td>" . number_format($total_after1, 2) . "</td>												
							<td>" . $trans_cost . "</td>

							<td>" .  number_format($total_with_trans, 2) ."</td>	
							<td>" .  number_format($total_inc_vat, 2) ."</td>	
							<td>" .  number_format($trans_rate, 2) ."</td>	
							<td>" .  number_format($total_rate, 2) ."</td>	

							<td>" . $reason . "</td>";
		
		    				if($opp_stat2 == 1)
							{
								
							 	echo "
							 		<td style='text-align: center;'><a href='' onclick='#'><i class='fa fa-pencil fa-2x' aria-hidden='true'></i></a></td>
							 	
							 		<td style='text-align: center;'><a href='' onclick='displaydeleteopp();'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td>
							 	
							 ";
							
							}
							else
							{
								 echo "
								 	<td style='text-align: center;'><a href='' onclick='#'><i class='fa fa-pencil fa-2x' aria-hidden='true'></i></a></td>
								 <td style='text-align: center;'><a href='fn/delete_opp_item_cus.php?oppitm=$oppitemid&cusid=$lid&oppid=$ooid'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td>
								 	
								 ";
							}

			    		echo "</tr>
			    	";


			    	 
				}

				$netincvat = $net_total1 * 1.15;
				echo "

			    				</tbody>
			    			</table>
			    		</div>
			    		


			    	";

			    	echo "
			    	<br />
			    	<div class='table-responsive'>
			    			<table class='table table-striped' id='tbl_oppor'>

			    				<thead>
			    					<tr>
																	
									<th>Grand Total</th>
									<th>Total After Discount</th>
									<th>Net amount Inc. Vat</th>
								</tr>
							</thead>
							<tbody>	
								<tr>
								<td style>" . number_format($grand_total, 2) . "</td>
								<td>" . number_format($net_total1, 2) . "</td>
								<td style='font-weight: bold;'>" . number_format($netincvat, 2) . "</td>
								</tr>
							</tbody>
						</table>
					</div>
				";


			    	oci_close($conn);

	?>

	

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#price_list').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a product',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#pro_opp').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a product',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#shippin_opp').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a shipping address',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#txtLocation').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a location',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });	        
	    });
	</script>
	
	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#txtRegion').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a location',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#payment_terms').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#freight_terms').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#freight_terms2').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#freight_terms3').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#freight_terms4').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#freight_terms5').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#price_list2').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#price_list3').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#price_list4').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        $('#price_list5').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a price list',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });
	        
	    });
	</script>


	<script>

		$('#price_list').change(function(){
		var package = $(this).val();
		populateProduct(package);
		populateOrderType(package);
	});
	</script>

	<script>

		$('#price_list2').change(function(){
		var package = $(this).val();
		populateProduct2(package);
		populateOrderType2(package);

	});
	</script>

	<script>

		$('#price_list3').change(function(){
		var package = $(this).val();
		populateProduct3(package);
		populateOrderType3(package);

	});
	</script>


	<script>

		$('#price_list4').change(function(){
		var package = $(this).val();
		populateProduct4(package);
		populateOrderType4(package);

	});
	</script>


	<script>

		$('#price_list5').change(function(){
		var package = $(this).val();
		populateProduct5(package);
		populateOrderType5(package);

	});
	</script>

	<script>
		function populateProduct(package)
		{
			

			$.ajax({
		   type:'POST',
		   data:{package:package},
		   url:'fn/get_pro.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#product").empty();
                $("#product").append(data);

             	$('#product').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose a product',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>

	<script>
		function populateProduct2(package)
		{
			

			$.ajax
			({
			   	type:'POST',
			   	data:{package:package},
			   	url:'fn/get_pro.php',
			   	success:function(data)
			   	{
			   	
			   	    if (data != null) 
			   	    {
			
		                $("#product2").empty();
		                $("#product2").append(data);

		             	$('#product2').multiselect
		             	
		             	({
				        	disableIfEmpty: true,
				        	nonSelectedText: 'Choose a product',
				        	numberDisplayed: 1,
				        	nSelectedText: 'Selected',
				        	allSelectedText: 'All Selected',
				        	includeSelectAllOption: true,
				        	enableFiltering: true,
				        	enableCaseInsensitiveFiltering: true
		        		});
	            	}			   			 
				} //success
			});

		}

	</script>

	<script>
		function populateProduct3(package)
		{
			

			$.ajax
			({
			   	type:'POST',
			   	data:{package:package},
			   	url:'fn/get_pro.php',
			   	success:function(data)
			   	{
			   	
			   	    if (data != null) 
			   	    {
			
		                $("#product3").empty();
		                $("#product3").append(data);

		             	$('#product3').multiselect
		             	
		             	({
				        	disableIfEmpty: true,
				        	nonSelectedText: 'Choose a product',
				        	numberDisplayed: 1,
				        	nSelectedText: 'Selected',
				        	allSelectedText: 'All Selected',
				        	includeSelectAllOption: true,
				        	enableFiltering: true,
				        	enableCaseInsensitiveFiltering: true
		        		});
	            	}			   			 
				} //success
			});

		}

	</script>

	<script>
		function populateProduct4(package)
		{
			

			$.ajax
			({
			   	type:'POST',
			   	data:{package:package},
			   	url:'fn/get_pro.php',
			   	success:function(data)
			   	{
			   	
			   	    if (data != null) 
			   	    {
			
		                $("#product4").empty();
		                $("#product4").append(data);

		             	$('#product4').multiselect
		             	
		             	({
				        	disableIfEmpty: true,
				        	nonSelectedText: 'Choose a product',
				        	numberDisplayed: 1,
				        	nSelectedText: 'Selected',
				        	allSelectedText: 'All Selected',
				        	includeSelectAllOption: true,
				        	enableFiltering: true,
				        	enableCaseInsensitiveFiltering: true
		        		});
	            	}			   			 
				} //success
			});

		}

	</script>

	<script>
		function populateProduct5(package)
		{
			

			$.ajax
			({
			   	type:'POST',
			   	data:{package:package},
			   	url:'fn/get_pro.php',
			   	success:function(data)
			   	{
			   	
			   	    if (data != null) 
			   	    {
			
		                $("#product5").empty();
		                $("#product5").append(data);

		             	$('#product5').multiselect
		             	
		             	({
				        	disableIfEmpty: true,
				        	nonSelectedText: 'Choose a product',
				        	numberDisplayed: 1,
				        	nSelectedText: 'Selected',
				        	allSelectedText: 'All Selected',
				        	includeSelectAllOption: true,
				        	enableFiltering: true,
				        	enableCaseInsensitiveFiltering: true
		        		});
	            	}			   			 
				} //success
			});

		}

	</script>


	<script>
		function populateOrderType(pricelist)
		{
			//alert(pricelist);

			$.ajax({
		   type:'POST',
		   data:{pricelist:pricelist},
		   url:'fn/get_order_type.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#order_type").empty();
                $("#order_type").append(data);

             	$('#order_type').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose an order type',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>

	<script>
		function populateOrderType2(pricelist)
		{
			//alert(pricelist);

			$.ajax({
		   type:'POST',
		   data:{pricelist:pricelist},
		   url:'fn/get_order_type.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#order_type2").empty();
                $("#order_type2").append(data);

             	$('#order_type2').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose an order type',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>
	
	<script>
		function populateOrderType3(pricelist)
		{
			//alert(pricelist);

			$.ajax({
		   type:'POST',
		   data:{pricelist:pricelist},
		   url:'fn/get_order_type.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#order_type3").empty();
                $("#order_type3").append(data);

             	$('#order_type3').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose an order type',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>

	<script>
		function populateOrderType4(pricelist)
		{
			//alert(pricelist);

			$.ajax({
		   type:'POST',
		   data:{pricelist:pricelist},
		   url:'fn/get_order_type.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#order_type4").empty();
                $("#order_type4").append(data);

             	$('#order_type4').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose an order type',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>

	<script>
		function populateOrderType5(pricelist)
		{
			//alert(pricelist);

			$.ajax({
		   type:'POST',
		   data:{pricelist:pricelist},
		   url:'fn/get_order_type.php',
		   success:function(data){
		   	//alert(data);
		   	    if (data != null) {

                
				$("#order_type5").empty();
                $("#order_type5").append(data);

             	$('#order_type5').multiselect({
	        	disableIfEmpty: true,
	        	nonSelectedText: 'Choose an order type',
	        	numberDisplayed: 1,
	        	nSelectedText: 'Selected',
	        	allSelectedText: 'All Selected',
	        	includeSelectAllOption: true,
	        	enableFiltering: true,
	        	enableCaseInsensitiveFiltering: true
	        });


             	

            }
		   			


		   			 
				} //success
			});

		}

	</script>

	<script>

		$('#product').change(function(){
		var package = $(this).val();
		var pl = $("#price_list").val();
		var uom = getUOM(package);
		
		$.ajax({
		   type:'POST',
		   data:{package:package, pl: pl},
		   url:'fn/get_cost.php',
		   success:function(data){
		   		var d  = $.trim(data);

		       	$('#std_price').val(d);  
		       	$('#uom').val(uom);
			}
			});

	});
	</script>

	<script>

		$('#product2').change(function(){
		var package = $(this).val();
		var pl = $("#price_list2").val();
		
		var uom = getUOM(package);
		//alert(bu);

		
		$.ajax({
		   type:'POST',
		   data:{package:package, pl: pl},
		   url:'fn/get_cost.php',
		   success:function(data){
		   		var d  = $.trim(data);
		       	$('#std_price2').val(d);  
		       	$('#uom2').val(uom);

			}
			});

	});
	</script>
	
	<script>

		$('#product3').change(function(){
		var package = $(this).val();
		var pl = $("#price_list3").val();
	

		var uom = getUOM(package);
		//alert(bu);

		
		$.ajax({
		   type:'POST',
		   data:{package:package, pl: pl},
		   url:'fn/get_cost.php',
		   success:function(data){
		   		var d  = $.trim(data);
		       	$('#std_price3').val(d);  
		       	$('#uom3').val(uom);
			}
			});

	});
	</script>

	<script>

		$('#product4').change(function(){
		var package = $(this).val();
		var pl = $("#price_list4").val();
		

		var uom = getUOM(package);
		//alert(bu);

	
		$.ajax({
		   type:'POST',
		   data:{package:package, pl: pl},
		   url:'fn/get_cost.php',
		   success:function(data){
		   		var d  = $.trim(data);
		       $('#std_price4').val(d);  
		       		$('#uom4').val(uom);
			}
			});

	});
	</script>

	<script>

		$('#product5').change(function(){
		var package = $(this).val();
		var pl = $("#price_list5").val();
		
		var uom = getUOM(package);
		//alert(bu);

		
		
		$.ajax({
		   type:'POST',
		   data:{package:package, pl: pl},
		   url:'fn/get_cost.php',
		   success:function(data){
		   		var d  = $.trim(data);
		       $('#std_price5').val(d);  
		       	$('#uom5').val(uom);

			}
			});

	});
	</script>

	<script>
		function getUOM(package)
		{
			var uom = 0;
			$.ajax({
			   type:'POST',
			   data:{package:package},
			   url:'fn/get_pro_uom.php',
			   async: false,
			   success:function(data){
				   		
				        
				        uom = $.trim(data);

					}
				});

			return uom;
		}
	</script>

	
	<script>
		function getProductBU(package)
		{
			var bu = 0;
			$.ajax({
			   type:'POST',
			   data:{package:package},
			   url:'fn/get_pro_bu.php',
			   async: false,
			   success:function(data){
				   		
				        
				        bu = $.trim(data);

					}
				});

			return bu;
		}
	</script>
	
	<script>
		$(document).ready(function()
		{
		    $('#qty').change(function()
		    {
		    	var item = $("#product").val();
		       	var std_price = $("#std_price").val();
		      	var qty = $("#qty").val();
		      	var bu = getProductBU(item);
		      	
		      	var total = std_price * qty;
		      

		      	$('#total').val(total);
				$('#nettotal').val(total);

				if(bu == 50)
				{
					$("#freight_terms").multiselect("disable");
					$("#calc_transport_cost").attr("disabled", "disabled"); 
					$("#calc_total_with_trans").attr("disabled", "disabled"); 
					$("#calc_trans_rate").attr("disabled", "disabled"); 
					$("#calc_transport_cost").val("0");
		      		$("#calc_trans_rate").val("0");	
		      		var total_trans_vat = total * 1.15;
					var rate_ex_trans = total / qty;
					var total_rate = total / qty;
					var a = $.number(total_trans_vat, 2 );
					var b = $.number(rate_ex_trans, 2 );
					var c = $.number(total_rate, 2 );
					$("#calc_total_with_trans").val(total);
					$("#calc_tot_inc_trans_vat").val(a);
					$("#calc_unit_rate_ex_trans_vat").val(b);				      	
					$("#calc_total_rate").val(c);	
				}

			
			}); 
		});

	</script>

	<script>
		$(document).ready(function(){
		    $('#qty2').change(function(){
		    	var item = $("#product2").val();
		       var std_price = $("#std_price2").val();
		      	var qty = $("#qty2").val();
		      	var bu = getProductBU(item);
		      	var total = std_price * qty;
		      	$('#total2').val(total);
				$('#nettotal2').val(total);

				if(bu == 50)
				{
					$("#freight_terms2").multiselect("disable");
					$("#calc_transport_cost2").attr("disabled", "disabled"); 
					$("#calc_total_with_trans2").attr("disabled", "disabled"); 
					$("#calc_trans_rate2").attr("disabled", "disabled"); 
					$("#calc_transport_cost2").val("0");
		      		$("#calc_trans_rate2").val("0");	
		      		var total_trans_vat = total * 1.15;
					var rate_ex_trans = total / qty;
					var total_rate = total / qty;
					var a = $.number(total_trans_vat, 2 );
					var b = $.number(rate_ex_trans, 2 );
					var c = $.number(total_rate, 2 );
					$("#calc_total_with_trans2").val(total);
					$("#calc_tot_inc_trans_vat2").val(a);
					$("#calc_unit_rate_ex_trans_vat2").val(b);				      	
					$("#calc_total_rate2").val(c);	
				}

			}); 
		});
	</script>

	<script>
		$(document).ready(function(){
		    $('#qty3').change(function(){
		    	var item = $("#product3").val();
		       var std_price = $("#std_price3").val();
		      	var qty = $("#qty3").val();
				var bu = getProductBU(item);
		      	var total = std_price * qty;
		      	$('#total3').val(total);
			$('#nettotal3').val(total);


				if(bu == 50)
				{
					$("#freight_terms3").multiselect("disable");
					$("#calc_transport_cost3").attr("disabled", "disabled"); 
					$("#calc_total_with_trans3").attr("disabled", "disabled"); 
					$("#calc_trans_rate3").attr("disabled", "disabled"); 
					$("#calc_transport_cost3").val("0");
		      		$("#calc_trans_rate3").val("0");	
		      		var total_trans_vat = total * 1.15;
					var rate_ex_trans = total / qty;
					var total_rate = total / qty;
					var a = $.number(total_trans_vat, 2 );
					var b = $.number(rate_ex_trans, 2 );
					var c = $.number(total_rate, 2 );
					$("#calc_total_with_trans3").val(total);
					$("#calc_tot_inc_trans_vat3").val(a);
					$("#calc_unit_rate_ex_trans_vat3").val(b);				      	
					$("#calc_total_rate3").val(c);	
				}

			}); 
		});
	</script>

	<script>
		$(document).ready(function(){
		    $('#qty4').change(function(){
		    	var item = $("#product4").val();
		       var std_price = $("#std_price4").val();
		      	var qty = $("#qty4").val();
		      	var bu = getProductBU(item);
		      	var total = std_price * qty;
		      	$('#total4').val(total);
			$('#nettotal4').val(total);
				if(bu == 50)
				{
					$("#freight_terms4").multiselect("disable");
					$("#calc_transport_cost4").attr("disabled", "disabled"); 
					$("#calc_total_with_trans4").attr("disabled", "disabled"); 
					$("#calc_trans_rate4").attr("disabled", "disabled"); 
					$("#calc_transport_cost4").val("0");
		      		$("#calc_trans_rate4").val("0");	
		      		var total_trans_vat = total * 1.15;
					var rate_ex_trans = total / qty;
					var total_rate = total / qty;
					var a = $.number(total_trans_vat, 2 );
					var b = $.number(rate_ex_trans, 2 );
					var c = $.number(total_rate, 2 );
					$("#calc_total_with_trans4").val(total);
					$("#calc_tot_inc_trans_vat4").val(a);
					$("#calc_unit_rate_ex_trans_vat4").val(b);				      	
					$("#calc_total_rate4").val(c);	
				}

			}); 
		});
	</script>

	<script>
		$(document).ready(function(){
		    $('#qty5').change(function(){
		    	var item = $("#product5").val();
		       var std_price = $("#std_price5").val();
		      	var qty = $("#qty5").val();
		      		var bu = getProductBU(item);
		      	var total = std_price * qty;
		      	$('#total5').val(total);
				$('#nettotal5').val(total);

				if(bu == 50)
				{
					$("#freight_terms5").multiselect("disable");
					$("#calc_transport_cost5").attr("disabled", "disabled"); 
					$("#calc_total_with_trans5").attr("disabled", "disabled"); 
					$("#calc_trans_rate5").attr("disabled", "disabled"); 
					$("#calc_transport_cost5").val("0");
		      		$("#calc_trans_rate5").val("0");	
		      		var total_trans_vat = total * 1.15;
					var rate_ex_trans = total / qty;
					var total_rate = total / qty;
					var a = $.number(total_trans_vat, 2 );
					var b = $.number(rate_ex_trans, 2 );
					var c = $.number(total_rate, 2 );
					$("#calc_total_with_trans5").val(total);
					$("#calc_tot_inc_trans_vat5").val(a);
					$("#calc_unit_rate_ex_trans_vat5").val(b);				      	
					$("#calc_total_rate5").val(c);	
				}

			}); 
		});
	</script>

	<script>
		function GetMaxDiscount()
		{
			var p = $("#product").val();			
			var d = 0;
			var di = 0;
			var net_total = 0;
			var discountType = $("#dpDiscountType").val();
			$.ajax({
		   		type:'POST',
		   		data:{p:p},
		   		url:'fn/get_max_discount.php',
		   		success:function(data)
		   		{
		   			d  = $.trim(data);
					
		       		if(d.length == 0)
					{
						di = 0;
					}
					else
					{
						di = d;
					}
						
					if(discountType == 2)
		      		{
			      		var discount = $("#discount").val();
						
			      		if(discount< 0 || discount > 100)
			      		{
			      		
			      			alert("Discount must be between 0 and 100 percent.");
			      			var searchInput = $('#discount');
			      			searchInput.focus();
			      		}
						else if (discount > di && di != 0)
						{
							
			      			alert("Maximum discount for this product should be " + di + "%.");
			      			var searchInput = $('#discount');
			      			searchInput.focus();
			      		}

						else
						{
							var total = $("#total").val();
			      			net_total = ((100-discount) * total) / 100;
			       			$('#nettotal').val(net_total); 
						}

		      		}

		      		else if(discountType == 1)
		      		{
		      			var discount = $("#discount").val();
		      			var total = $("#total").val();
			    		net_total = total - discount;
			    		$('#nettotal').val(net_total); 
		      		}


				  	var item = $("#product").val();
		      		var qty_ = $("#qty").val();
		      		var bu = getProductBU(item);
		      		if(bu == 50)
					{
						var total_trans_vat = net_total * 1.15;
					    var rate_ex_trans = net_total / qty_;
					    var total_rate = net_total / qty_;
					    var a = $.number(total_trans_vat, 2 );
					    var b = $.number(rate_ex_trans, 2 );
					    var c = $.number(total_rate, 2 );
					    $("#calc_total_with_trans").val(net_total);
					    $("#calc_tot_inc_trans_vat").val(a);
					    $("#calc_unit_rate_ex_trans_vat").val(b);				      	
					    $("#calc_total_rate").val(c);	
					}
				   
				}
			});
		}
	</script>

	<script>
		function GetMaxDiscount2()
		{
			var p = $("#product2").val();			
			var d;
			var di;
			var discountType = $("#dpDiscountType2").val();
			$.ajax({
		   		type:'POST',
		   		data:{p:p},
		   		url:'fn/get_max_discount.php',
		   		success:function(data){
		   			d  = $.trim(data);
					
		       			if(d.length == 0)
					{	di = 0;
					}
					else
					{
						di = d;
					}
						
					if(discountType == 2)
		      			{
			      			var discount = $("#discount2").val();
						
			      			if(discount< 0 || discount > 100)
			      			{
			      				alert("Discount must be between 0 and 100 percent.");
			      				var searchInput = $('#discount2');
			      				searchInput.focus();
			      			}
						else if (discount > di && di != 0)
						{
							
			      				alert("Maximum discount for this product should be " + di + "%.");
			      				var searchInput = $('#discount2');
			      				searchInput.focus();
			      			}

						else
						{

			      				var total = $("#total2").val();
			      				var net_total = ((100-discount) * total) / 100;
			       				$('#nettotal2').val(net_total); 
						}

		      			}
		      			else if(discountType == 1)
		      			{
		      				var discount = $("#discount2").val();
		      				var total = $("#total2").val();
			    			var net_total = total - discount;
			    			$('#nettotal2').val(net_total); 
		      			}

		      			var item = $("#product2").val();
		      			var qty_ = $("#qty2").val();
		      
		      		var bu = getProductBU(item);
		      		if(bu == 50)
					{
						var total_trans_vat = net_total * 1.15;
					    var rate_ex_trans = net_total / qty_;
					    var total_rate = net_total / qty_;
					    var a = $.number(total_trans_vat, 2 );
					    var b = $.number(rate_ex_trans, 2 );
					    var c = $.number(total_rate, 2 );
					    $("#calc_total_with_trans2").val(net_total);
					    $("#calc_tot_inc_trans_vat2").val(a);
					    $("#calc_unit_rate_ex_trans_vat2").val(b);				      	
					    $("#calc_total_rate2").val(c);	
					}
				   
				}
			});
		}
	</script>

	<script>
		function GetMaxDiscount3()
		{
			var p = $("#product3").val();			
			var d;
			var di;
			var discountType = $("#dpDiscountType3").val();
			$.ajax({
		   		type:'POST',
		   		data:{p:p},
		   		url:'fn/get_max_discount.php',
		   		success:function(data){
		   			d  = $.trim(data);
					
		       			if(d.length == 0)
					{	di = 0;
					}
					else
					{
						di = d;
					}
						
					if(discountType == 2)
		      			{
			      			var discount = $("#discount3").val();
						
			      			if(discount< 0 || discount > 100)
			      			{
			      				alert("Discount must be between 0 and 100 percent.");
			      				var searchInput = $('#discount3');
			      				searchInput.focus();
			      			}
						else if (discount > di && di != 0)
						{
							
			      				alert("Maximum discount for this product should be " + di + "%.");
			      				var searchInput = $('#discount3');
			      				searchInput.focus();
			      			}

						else
						{

			      				var total = $("#total3").val();
			      				var net_total = ((100-discount) * total) / 100;
			       				$('#nettotal3').val(net_total); 
						}

		      			}
		      			else if(discountType == 1)
		      			{
		      				var discount = $("#discount3").val();
		      				var total = $("#total3").val();
			    			var net_total = total - discount;
			    			$('#nettotal3').val(net_total); 
		      			}

		      			var item = $("#product3").val();
		      			var qty_ = $("#qty3").val();
		      
		      		var bu = getProductBU(item);
		      		if(bu == 50)
					{
						var total_trans_vat = net_total * 1.15;
					    var rate_ex_trans = net_total / qty_;
					    var total_rate = net_total / qty_;
					    var a = $.number(total_trans_vat, 2 );
					    var b = $.number(rate_ex_trans, 2 );
					    var c = $.number(total_rate, 2 );
					    $("#calc_total_with_trans3").val(net_total);
					    $("#calc_tot_inc_trans_vat3").val(a);
					    $("#calc_unit_rate_ex_trans_vat3").val(b);				      	
					    $("#calc_total_rate3").val(c);	
					}
				   
				}
			});
		}
	</script>

	<script>
		function GetMaxDiscount4()
		{
			var p = $("#product4").val();			
			var d;
			var di;
			var discountType = $("#dpDiscountType4").val();
			$.ajax({
		   		type:'POST',
		   		data:{p:p},
		   		url:'fn/get_max_discount.php',
		   		success:function(data){
		   			d  = $.trim(data);
					
		       			if(d.length == 0)
					{	di = 0;
					}
					else
					{
						di = d;
					}
						
					if(discountType == 2)
		      			{
			      			var discount = $("#discount4").val();
						
			      			if(discount< 0 || discount > 100)
			      			{
			      				alert("Discount must be between 0 and 100 percent.");
			      				var searchInput = $('#discount4');
			      				searchInput.focus();
			      			}
						else if (discount > di && di != 0)
						{
							
			      				alert("Maximum discount for this product should be " + di + "%.");
			      				var searchInput = $('#discount4');
			      				searchInput.focus();
			      			}

						else
						{

			      				var total = $("#total4").val();
			      				var net_total = ((100-discount) * total) / 100;
			       				$('#nettotal4').val(net_total); 
						}

		      			}
		      			else if(discountType == 1)
		      			{
		      				var discount = $("#discount4").val();
		      				var total = $("#total4").val();
			    			var net_total = total - discount;
			    			$('#nettotal4').val(net_total); 
		      			}

		      			var item = $("#product4").val();
		      			var qty_ = $("#qty4").val();
		      
		      		var bu = getProductBU(item);
		      		if(bu == 50)
					{
						var total_trans_vat = net_total * 1.15;
					    var rate_ex_trans = net_total / qty_;
					    var total_rate = net_total / qty_;
					    var a = $.number(total_trans_vat, 2 );
					    var b = $.number(rate_ex_trans, 2 );
					    var c = $.number(total_rate, 2 );
					    $("#calc_total_with_trans4").val(net_total);
					    $("#calc_tot_inc_trans_vat4").val(a);
					    $("#calc_unit_rate_ex_trans_vat4").val(b);				      	
					    $("#calc_total_rate4").val(c);	
					}
				   
				}
			});
		}
	</script>

	<script>
		function GetMaxDiscount5()
		{
			var p = $("#product5").val();			
			var d;
			var di;
			var discountType = $("#dpDiscountType5").val();
			$.ajax({
		   		type:'POST',
		   		data:{p:p},
		   		url:'fn/get_max_discount.php',
		   		success:function(data){
		   			d  = $.trim(data);
					
		       			if(d.length == 0)
					{	di = 0;
					}
					else
					{
						di = d;
					}
						
					if(discountType == 2)
		      			{
			      			var discount = $("#discount5").val();
						
			      			if(discount< 0 || discount > 100)
			      			{
			      				alert("Discount must be between 0 and 100 percent.");
			      				var searchInput = $('#discount5');
			      				searchInput.focus();
			      			}
						else if (discount > di && di != 0)
						{
							
			      				alert("Maximum discount for this product should be " + di + "%.");
			      				var searchInput = $('#discount5');
			      				searchInput.focus();
			      			}

						else
						{

			      				var total = $("#total5").val();
			      				var net_total = ((100-discount) * total) / 100;
			       				$('#nettotal5').val(net_total); 
						}

		      			}
		      			else if(discountType == 1)
		      			{
		      				var discount = $("#discount5").val();
		      				var total = $("#total5").val();
			    			var net_total = total - discount;
			    			$('#nettotal5').val(net_total); 
		      			}

		      			var item = $("#product5").val();
		      			var qty_ = $("#qty5").val();
		      		var bu = getProductBU(item);
		      		if(bu == 50)
					{
						var total_trans_vat = net_total * 1.15;
					    var rate_ex_trans = net_total / qty_;
					    var total_rate = net_total / qty_;
					    var a = $.number(total_trans_vat, 2 );
					    var b = $.number(rate_ex_trans, 2 );
					    var c = $.number(total_rate, 2 );
					    $("#calc_total_with_trans5").val(net_total);
					    $("#calc_tot_inc_trans_vat5").val(a);
					    $("#calc_unit_rate_ex_trans_vat5").val(b);				      	
					    $("#calc_total_rate5").val(c);	
					}
				   
				}
			});
		}
	</script>

	<script>
		function GetTransportCostVelo()
		{
			var freight_terms = $("#freight_terms").val();	
			var uom = $("#uom").val();	
			var qty = 0;	
			if(freight_terms == "Own Lorry")
			{
				//alert("own lorry");
			}
			else
			{
				var qty_ = $("#qty").val();	
				//alert(uom);	
				if(uom == "Tonne")
				{
					qty = qty_ * 1000;
				}
				else
				{
					qty = qty_;
				}
				//alert("charge to cus");
				var item = $("#product").val();				
				
				var customer = $("#hdCusID").val();				
				var ordertype = $("#order_type").val();
				var outlet = getOutletid(ordertype);				
				var region = $("#hdShiRegionID").val();				
				var site = $("#hdShipToId").val();
				var sub_total_with_dis = $("#total").val();
				var net_wit_trans = 0;
				var total_trans_vat = 0;
				var rate_ex_trans = 0;
				var trans_rate = 0;
				var total_rate = 0;
				var trans = 0;
				//alert(qty);
				$.ajax({
		   		type:'POST',
		   		data:{outlet:outlet, customer: customer, site: site, item: item, qty: qty, region: region},
		   		url:'fn/get_trans_cost.php',
		   		success:function(data){
		   				//alert(data);
		   				trans = data;
		      			$("#calc_transport_cost").val(trans);
		      			
		      			net_wit_trans = (parseFloat(sub_total_with_dis) + parseFloat(trans)).toFixed(1);
		      			total_trans_vat = net_wit_trans * 1.15;
		      			rate_ex_trans = sub_total_with_dis / qty_;
		      			trans_rate = trans / qty_;
		      			total_rate = net_wit_trans / qty_;

		      			$("#calc_total_with_trans").val(net_wit_trans);
		      			$("#calc_tot_inc_trans_vat").val(total_trans_vat);
		      			$("#calc_unit_rate_ex_trans_vat").val(rate_ex_trans);
		      			$("#calc_trans_rate").val(trans_rate);
		      			$("#calc_total_rate").val(total_rate);
					}
				});

			}
			
			
		}
	</script>

	<script>
		function GetTransportCostVelo2()
		{
			var freight_terms = $("#freight_terms2").val();		
			var uom = $("#uom2").val();	
				
			if(freight_terms == "Own Lorry")
			{
				//alert("own lorry");
			}
			else
			{
				var qty = 0;	
				var qty_ = $("#qty2").val();	
				
				if(uom == "Tonne")
				{
					qty = qty_ * 1000;
				}
				else
				{
					qty = qty_;
				}
				//alert("charge to cus");
				var item = $("#product2").val();				
				//var qty = $("#qty2").val();			
				var customer = $("#hdCusID").val();				
				var ordertype = $("#order_type2").val();
				var outlet = getOutletid(ordertype);				
				var region = $("#hdShiRegionID").val();				
				var site = $("#hdShipToId").val();
				var sub_total_with_dis = $("#total2").val();
				var net_wit_trans = 0;
				var total_trans_vat = 0;
				var rate_ex_trans = 0;
				var trans_rate = 0;
				var total_rate = 0;
				var trans = 0;
				
				$.ajax({
		   		type:'POST',
		   		data:{outlet:outlet, customer: customer, site: site, item: item, qty: qty, region: region},
		   		url:'fn/get_trans_cost.php',
		   		success:function(data){
		   				
		   				trans = data;
		      			$("#calc_transport_cost2").val(trans);
		      			
		      			net_wit_trans = (parseFloat(sub_total_with_dis) + parseFloat(trans)).toFixed(1);
		      			total_trans_vat = net_wit_trans * 1.15;
		      			rate_ex_trans = sub_total_with_dis / qty_;
		      			trans_rate = trans / qty_;
		      			total_rate = net_wit_trans / qty_;

		      			$("#calc_total_with_trans2").val(net_wit_trans);
		      			$("#calc_tot_inc_trans_vat2").val(total_trans_vat);
		      			$("#calc_unit_rate_ex_trans_vat2").val(rate_ex_trans);
		      			$("#calc_trans_rate2").val(trans_rate);
		      			$("#calc_total_rate2").val(total_rate);
					}
				});

			}
			
			
		}
	</script>

	<script>
		function GetTransportCostVelo3()
		{
			var freight_terms = $("#freight_terms3").val();		
			var uom = $("#uom3").val();	
			var qty = 0;		
			if(freight_terms == "Own Lorry")
			{
				//alert("own lorry");
			}
			else
			{
				var qty_ = $("#qty3").val();	
				//alert(uom);	
				if(uom == "Tonne")
				{
					qty = qty_ * 1000;
				}
				else
				{
					qty = qty_;
				}
				//alert("charge to cus");
				var item = $("#product3").val();				
				//var qty = $("#qty3").val();			
				var customer = $("#hdCusID").val();				
				var ordertype = $("#order_type3").val();
				var outlet = getOutletid(ordertype);				
				var region = $("#hdShiRegionID").val();				
				var site = $("#hdShipToId").val();
				var sub_total_with_dis = $("#total3").val();
				var net_wit_trans = 0;
				var total_trans_vat = 0;
				var rate_ex_trans = 0;
				var trans_rate = 0;
				var total_rate = 0;
				var trans = 0;

				$.ajax({
		   		type:'POST',
		   		data:{outlet:outlet, customer: customer, site: site, item: item, qty: qty, region: region},
		   		url:'fn/get_trans_cost.php',
		   		success:function(data){
		   				//alert(data);
		   				trans = data;
		      			$("#calc_transport_cost3").val(trans);
		      			
		      			net_wit_trans = (parseFloat(sub_total_with_dis) + parseFloat(trans)).toFixed(1);
		      			total_trans_vat = net_wit_trans * 1.15;
		      			rate_ex_trans = sub_total_with_dis / qty_;
		      			trans_rate = trans / qty_;
		      			total_rate = net_wit_trans / qty_;

		      			$("#calc_total_with_trans3").val(net_wit_trans);
		      			$("#calc_tot_inc_trans_vat3").val(total_trans_vat);
		      			$("#calc_unit_rate_ex_trans_vat3").val(rate_ex_trans);
		      			$("#calc_trans_rate3").val(trans_rate);
		      			$("#calc_total_rate3").val(total_rate);
					}
				});

			}
			
			
		}
	</script>

	<script>
		function GetTransportCostVelo4()
		{
			var freight_terms = $("#freight_terms4").val();
			var uom = $("#uom4").val();	
			var qty = 0;				
			if(freight_terms == "Own Lorry")
			{
				//alert("own lorry");
			}
			else
			{
				var qty_ = $("#qty4").val();	
				//alert(uom);	
				if(uom == "Tonne")
				{
					qty = qty_ * 1000;
				}
				else
				{
					qty = qty_;
				}
				//alert("charge to cus");
				var item = $("#product4").val();				
				//var qty = $("#qty4").val();			
				var customer = $("#hdCusID").val();				
				var ordertype = $("#order_type4").val();
				var outlet = getOutletid(ordertype);				
				var region = $("#hdShiRegionID").val();				
				var site = $("#hdShipToId").val();
				var sub_total_with_dis = $("#total4").val();
				var net_wit_trans = 0;
				var total_trans_vat = 0;
				var rate_ex_trans = 0;
				var trans_rate = 0;
				var total_rate = 0;
				var trans = 0;

				$.ajax({
		   		type:'POST',
		   		data:{outlet:outlet, customer: customer, site: site, item: item, qty: qty, region: region},
		   		url:'fn/get_trans_cost.php',
		   		success:function(data){
		   				//alert(data);
		   				trans = data;
		      			$("#calc_transport_cost4").val(trans);
		      			
		      			net_wit_trans = (parseFloat(sub_total_with_dis) + parseFloat(trans)).toFixed(1);
		      			total_trans_vat = net_wit_trans * 1.15;
		      			rate_ex_trans = sub_total_with_dis / qty_;
		      			trans_rate = trans / qty_;
		      			total_rate = net_wit_trans / qty_;

		      			$("#calc_total_with_trans4").val(net_wit_trans);
		      			$("#calc_tot_inc_trans_vat4").val(total_trans_vat);
		      			$("#calc_unit_rate_ex_trans_vat4").val(rate_ex_trans);
		      			$("#calc_trans_rate4").val(trans_rate);
		      			$("#calc_total_rate4").val(total_rate);
					}
				});

			}
			
			
		}
	</script>

	<script>
		function GetTransportCostVelo5()
		{
			var freight_terms = $("#freight_terms5").val();		
			var uom = $("#uom5").val();	
			var qty = 0;		
			if(freight_terms == "Own Lorry")
			{
				//alert("own lorry");
			}
			else
			{
				var qty_ = $("#qty5").val();	
				//alert(uom);	
				if(uom == "Tonne")
				{
					qty = qty_ * 1000;
				}
				else
				{
					qty = qty_;
				}
				//alert("charge to cus");
				var item = $("#product5").val();				
				//var qty = $("#qty5").val();			
				var customer = $("#hdCusID").val();				
				var ordertype = $("#order_type5").val();
				var outlet = getOutletid(ordertype);				
				var region = $("#hdShiRegionID").val();				
				var site = $("#hdShipToId").val();
				var sub_total_with_dis = $("#total5").val();
				var net_wit_trans = 0;
				var total_trans_vat = 0;
				var rate_ex_trans = 0;
				var trans_rate = 0;
				var total_rate = 0;
				var trans = 0;

				$.ajax({
		   		type:'POST',
		   		data:{outlet:outlet, customer: customer, site: site, item: item, qty: qty, region: region},
		   		url:'fn/get_trans_cost.php',
		   		success:function(data){
		   				//alert(data);
		   				trans = data;
		      			$("#calc_transport_cost5").val(trans);
		      			
		      			net_wit_trans = (parseFloat(sub_total_with_dis) + parseFloat(trans)).toFixed(1);
		      			total_trans_vat = net_wit_trans * 1.15;
		      			rate_ex_trans = sub_total_with_dis / qty_;
		      			trans_rate = trans / qty_;
		      			total_rate = net_wit_trans / qty_;

		      			$("#calc_total_with_trans5").val(net_wit_trans);
		      			$("#calc_tot_inc_trans_vat5").val(total_trans_vat);
		      			$("#calc_unit_rate_ex_trans_vat5").val(rate_ex_trans);
		      			$("#calc_trans_rate5").val(trans_rate);
		      			$("#calc_total_rate5").val(total_rate);
					}
				});

			}
			
			
		}
	</script>

	<script>
		function getOutletid(order)
		{
			var x = "";
			$.ajax
			({
			   	type:'POST',
			   	data:{order:order},
			   	url:'fn/get_outlet_id.php',
			   	async: false,
			   	success:function(data)
			   	{
			   		//alert(data);
			   	   	x = data;	   			 
				} 
			});

			return x;
        }
	</script>

	<script>

		function create_opportunity()
		{
			var pricelist = $("#price_list").val();
			var product = $("#product").val();
			var price = $("#std_price").val();
			var qty = $("#qty").val();
			var total = $("#total").val();
			var distype = $("#dpDiscountType").val();
			var discount = $("#discount").val();
			var nettotal = $("#nettotal").val();
			var oppid = $("#hdOpid").val();
			var delidate = $("#txtDeliDate").val();
			var ordertype = $("#order_type").val();	
			var freightterms = $("#freight_terms").val();
			var cusid = $("#hdCusID").val();
			var transcost = $("#calc_transport_cost").val();
			var total_trans = $("#calc_total_with_trans").val();
			var total_trans_vat = $("#calc_tot_inc_trans_vat").val();
			var unit_rate = $("#calc_unit_rate_ex_trans_vat").val();
			var trans_rate = $("#calc_trans_rate").val(); 
			var total_rate = $("#calc_total_rate").val(); 
	 		
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid, pricelist :pricelist, product: product, price: price, qty: qty, total: total, 
		   			distype: distype, discount: discount, nettotal: nettotal, delidate: delidate, ordertype: ordertype,
		   			freightterms: freightterms, cusid: cusid, transcost: transcost, total_trans: total_trans, 
		   			total_trans_vat: total_trans_vat, unit_rate: unit_rate, trans_rate: trans_rate, total_rate: total_rate
		   			},
		   		url:'fn/add_opp_item.php',
		   		success:function(data){
					//alert(data);
		   			//open modal
					toastr.success("Opportunity successfully added.");
					$('#update_cons_stage').modal({backdrop: 'static', keyboard: false})  


				}
			});			

		}
	</script>

	

	<script>

		function create_opportunity2()
		{
			var pricelist = $("#price_list2").val();
			var product = $("#product2").val();
			var price = $("#std_price2").val();
			var qty = $("#qty2").val();
			var total = $("#total2").val();
			var distype = $("#dpDiscountType2").val();
			var discount = $("#discount2").val();
			var nettotal = $("#nettotal2").val();
			var oppid = $("#hdOpid").val();
			var delidate = $("#txtDeliDate2").val();
			var ordertype = $("#order_type2").val();	
			var freightterms = $("#freight_terms2").val();
			var cusid = $("#hdCusID").val();
			var transcost = $("#calc_transport_cost2").val();
			var total_trans = $("#calc_total_with_trans2").val();
			var total_trans_vat = $("#calc_tot_inc_trans_vat2").val();
			var unit_rate = $("#calc_unit_rate_ex_trans_vat2").val();
			var trans_rate = $("#calc_trans_rate2").val(); 
			var total_rate = $("#calc_total_rate2").val(); 
	 		

			//alert(oppid);
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid, pricelist :pricelist, product: product, price: price, qty: qty, total: total, 
		   			distype: distype, discount: discount, nettotal: nettotal, delidate: delidate, ordertype: ordertype,
		   			freightterms: freightterms, cusid: cusid, transcost: transcost, total_trans: total_trans, 
		   			total_trans_vat: total_trans_vat, unit_rate: unit_rate, trans_rate: trans_rate, total_rate: total_rate},
		   		url:'fn/add_opp_item.php',
		   		success:function(data){
		   			//alert(data);
					//console.log(data);
		   			//open modal
					toastr.success("Opportunity successfully added.");
					$("#price_list2").append("");
					$("#product2").val("");
					$("#std_price2").val("");
					$("#qty2").val("");
					$("#total2").val("");
					$("#dpDiscountType2").val("");
					$("#discount2").val("");
					$("#nettotal2").val("");


				}
			});			

		}
	</script>


	<script>

		function create_opportunity3()
		{
			var pricelist = $("#price_list3").val();
			var product = $("#product3").val();
			var price = $("#std_price3").val();
			var qty = $("#qty3").val();
			var total = $("#total3").val();
			var distype = $("#dpDiscountType3").val();
			var discount = $("#discount3").val();
			var nettotal = $("#nettotal3").val();
			var oppid = $("#hdOpid").val();
			var delidate = $("#txtDeliDate3").val();
			var ordertype = $("#order_type3").val();	
			var freightterms = $("#freight_terms3").val();
			var cusid = $("#hdCusID").val();
			var transcost = $("#calc_transport_cost3").val();
			var total_trans = $("#calc_total_with_trans3").val();
			var total_trans_vat = $("#calc_tot_inc_trans_vat3").val();
			var unit_rate = $("#calc_unit_rate_ex_trans_vat3").val();
			var trans_rate = $("#calc_trans_rate3").val(); 
			var total_rate = $("#calc_total_rate3").val(); 
			//alert(oppid);
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid, pricelist :pricelist, product: product, price: price, qty: qty, total: total, 
		   			distype: distype, discount: discount, nettotal: nettotal, delidate: delidate, ordertype: ordertype,
		   			freightterms: freightterms, cusid: cusid, transcost: transcost, total_trans: total_trans, 
		   			total_trans_vat: total_trans_vat, unit_rate: unit_rate, trans_rate: trans_rate, total_rate: total_rate},
		   		url:'fn/add_opp_item.php',
		   		success:function(data){
		   			//alert(data);
					//console.log(data);
		   			//open modal
					toastr.success("Opportunity successfully added.");
					$("#price_list3").append("");
					$("#product3").val("");
					$("#std_price3").val("");
					$("#qty3").val("");
					$("#total3").val("");
					$("#dpDiscountType3").val("");
					$("#discount3").val("");
					$("#nettotal3").val("");


				}
			});			

		}
	</script>

	<script>

		function create_opportunity4()
		{
			var pricelist = $("#price_list4").val();
			var product = $("#product4").val();
			var price = $("#std_price4").val();
			var qty = $("#qty4").val();
			var total = $("#total4").val();
			var distype = $("#dpDiscountType4").val();
			var discount = $("#discount4").val();
			var nettotal = $("#nettotal4").val();
			var oppid = $("#hdOpid").val();
			var delidate = $("#txtDeliDate4").val();
			var ordertype = $("#order_type4").val();	
			var freightterms = $("#freight_terms4").val();
			var cusid = $("#hdCusID").val();
			var transcost = $("#calc_transport_cost4").val();
			var total_trans = $("#calc_total_with_trans4").val();
			var total_trans_vat = $("#calc_tot_inc_trans_vat4").val();
			var unit_rate = $("#calc_unit_rate_ex_trans_vat4").val();
			var trans_rate = $("#calc_trans_rate4").val(); 
			var total_rate = $("#calc_total_rate4").val(); 
			
			//alert(oppid);
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid, pricelist :pricelist, product: product, price: price, qty: qty, total: total, 
		   			distype: distype, discount: discount, nettotal: nettotal, delidate: delidate, ordertype: ordertype,
		   			freightterms: freightterms, cusid: cusid, transcost: transcost, total_trans: total_trans, 
		   			total_trans_vat: total_trans_vat, unit_rate: unit_rate, trans_rate: trans_rate, total_rate: total_rate},
		   		url:'fn/add_opp_item.php',
		   		success:function(data){
		   			//alert(data);
					//console.log(data);
		   			//open modal
					toastr.success("Opportunity successfully added.");
					$("#price_list4").append("");
					$("#product4").val("");
					$("#std_price4").val("");
					$("#qty4").val("");
					$("#total4").val("");
					$("#dpDiscountType4").val("");
					$("#discount4").val("");
					$("#nettotal4").val("");


				}
			});			

		}
	</script>

	<script>

		function create_opportunity5()
		{
			var pricelist = $("#price_list5").val();
			var product = $("#product5").val();
			var price = $("#std_price5").val();
			var qty = $("#qty5").val();
			var total = $("#total5").val();
			var distype = $("#dpDiscountType5").val();
			var discount = $("#discount5").val();
			var nettotal = $("#nettotal5").val();
			var oppid = $("#hdOpid").val();
			var delidate = $("#txtDeliDate5").val();
			var ordertype = $("#order_type5").val();	
			var freightterms = $("#freight_terms5").val();
			var cusid = $("#hdCusID").val();
			var transcost = $("#calc_transport_cost5").val();
			var total_trans = $("#calc_total_with_trans5").val();
			var total_trans_vat = $("#calc_tot_inc_trans_vat5").val();
			var unit_rate = $("#calc_unit_rate_ex_trans_vat5").val();
			var trans_rate = $("#calc_trans_rate5").val(); 
			var total_rate = $("#calc_total_rate5").val(); 
			//alert(oppid);
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid, pricelist :pricelist, product: product, price: price, qty: qty, total: total, 
		   			distype: distype, discount: discount, nettotal: nettotal, delidate: delidate, ordertype: ordertype,
		   			freightterms: freightterms, cusid: cusid, transcost: transcost, total_trans: total_trans, 
		   			total_trans_vat: total_trans_vat, unit_rate: unit_rate, trans_rate: trans_rate, total_rate: total_rate},
		   		url:'fn/add_opp_item.php',
		   		success:function(data){
		   			//alert(data);
					//console.log(data);
		   			//open modal
					toastr.success("Opportunity successfully added.");
					$("#price_list5").append("");
					$("#product5").val("");
					$("#std_price5").val("");
					$("#qty5").val("");
					$("#total5").val("");
					$("#dpDiscountType5").val("");
					$("#discount5").val("");
					$("#nettotal5").val("");


				}
			});			

		}
	</script>

	

	<script>

		function SelectShipping(shippingid, leadid, userid, oppoid) {
    		 var ctype = 1;
       		if ($('#s' + shippingid).is(':checked')) {   
           			 
                    $.ajax({
                    url: "fn/check_ship.php",
                    type: "POST",
                    data: {shippingid: shippingid, leadid: leadid, userid: userid, oppoid: oppoid,  ctype: ctype},
                    dataType: "html",
                    success: function (data) {
                    	
                       toastr.success("Shipping address selected.");
                       
                    },
                    error: function (xhr) {
                    }
                });

            }
            else
            {
            	$.ajax({
                    url: "fn/uncheck_ship.php",
                    type: "POST",
                    data: {shippingid: shippingid},
                    dataType: "html",
                    success: function (data) {
                    	
                       toastr.success("Shipping address unselected.");
                       
                    },
                    error: function (xhr) {
                    }
                });
            }
           
        
		}

	
	</script>

	
	<script>

		$('#txtLocation').change(function(){
		var package = $(this).val();
		
		
			$.ajax({
			   type:'POST',
			   data:{package:package},
			   url:'fn/get_district.php',
			   success:function(data)
			   		{
			   			var d  = $.trim(data);
			       	$('#txtDistrict').val(d);  

					}
				});

		});
	</script>



	<script>
		function displaydeleteopp()
		{		
			alert("We cannot delete an opportunity that has already been won.");
		}
	</script>

	
	<br /><br /><br /><br /><br /><br /><br />

	



	<script>
		function close_opportunity(oppitemid)
		{
			$('#update_cons_stage1').modal({backdrop: 'static', keyboard: false})
			$("#num").val(oppitemid); 
		}

	</script>

	<script>
		function update_close_cons()
		{
			var oppitemid = $("#num").val();			
			var oppid = $("#opcloseid").val();
			var dpconstage = $("#dpConsStage1").val();
			var cusid = $("#cuscloseid").val();
			

			$.ajax({
		   		type:'POST',
		   		data:{cusid: cusid, oppid :oppid, dpconstage: dpconstage},
		   		url:'fn/close_update_const.php',
		   		success:function(data){
					
					toastr.success("Construction stage successfully updated.");
					window.location.replace("close_opportunity_cus.php?oppitm=" + oppitemid);

				}
			});	
		}

	</script>

	<script>
		function create_order(oppitemid)
		{
			window.location.replace("create_order_cus.php?oppitm=" + oppitemid);
		}

	</script>

	<script>
		function selectshippingaddress(oppid)
		{
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid},
		   		url:'fn/check_shipping_selected.php',
		   		success:function(data){
					
					if(data == null || data == 0)
					{
						$('#addship').modal('show'); 
					}
					else
					{
						$('#err_add_ship').modal('show'); 
					}
					
					
				}
			});	
		}

	</script>

	<script>
		function selectprojectid(oppid)
		{
			$.ajax({
		   		type:'POST',
		   		data:{oppid: oppid},
		   		url:'fn/check_project_selected.php',
		   		success:function(data){
					
					if(data == null || data == 0)
					{
						$('#addproject').modal('show'); 
					}
					else
					{
						$('#err_add_pro').modal('show'); 
					}
					
					//toastr.success("Construction stage successfully updated.");
					//window.location.replace("close_opportunity.php?oppitm=" + oppitemid);

				}
			});	
		}

	</script>
	
	<script>
		$(document).ready(function(){
	    	$('#tbl_oppor').DataTable();
		});
	</script>
	
	<script type="text/javascript">
        $.fn.datepicker.defaults.format = "dd/mm/yyyy";
		$('.datepicker').datepicker({
		    startDate: '-3d'
		});
	</script>

	


</body>
</html>



