<style>
.row{
    background:#E5E5E5;
    padding:10px;
    border-radius:5px 5px;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'accessibility-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    <?php
    if($model->isNewRecord)
    {
    ?>
	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model,'user_id',Users::getUserList2(),array('empty'=>'Select User', /*'disabled'=>$disabled*/));?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>
<?php 
}else
{
    ?>
    <div class="row">
		<strong>User : </strong>
        <?php $m = Users::model()->findByPk($model->user_id);echo $m->username;?>
	</div>
    <?php    
}
?>
    <div class="row">
    <select id="ip_switch">
    <option value="">Choose IP Category</option>
    <option value="ip">Single Ip</option>
    <option value="multiple">Multiple IP</option>
    <option value="range">IP Range</option>
    </select>
    <input type="hidden" class="chosen" name="chosen" value="" />
    </div>
	<div class="row ip" <?php if(!$model->ip){?>style="display: none;"<?php }?>>
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>60,'maxlength'=>255,'class'=>'ip_f','value'=>$model->ip)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>
    
    <div class="row multiple" <?php if(!$model->multiple_ip){?>style="display: none;"<?php }?>>
		<strong>Multiple Ip (comma seperated):</strong><br/>
		<?php echo $form->textField($model,'multiple_ip',array('size'=>60,'maxlength'=>255,'class'=>'mul_f','value'=>$model->multiple_ip)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>
    
    <div class="row range" <?php if(!$model->ip_range1){?>style="display: none;"<?php }?>>
		<strong>IP Range :</strong><br/>
		<?php echo $form->textField($model,'ip_range1',array('size'=>60,'maxlength'=>255,'class'=>'r1_f','value'=>$model->ip_range1)); ?>
        <?php echo $form->textField($model,'ip_range2',array('size'=>60,'maxlength'=>255,'class'=>'r2_f','value'=>$model->ip_range2)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary','onclick'=>'check();')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function check(){
	if($('.chosen').val() == ''){
		alert('Please choose IP Category');
		return false;
	}else{
		var vals = $('.chosen').val();
		if(vals == ''){
			alert('IP cannot be blank');
			return false;
		}else{
			/* check single IP*/
			if(vals == 'ip') {
				var ip = $('.ip_f').val();
				if (ip != '*'){
					var len1  = ip.length;
					var ch = ip;
					for(var l=0;l<len1;l++){ ch = ch.replace('.',''); }
					var len2 = ch.length;
					if(len1 == len2){
						alert('Invalid IP');
						return false;
					} else {
						var ch = ip.replace('..','');
						var len2 = ch.length;
						if(len1 != len2) {
							alert('Invalid IP');
							return false;
						}else{
							if(ip[0] == '.'){
								alert('Invalid IP');
								return false;
							}
							if(ip[len1-1] == '.'){
								alert('Invalid IP');
								return false;
							}
							var i = 0;
							var k = 0;
							for(i=0;i<len1;i++){
								if(ip[i] == '.'){ k++; }
							}
							if(k!=3){
								alert('Invalid IP');
								return false;
							}
						}
						$('#accessibility-form').submit();
					}
				} else $('#accessibility-form').submit();
			}
            
			/* check multiple IP*/
			if(vals == 'multiple'){
				var ip = $('.mul_f').val();
				var arr = ip.split(',');
				var c = arr.length;
				for(var i = 0;i<c;i++){
					var ip = arr[i];
					ip = ip.replace(' ','');
					ip = ip.replace(' ','');
					var len1  = ip.length;
					var ch = ip;
					for(var l=0;l<len1;l++){ch = ch.replace('.','');}
					var len2 = ch.length;

					if(len1 == len2){
						alert('One of the Ip you entered is invalid');
						return false;
					}else{
						var ch = ip.replace('..','');
						var len2 = ch.length;
						if(len1 != len2){
							alert('One of the Ip you entered is invalid');
							return false;
						}else{
							if(ip[0] == '.'){
								alert('One of the Ip you entered is invalid');
								return false;
							}
							if(ip[len1-1] == '.'){
								alert('One of the Ip you entered is invalid');
								return false;
							}

							var m = 0;
							var k = 0;
							for(m=0;m<len1;m++){
								if(ip[m] == '.'){ k++; }
							}
							if(k!=3){
								alert('One of the Ip you entered is invalid');
								return false;
							}
						}
				   
					}
				}
				$('#accessibility-form').submit();
			}

			/* check range IP*/
			if(vals == 'range'){
				var ip1 = $('.r1_f').val();
				var ip2 = $('.r2_f').val();
				if(ip1 == ip2){
					alert('Both IP cannot be the same');
					return false;
				}else{
					var ch1 = check_ip(ip1);
					var ch2 = check_ip(ip2);
					if(ch1 && ch2){
						alert(ip1+'-'+ip2);
						arr1 = ip1.split('.');
						arr2 = ip2.split('.');
						var f1 = arr1[0];
						var f2 = arr2[0];
						if(parseFloat(f1)>parseFloat(f2)){
							alert("Invalid Range");
							return false;
						}

						var s1 = arr1[1];
						var s2 = arr2[1];
						if(parseFloat(s1)>parseFloat(s2)){
							alert("Invalid Range");
							return false;
						}

						var t1 = arr1[2];
						var t2 = arr2[2];
						if(t1>t2){
							alert("Invalid Range");
							return false;
						}

						var fo1 = arr1[3];
						var fo2 = arr2[3];
						if(fo1>fo2){
							alert("Invalid Range");
							return false;
						} 
					}else{
						alert('One of the Ip you Entered is InvaliD');
						return false;
					}
				}
				$('#accessibility-form').submit();

			}
		}
	}
}


function check_ip(ip)
{
                
                var len1  = ip.length;
                ch = ip;
                for(var l=0;l<len1;l++){
                    ch = ch.replace('.','');
                    }
                var len2 = ch.length;
                
                if(len1 == len2)
                {
                    alert('Invalid IP');
                    return false;
                }
                else
                {
                var ch = ip.replace('..','');
                var len2 = ch.length;
                if(len1 != len2)
                {
                    alert('Invalid IP');
                    return false;
                }
                else
                {
                    if(ip[0] == '.'){
                    alert('Invalid IP');
                    return false;
                    }
                    if(ip[len1-1] == '.'){
                    alert('Invalid IP');
                    return false;
                    }
                    var i = 0;
                    var k = 0;
                    for(i=0;i<len1;i++)
                    {
                        if(ip[i] == '.')
                        {
                            k++;
                        }
                    }
                    if(k!=3)
                    {
                        alert('Invalid IP');
                        return false;
                    }
                    
                    
                    
                }
                
                }
                return true;
}
$(function(){
   $('#ip_switch').change(function(){
    var val = $(this).val();
    if(val != ''){
    $('.ip').hide();
    $('.multiple').hide();
    $('.range').hide();
    $('.'+val).show();
    $('.chosen').val(val);
    }
    else
    {
    $('.ip').hide();
    $('.multiple').hide();
    $('.range').hide();
    $('.chosen').val('');
    }
   }); 
});
</script>
