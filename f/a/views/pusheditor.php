<?php include 'includes/core/document_head.php';?>
  <div id="pjax">
    <div id="wrapper" data-adminica-side-top="<?php echo $side_current_id;?>" data-adminica-nav-inner="5">
      <?php include 'includes/components/topbar.php';?>
      <?php include 'includes/components/sidebar.php';?>
      <?php include 'includes/components/stackbar.php';?></div><!-- Closing Div for Stack Nav, you can boxes under the stack before this -->
      <div id="main_container" class="main_container container_16 clearfix">
        <?php include 'includes/components/navigation.php';?>
        <div class="flat_area grid_16">
          <h2><?php echo $title['top'];?> <small><?php echo $title['small'];?></small>
            <div class="holder">
              <?php include 'includes/components/dynamic_loading.php';?>
            </div>
          </h2>
        </div>
        <div class="box grid_16">
        
          <div class="block">
            <form id="article_editor" action="<?php echo site_url($ctl.'/new_push');?>" method="post" class='validate_form' enctype="multipart/form-data">
            
            <fieldset class="label_side top">
              <label>标题</label>
              <div>
                <input type="text" name="title" placeholder="请输入标题..." class='required'>
                <div class="required_tag tooltip hover left" title="This field is required"></div>
              </div>
            </fieldset>
            <fieldset class="label_side top">
              <label>命令（选填）</label>
              <div>
                <input type="text" name="command" placeholder="请输入额外的命令参数...">
              </div>
            </fieldset>
            <fieldset class="label_side top">
              <label>内容（选填）<br/><font color="red">不超过50个字，否则会被苹果推送截断。</font></label>
              <div>
                <textarea id="content" name="content" title="推送内容为选填" class="tooltip autogrow" placeholder="输入推送的内容..."></textarea>
                <div id="counter"></div>
              </div>
            </fieldset>
            <div class="button_bar clearfix">
              <button type="submit" class="dark"  onclick='instance.post();'>
                <img src="images/icons/small/white/bended_arrow_right.png">
                <span>推送</span>
              </button>
            </div>
          </div>
            </form>
        </div>
        <script src="<?php echo base_url('scripts/inputlimit.js');?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#content").weiboInputBox({
                    counter:"counter",
                    max:50,
                    textClass:"normal",
                    normalClass:"text",
                    errorClass:"error"
                });
            });
        </script>

    </div>
    <?php include 'includes/dialogs/dialog_welcome.php';?>
    <?php include 'includes/dialogs/dialog_logout.php';?>
<?php include 'includes/core/document_foot.php';?>
