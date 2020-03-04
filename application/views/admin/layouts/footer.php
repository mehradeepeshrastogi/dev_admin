
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <!-- <b>Version</b> 2.4.0 -->
    </div>
    <strong><?php echo trans('copyright');?> &copy; <?php echo date('Y');?> <a href="<?php echo base_url();?>"><?php echo trans('app_name');?></a>.</strong> <?php echo trans('rights_reserved');?>
  </footer>

   <div class="loader">
      <img src="<?php echo base_url();?>assets/images/loader.gif" alt="">
    </div>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script>
    var AppConfig = {
        'base_url' : '<?php echo base_url(); ?>',
        'c_name' : '<?php echo $this->class; ?>',
        'm_name' : '<?php echo $this->method; ?>',
        'languages' : '<?php echo json_encode($languages); ?>',
    };
</script>
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- FastClick -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ADMIN_URL_FILE; ?>dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo ADMIN_URL_FILE; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ADMIN_URL_FILE; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo ADMIN_URL_FILE; ?>dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->

<script src="<?php echo ADMIN_URL_FILE; ?>bower_components/ckeditor/ckeditor.js"></script>
<!-- fullCalendar -->

<script src="<?php echo ADMIN_URL_FILE; ?>js/axios.min.js"></script>
<script src="<?php echo ADMIN_URL_FILE; ?>js/vue.js"></script>


<script src="<?php echo ADMIN_URL_FILE; ?>js/jquery.multiselect.js"></script>
<script src="<?php echo ADMIN_URL_FILE; ?>js/jstree.min.js"></script>

<?php 
#######################  Start Jquery Menu Editor  ########################################
?>

<script type="text/javascript" src="<?php echo ADMIN_URL_FILE; ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL_FILE; ?>js/jquery-menu-editor.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL_FILE; ?>bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL_FILE; ?>bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script> 

<?php 
#######################  End Jquery Menu Editor  ########################################
?>


<script>
$(document).ready(function(){
  if($('#description').length){
      CKEDITOR.replace('description');
  }

  var json = JSON.parse(AppConfig.languages);
  for (var key in json) {
       if (json.hasOwnProperty(key)) {
          lang_id = json[key].lang_id;
          if($('#description_'+lang_id).length){
              CKEDITOR.replace('description_'+lang_id);
          }
       }
    }

     var reader = new FileReader(); 
    

  function previewImage(id){
    reader.onload = function (e) {
          $('#previewImage'+id).attr('src', e.target.result);
      }
  }

   function readURL(input) {
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#selectImage").change(function(){
            readURL(this);
            reader.onload = function (e) {
                $('#previewImage').attr('src', e.target.result);
            }
    });
    
    <?php 
    /*  start image preview code  */
    $imageFileArray = ["post.create","post.edit","page.create","page.edit"];
    if(in_array($this->uri->segment(2).'.'.$this->uri->segment(3),$imageFileArray)){
    for($i=1;$i<=$image_range;$i++){ ?>

        $("#selectImage<?php echo $i;?>").change(function(){
            readURL(this);
            previewImage(<?php echo $i;?>);
        });

    <?php }
    } // end image preview code 
    ?>

});

$('.switchLang').on('change', function (e) {
    var lang_id = $(this).val();
    var result = confirm("<?php echo trans('are_you_sure_to_switch_language')?>");
    if(result == true){
      window.location = AppConfig.base_url+'admin?lang_id='+lang_id; 
    }else{
      location.reload();
    }
});

</script>

<?php 
  if($this->post_type == "menu" && (in_array($this->method,["create","edit"])))
  {
?>

<script>
    $(".multi_select_option").multiselect({
        columns: 1,
        // placeholder: 'Select Recruiters',
        search: true,
        selectAll: true
    });
    jQuery(document).ready(function(){

              var arrayjson = '<?php echo json_encode($menu_data);?>';
              // icon picker options
              var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
              // sortable list options
              var sortableListOptions = {
                  placeholderCss: {'background-color': "#cccccc"}
              };

              var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
              editor.setForm($('#frmEdit'));
              editor.setUpdateButton($('#btnUpdate'));
              editor.setData(arrayjson);
             

              $('#btnOutput').on('click', function (event) {
                  var str = editor.getString();
                  $("#out").text(str);
                  event.preventDefault();
                  $("#menu_form_data").submit();
              });

              $("#btnUpdate").click(function(){
                  editor.update();
              });

              $('#btnAdd').click(function(){
                  editor.add();
              });
              /* ====================================== */

              /** PAGE ELEMENTS **/
              // $('[data-toggle="tooltip"]').tooltip();
              // $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
              //     $('#btnStars').html(data.stargazers_count);
              //     $('#btnForks').html(data.forks_count);
              // });
          });
</script>

<?php 
  }
?>


<?php 
  if(in_array($this->post_type,["post","page"]) && in_array($this->method,["create","edit"]))
  {
    ?>
      <script type="text/javascript">
          /* START JS TREE FOR DIRECTRY STRUCTURE */
          // inline data demo
          $('#clbk').jstree({
            'core' : {
              'data' : [
                { "text" : "Root node", "children" : [
                    { "text" : "Child node 1" },
                    { "text" : "Child node 2" }
                ]}
              ]
            }
          });
          
          /* END JS TREE FOR DIRECTRY STRUCTURE */
      </script>
    <?php
      get_post_image();
  }
?>


</body>
</html>
