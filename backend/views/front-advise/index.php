
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\FrontAdvise;

$modelLabel = new \backend\models\FrontAdvise();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">

        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'front-advise-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('front-advise/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('name')?>:</label>
                      <input type="text" class="form-control" id="query[name]" name="query[name]"  value="<?=isset($query["name"]) ? $query["name"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('phone')?>:</label>
                      <input type="text" class="form-control" id="query[phone]" name="query[phone]"  value="<?=isset($query["phone"]) ? $query["phone"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12 table-responsive">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'name\', \'desc\')" '.CommonFun::sortClass($orderby, 'name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name').'</th>';
              echo '<th onclick="orderby(\'email\', \'desc\')" '.CommonFun::sortClass($orderby, 'email').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('email').'</th>';
              echo '<th onclick="orderby(\'phone\', \'desc\')" '.CommonFun::sortClass($orderby, 'phone').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('phone').'</th>';
              echo '<th onclick="orderby(\'img\', \'desc\')" '.CommonFun::sortClass($orderby, 'img').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('img').'</th>';
              echo '<th onclick="orderby(\'advise\', \'desc\')" '.CommonFun::sortClass($orderby, 'advise').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('advise').'</th>';
              echo '<th onclick="orderby(\'reply\', \'desc\')" '.CommonFun::sortClass($orderby, 'reply').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('reply').'</th>';
              echo '<th onclick="orderby(\'create_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'create_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('create_time').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->name . '</td>';
                echo '  <td>' . $model->email . '</td>';
                echo '  <td>' . $model->phone . '</td>';
                $img = explode('|',$model->img);
				echo '<td>';
				if($model->img){
					foreach ($img as $v){
						echo '<img style="width: 100px;height: 60px" src="'.$v.'" onclick="javascript:window.open(this.src)" />';
					}
				}else{
					echo '无图片';
				}
				echo '</td>';
                echo '  <td>' . $model->advise . '</td>';
                echo '  <td>' . $model->reply . '</td>';
                echo '  <td>' . date('Y-m-d H:i:s',$model->create_time) . '</td>';
                echo '  <td class="center">';
				echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
				if(!$model->reply){
					echo "<a class='btn btn-primary btn-sm reply' data-id='".$model->id."' data-name='".$model->name."'><i class='glyphicon icon-white'>回复</a>";
				}
				echo '  </td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '»',
              	    'prevPageLabel' => '«',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
          	</div>
		  </div>
		  <!-- row end -->
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "front-advise-form", "class"=>"form-horizontal", "action"=>Url::toRoute("front-advise/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="FrontAdvise[name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="email_div" class="form-group">
              <label for="email" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("email")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="FrontAdvise[email]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="phone_div" class="form-group">
              <label for="phone" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("phone")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="FrontAdvise[phone]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="advise_div" class="form-group">
              <label for="advise" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("advise")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="advise" name="FrontAdvise[advise]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="create_time_div" class="form-group">
              <label for="create_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("create_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="create_time" name="FrontAdvise[create_time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-xs-4 col-md-4" id="title_e">回复内容:</label>
						<div class="col-xs-6 col-md-6">
							<textarea class="form-control" name="name" style="height: 100px"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="id" value=""/>
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary save">保存</button>
			</div>
		</div>
	</div>
</div>
<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
function orderby(field, op){
	 var url = window.location.search;
	 var optemp = field + " desc";
	 if(url.indexOf('orderby') != -1){
		 url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
			 var optemp = field + " desc";
			 optemp = decodeURI($1) != optemp ? optemp : field + " asc";
			 return "orderby=" + optemp;
		   }); 
	 }
	 else{
		 if(url.indexOf('?') != -1){
			 url = url + "&orderby=" + encodeURI(optemp);
		 }
		 else{
			 url = url + "?orderby=" + encodeURI(optemp);
		 }
	 }
	 window.location.href=url; 
 }
 function searchAction(){
		$('#front-advise-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#name").val('');
		$("#email").val('');
		$("#phone").val('');
		$("#advise").val('');
		$("#create_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#name").val(data.name);
    	$("#email").val(data.email);
    	$("#phone").val(data.phone);
    	$("#advise").val(data.advise);
    	$("#create_time").val(data.create_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#email").attr({readonly:true,disabled:true});
      $("#phone").attr({readonly:true,disabled:true});
      $("#advise").attr({readonly:true,disabled:true});
      $("#create_time").attr({readonly:true,disabled:true});
      $("#create_time").parent().parent().show();
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#email").attr({readonly:false,disabled:false});
      $("#phone").attr({readonly:false,disabled:false});
      $("#advise").attr({readonly:false,disabled:false});
      $("#create_time").attr({readonly:false,disabled:false});
      $("#create_time").parent().parent().hide();
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('front-advise/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		var checkboxs = $('#data_table :checked');
	    if(checkboxs.size() > 0){
	        var c = 0;
	        for(i = 0; i < checkboxs.size(); i++){
	            var id = checkboxs.eq(i).val();
	            if(id != ""){
	            	ids[c++] = id;
	            }
	        }
	    }
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('front-advise/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   window.location.reload();
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}
$(".reply").click(function () {
	var id = $(this).data('id'),
		name = $(this).data('name');
	$('#myModalLabel').text('回复'+name);
	$('input[name=id]').val(id);
	$('textarea[name=name]').val('');
	$('#myModal').modal('show');
});
//保存
$(".save").click(function () {
	var url = "<?=Url::toRoute('front-advise/reply')?>",
		content = $('textarea[name=name]').val(),
		id = $('input[name=id]').val();
	console.log(url,content,id);
	$.ajax({
		url: url,
		type: 'get',
		data: {
			content: content,
			id: id,
		},
		dataType:"json",
		error: function (xmlHttpRequest, textStatus, errorThrown) {
			admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
		},
		success: function(data){
			if(data.errno==0){
				admin_tool.alert('msg_info', '回复成功', 'success');
				window.location.reload();
			}else{
				admin_tool.alert('msg_info', data.msg, 'error');
			}
		}
	});
});
function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#front-advise-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#front-advise-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('front-advise/create')?>" : "<?=Url::toRoute('front-advise/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		window.location.reload();
        	}
        	else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

 
</script>
<?php $this->endBlock(); ?>