
<maodian2>
<select name="post[catid]" onchange="get_son_class3((this.value),'<?php echo site_url("archives/archives_class_ajax")?>','class_ajax3')">
<option>请选择</option>
<?php foreach($class as $c){ ?>
<?php if($c['fid']==$_POST['id']){ ?>
  <option value="<?php echo $c['id']; ?>"><?php echo $c['classname']; ?></option>
<?php } ?>
<?php } ?>
</select>
</maodian2>


<maodian3>
<select name="post[catid]" onchange="get_son_class4((this.value),'<?php echo site_url("archives/archives_class_ajax")?>','class_ajax4')">
<option>请选择</option>
<?php foreach($class as $c){ ?>
<?php if($c['fid']==$_POST['id']){ ?>
  <option value="<?php echo $c['id']; ?>"><?php echo $c['classname']; ?></option>
<?php } ?>
<?php } ?>
</select>
</maodian3>

<maodian4>
<select name="post[catid]" onchange="get_son_class5((this.value),'<?php echo site_url("archives/archives_class_ajax")?>','class_ajax5')">
<option>请选择</option>
<?php foreach($class as $c){ ?>
<?php if($c['fid']==$_POST['id']){ ?>
  <option value="<?php echo $c['id']; ?>"><?php echo $c['classname']; ?></option>
<?php } ?>
<?php } ?>
</select>
</maodian4>
