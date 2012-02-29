<?php tax() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title><?php echo html($site->title()) ?> - <?php echo html($page->title()) ?></title>
  <meta charset="utf-8" />

  <?php echo css('assets/css/bootstrap.min.css') ?>
  <?php echo css('assets/css/styles.css') ?>

</head>

<body>
    
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo url() ?>"><?php echo html($site->title()) ?></a>
      <div class="nav-collapse">
        <ul class="nav">
          <li<?php if($page->isHomePage()) echo ' class="active"' ?>>
            <a href="<?php echo url() ?>">Dashboard</a>
          </li>
          <li class="dropdown<?php if($site->invoices->year()) echo ' active' ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invoices <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <?php foreach($site->invoices->years()->flip() as $year): ?>
              <li<?php if($year == $site->invoices->year()) echo ' class="active"' ?>><a href="<?php echo url('invoices/year:' . $year->title()) ?>"><?php echo $year->title() ?></a></li>             
              <?php endforeach ?>   
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="page container">

<?php if(c::get('tax.warning')): ?>
<div class="alert">
  <a class="close" data-dismiss="alert">×</a>
  <?php echo c::get('tax.warning') ?>
</div>
<?php endif ?>