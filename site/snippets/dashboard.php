<div class="page-header">
  <h1>Dashboard</h1>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Year</th>
      <th class="right">Subtotal</th>
      <th class="right">VAT</th>
      <th class="right">Total</th>
    </tr>
  </thead>
  <tbody>
    <?php $subtotal=0.00; $vat=0.00; $total=0.00; foreach($site->invoices->years()->flip() as $year): ?>
    <?php 
    
    $stats = $site->invoices->statsPerYear($year);
    
    $subtotal = $subtotal + $stats->subtotal;
    $vat      = $vat      + $stats->vat;
    $total    = $total    + $stats->total;
    
    ?>
    <tr>
      <td><a href="<?php echo url('invoices/year:' . $year->uid()) ?>"><strong><?php echo $year->title() ?></strong></a></td>
      <td class="right"><?php echo tax::price($stats->subtotal) ?> <?php echo c::get('tax.currency.html') ?></td>
      <td class="right"><?php echo tax::price($stats->vat) ?> <?php echo c::get('tax.currency.html') ?></td>
      <td class="right"><?php echo tax::price($stats->total) ?> <?php echo c::get('tax.currency.html') ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
  <tfoot>
    <tr> 
      <td>&nbsp;</td> 
      <td class="right"><strong><?php echo tax::price($subtotal) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
      <td class="right"><strong><?php echo tax::price($vat) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
      <td class="right"><strong><?php echo tax::price($total) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
    </tr>
  </tfoot>
</table>