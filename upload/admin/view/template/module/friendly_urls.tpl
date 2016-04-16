<?php echo $header ?><?php echo $column_left ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title ?></h1>
      
      <div class="pull-right">
        <a class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_back ?>"><i class="fa fa-reply"></i></a>
      </div>
      
      <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Extensions</a></li>
        <li><a href="#">Friendly URLs</a></li>
      </ul>
    </div>
  </div>
  
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-cog fa-fw"></i> <?php echo $text_options ?></div>
      
      <div class="panel-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#product" data-toggle="tab">Продукты</a></li>
          <li><a href="#category" data-toggle="tab">Категории</a></li>
          <li><a href="#information" data-toggle="tab">Страницы</a></li>
          <li><a href="#manufacturer" data-toggle="tab">Производители</a></li>
        </ul>
        
        <div class="tab-content">
          <div class="tab-pane active" id="product">
            
            <button type="button" class="btn btn-primary" id="button-product" data-loading-text="<?php echo $text_loading ?>">Создать SEO URL</button>
          
            <div class="well" style="margin-top:20px;min-height:150px"></div>
          </div>
          
          <div class="tab-pane" id="category">
            
            <button type="button" class="btn btn-primary" id="button-category" data-loading-text="<?php echo $text_loading ?>">Создать SEO URL</button>
          
            <div class="well" style="margin-top:20px;min-height:150px"></div>
          </div>
          
          <div class="tab-pane" id="information">
            
            <button type="button" class="btn btn-primary" id="button-information" data-loading-text="<?php echo $text_loading ?>">Создать SEO URL</button>
          
            <div class="well" style="margin-top:20px;min-height:150px"></div>
          </div>
          
          <div class="tab-pane" id="manufacturer">
            
            <button type="button" class="btn btn-primary" id="button-manufacturer" data-loading-text="<?php echo $text_loading ?>">Создать SEO URL</button>
          
            <div class="well" style="margin-top:20px;min-height:150px"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $("#button-product").click(function() {
    
    $("#button-product").button("loading");
    $("#product .well").empty();
    
    $.getJSON("index.php?route=module/friendly_urls/product&token=<?php echo $token ?>", function(result) {
      
      if (result.error) {
        $(".tab-content").before("<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> " + result.error + " <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
      }
      else {
        $.map(result.success, function(product) {
          $("#product .well").append(product);
        });
      }
      
    }).done(function() {
      $("#button-product").button("reset");
    });
  });
  
  $("#button-category").click(function() {
    
    $("#button-category").button("loading");
    $("#category .well").empty();
    
    $.getJSON("index.php?route=module/friendly_urls/category&token=<?php echo $token ?>", function(result) {
      
      if (result.error) {
        $(".tab-content").before("<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> " + result.error + " <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
      }
      else {
        $.map(result.success, function(category) {
          $("#category .well").append(category);
        });
      }
      
    }).done(function() {
      $("#button-category").button("reset");
    });
  });
  
  $("#button-information").click(function() {
    
    $("#button-information").button("loading");
    $("#information .well").empty();
    
    $.getJSON("index.php?route=module/friendly_urls/information&token=<?php echo $token ?>", function(result) {
      
      if (result.error) {
        $(".tab-content").before("<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> " + result.error + " <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
      }
      else {
        $.map(result.success, function(information) {
          $("#information .well").append(information);
        });
      }
      
    }).done(function() {
      $("#button-information").button("reset");
    });
  });
  
  $("#button-manufacturer").click(function() {
    
    $("#button-manufacturer").button("loading");
    $("#manufacturer .well").empty();
    
    $.getJSON("index.php?route=module/friendly_urls/manufacturer&token=<?php echo $token ?>", function(result) {
      
      if (result.error) {
        $(".tab-content").before("<div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> " + result.error + " <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button></div>");
      }
      else {
        $.map(result.success, function(manufacturer) {
          $("#manufacturer .well").append(manufacturer);
        });
      }
      
    }).done(function() {
      $("#button-manufacturer").button("reset");
    });
  });
</script>

<?php echo $footer ?>