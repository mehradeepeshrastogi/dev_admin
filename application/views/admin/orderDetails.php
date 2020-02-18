
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Bestellung
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bestellung</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12"> 
				<?php
				if(!empty($error)){
					echo "<div class=' alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$error."</div>";
				}else if(!empty($success)){
					echo "<div class=' alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$success."</div>";
				}
				?>
				</div>
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              
               <div class="col-sm-6">
                    <h3 class="box-title">
                      Bestellung (Bestellnummer - <?php echo $orderData[0]->reference; ?>)</h3>
                </div>

                <div class="col-sm-4">
                    <!-- <div class="col-sm-9">
                        <input type="text" class="form-control">
                    </div>
                    
                    <div class="col-sm-3" style="padding:0px;">
                        <button type="button" class="btn btn-info">
                            <span class="fa fa-search"></span>
                        </button>
                    </div> -->
                </div>
                
               <div class="col-sm-2">
                   
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered  table-fixed">
                  <thead>
                <tr>
                    <th>S.No. </th>
                    <th>Category </th>
                    <th>Artikel_Nr </th>
                    <th>Artikelbezeichnung </th>
                    <th>EAN_Code </th>
                    <th>Preis_Netto </th>
                    <th>UVP_inkl_MwSt </th>
                    <th>quantity </th>
                    <th>Status </th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php 
                if(!empty($orderData)){
                foreach($orderData as $key=>$order){ 
                ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $order->category;?></td>
                    <td><?php echo $order->Artikel_Nr;?></td>
                    <td><?php echo $order->Artikelbezeichnung;?></td>
                    <td><?php echo $order->EAN_Code;?></td>
                    <td><?php echo $order->Preis_Netto;?></td>
                    <td><?php echo $order->UVP_inkl_MwSt;?></td>
                    <td><?php echo $order->quantity;?></td>
                    <td>
                    <?php
                        if($order->status == "0"){
                    ?>
                        <span class="label label-primary">
                              In Bearbeitung
                        </span>
                    <?php
                        }else if($order->status == "1"){
                            ?>
                        <span class="label label-success">
                              Versendet
                        </span>
                    <?php
                        }
                        else if($order->status == "2"){
                            ?>
                        <span class="label label-danger">
                              Abgelehnt
                        </span>
                    <?php
                        }
                    ?>
                    </td>
                </tr>
                <?php }
                }else{
                  ?>
                      <tr>
                          <td colspan="8">Sorrry,No You are not ordering any product</td>
                      </tr>
                  <?php
                   }
                  ?> 
                </tbody>
              </table>

              <?php if(!empty($customerData)){
              ?>
               <table class="table table-bordered  table-fixed">
                  <thead>
                    <tr>
                        <th colspan="10">
                          <h4 class="box-title">Customer Infomation</h4>
                        </th>
                    </tr>
                    <tr>
                        <th>knd_Nr </th>
                        <th>institut </th>
                        <th>name </th>
                        <th>strasse </th>
                        <th>plz </th>
                        <th>ort </th>
                        <th>telefon </th>
                        <th>fax </th>
                        <th>email </th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <tr>
                        <td><?php echo $customerData->knd_Nr;?></td>
                        <td><?php echo $customerData->institut;?></td>
                        <td><?php echo $customerData->name;?></td>
                        <td><?php echo $customerData->strasse;?></td>
                        <td><?php echo $customerData->plz;?></td>
                        <td><?php echo $customerData->ort;?></td>
                        <td><?php echo $customerData->telefon;?></td>
                        <td><?php echo $customerData->fax;?></td>
                        <td><?php echo $customerData->email;?></td>
                    </tr>
                </tbody>
              </table>
              <?php
              }
              ?>
            </div>
            <!-- /.box-body -->
            <?php 
            /*
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
            */
            ?>
          </div>
          <!-- /.box -->      
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->