<?php

$invoices = $site->invoices->invoicesPerMonth();
$stats    = $site->invoices->statsPerMonth();
$month    = $site->invoices->month();

?>
<h2>Invoices for <?php echo tax::monthNameLong($month) ?> <small>Total: <?php echo tax::price($stats->total) ?> <?php echo c::get('tax.currency.html') ?></small></h2>
<?php snippet('invoices.table', array('invoices' => $invoices, 'stats' => $stats)) ?>
