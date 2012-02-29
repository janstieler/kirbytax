<?php 

snippet('header');

$year     = $site->invoices->year();
$invoices = $site->invoices->invoicesPerYear();
$stats    = $site->invoices->statsPerYear();
$months   = $site->invoices->months();
$month    = $site->invoices->month();

?>
<div class="page-header">
  <h1><a href="<?php echo url('invoices/year:' . $year->uid()) ?>"><?php echo $year->title() ?></a> <small>Total: <?php echo tax::price($stats->total) ?> <?php echo c::get('tax.currency.html') ?></small></h1>
</div>

<?php snippet('menu.months', array('year' => $year, 'months' => $months, 'month' => $month)) ?>

<?php if(param('month')): ?>
  <?php snippet('invoices.month') ?>
<?php else: ?>
  <h2>All Invoices for <?php echo $year->title() ?> <small>Total: <?php echo tax::price($stats->total) ?> <?php echo c::get('tax.currency.html') ?></small></h2>
  <?php snippet('invoices.table', array('invoices' => $invoices, 'stats' => $stats)) ?>
<?php endif ?>

<?php snippet('footer') ?>