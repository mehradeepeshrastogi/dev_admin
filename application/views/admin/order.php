
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     Bestellungen
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bestellungen</li>
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
                    <h3 class="box-title">Bestellungen</h3>
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
                    <th style="width: 50px;">
                    S.No.
                    </th>
                    <th>Bestellnumber</th>
                    <th>Kunde</th>
                    <th>Status</th>
                    <th>Aktion</th>
                </tr>
                </thead>
                <tbody class="tbody">
                <?php foreach($orderData as $key=>$order){ 
                ?>
                <tr>
                  <td><?php echo $key+1;?></td>
                  <td><?php echo $order->reference; ?></td>
                  <td><?php echo $order->customer; ?></td>
                  <td> 
                        <select name="id_order" class="form-control" onchange="orderStatus('<?php echo $order->id_order;?>',this);">
                            <option value="0" <?php if($order->status == "0") echo"selected";?>>In Bearbeitung</option>
                            <option value="1" <?php if($order->status == "1") echo"selected";?>>Versendet</option>
                            <option value="2" <?php if($order->status == "2") echo"selected";?>>Abgelehnt</option>
                        </select>
                  </td>
                  
                  <td>
                    <a href="<?php echo base_url($this->controllerName.'/orderDetails/'.$order->id_order);?>" class="btn btn-primary"><span class="fa fa-eye"></span></a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
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