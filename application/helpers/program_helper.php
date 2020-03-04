<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('trans'))
{
	function trans($name)
	{
		$CI = &get_instance();
		$trans_name = $CI->lang->line($name);
		$key = array_keys($CI->lang->is_loaded);
		$value = array_values($CI->lang->is_loaded);
		return (!empty($trans_name))?$trans_name:$value[0].".".$key[0].".".$name;
	}
}

if(!function_exists('create_token')){
	function create_token(){
		$unique_string = md5(time().uniqid().mt_rand());
		return $unique_string;
	}
}

/*
	get_token method have 3 parameter
	'table', => required, get data from this table
	'access_token' => required, matching token from table token fields
	'except' => optional, if you no need some array element  
*/
if(!function_exists('get_token')){
	// get_token('user','access_token',['password','remember_token']);
	function get_token($table,$access_token,$except=[]){
		$CI = &get_instance();
		$select = "*";
		if(!empty($except)){
			$table_data = $CI->db->list_fields($table);
			$selectArr = array_except($table_data,$except);
			$select = implode(',',$selectArr);
		}

		$query = $CI->db->select($select)->get_where($table,['access_token' => $access_token]);
		return ($query->num_rows() > 0)?$query->row():false;
	}
}

if(!function_exists('array_except')){
	function array_except($data,$except){
		$data_flip = array_flip($data);
		$newArr = [];
		if(!empty(is_array($data[0]))){
			echo"2d array";
		}else{
			foreach($except as $expt){
				unset($data_flip[$expt]);
			}
			return array_flip($data_flip);
		}
			
	
		// dd($data);
	}
}


/*
	 dd = dump & die;
*/

if (!function_exists('dd'))
{
	function dd($data)
	{
		echo"<pre>";print_r($data);die;
	}
}

/*
	 dump = dump & die;
*/

if (!function_exists('dump'))
{
	function dump($data)
	{
		echo"<pre>";print_r($data);echo"</pre>";
	}
}


/*
	 dd = dump json;
*/

if (!function_exists('dj'))
{
	function dj($data)
	{
		 echo json_encode($data);die;
	}
}



/*
	 unlinkFile = unlink files;
*/

if (!function_exists('unlinkFile'))
{
	function unlinkFile($filePath,$table,$select,$where)
	{
		$CI = &get_instance();
		$query = $CI->db->select($select)->get_where($table,$where);
		$result = $query->num_rows();
		if($result > 0){
			$files = $query->result();
			foreach($files as $file){
				unlink($filePath.$file->$select);
			}
		}
		return true;
	}
}


if (!function_exists('array_multi_str'))
{
	function array_multi_str($arrayData,$find_key,$child_key){
		$post_ids = "";
		$preFlag = false;
		$k=0;
		foreach($arrayData as $arr_data){
			if(array_key_exists($find_key, $arr_data)){
				$pre = ",";
				if($k==0 && $preFlag == false){
					$pre = "";
					$preFlag = true;
				}
				$post_ids .= $pre.$arr_data[$find_key];
				if(array_key_exists($child_key, $arr_data)){
					$pre = ",";
					if($k == 0 && $preFlag == false){
						$pre = "";
						$preFlag = true;
					}
					$post_ids .= $pre.array_multi_str($arr_data[$child_key],$find_key,$child_key);
				}
				$k++;
			}
		}
		return $post_ids;
	}
}


if (!function_exists('array_multi_column'))
{
	function array_multi_column($arrayData,$find_key,$child_key){
		$array_multi_str = array_multi_str($arrayData,$find_key,$child_key);
		$post_ids_arr = explode(",", $array_multi_str);
		return $post_ids_arr;
	}
}


if (!function_exists('postImageUrl'))
{
	function postImageUrl($arrayData){
		return (base_url().'uploads/post/'.$arrayData);
	}
}



if (!function_exists('get_post_image'))
{
	function get_post_image($flag=false){
?>

	<script type="text/javascript">


		var flag = '<?php echo $flag;?>';
	    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
	    axios.defaults.baseURL = window.location.protocol+"//"+window.location.hostname+'/'+window.location.pathname.split("/")[1]+'/';
	    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
	    var app = new Vue({
	      el: '.content-wrapper',
	      data(){
	        return {
	          file:'',
	          image:'',
	          images:[],
	          flag:flag,
	          uploadImagesArr:[],
	          post_form:{
	          	"width":"800",
	          	"height":"800",
	          	"multiple_images":"",
	          },
	          headers:'',
	          exception:['id_category','id_product','created_at','updated_at','category','Bestell_Menge']
	        }
	      },
	      mounted: function(){
	      	var self = this;
	      	if(self.flag == '1'){
	        	this.getPostImages();
	      	}
	      },
	      methods:{
	        getPostImages:function(){
	          var self = this;
	          // $('.loader').show();
	          var data = new FormData();
	          if($('.searchData').val() !=""){
	            // data.append('searchData',$('.searchData').val());
	          }
	          
	          // data.append('id_category',$('#id_category').val());
	          // data.append('page',self.pagination.current_page);
	          // data.append('per_page',self.pagination.per_page);
	          // axios.post('admin/post/getPostImages',data)
	          axios.get('admin/getPostImages').then(function (response) {
	            self.images = response.data;
	            console.log(self.images);
	            $('#post_images').modal('show');
	            // $('.loader').hide();
	          }).catch(function (error) {
	            console.log(error);
	            // $('.loader').hide();
	          });
	        },
	        getPostImage:function(image){
	          var self = this;
	          self.image = image;
	          console.log(self.image);
	        },
	        uploadImages:function(event){
	        	var self = this;
                var formData = new FormData();
                for ( var key in self.post_form) {
                    formData.append(key, self.post_form[key]);
                }
                formData.append('image', self.uploadImagesArr);
                const config = { 
                    headers: { 'Content-Type': 'multipart/form-data' }
                }

                axios.post('admin/uploadImages',formData,config).then(function (response) {
                    console.log(response);
           			
                })
                .catch(function (error) {
                    // self.formErrors = error.response.data.errors;
                    console.log(error);
                    // $('.loader').hide();
                });
	        },
	        onFileChange:function(e){
	        	var self = this;
                var form_data = new FormData();
                var file;
				imageLength = e.target.files.length;
				console.log(e.target.files);
				for(i=0;i<imageLength;i++){
					file = e.target.files[i];
                	// formData = ('files['+i+']',e.target.files[i]);
				    form_data.append('files[' + i + ']', file);
	        	}
				// console.log(file);
	        	console.log(form_data);
                this.uploadImagesArr = form_data;
	        	// console.log(this.uploadImagesArr);
                // if(this.image.size > 1000000){
                //     $(".btnSubmit").attr("disabled",true);
                //     // this.formErrors = {
                //     //     "image":["Image Size grater the 1 MB"]
                //     // }
                // }else{
                //     $(".btnSubmit").attr("disabled",false);
                //      this.formErrors = {};
                // }
            }
	       
	      }
	    });
	</script>
<?php
	}
}
?>