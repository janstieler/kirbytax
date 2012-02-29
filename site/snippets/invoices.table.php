<?php if(!empty($invoices)): ?>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th class="invoice">Invoice</th>
      <th>Date</th>
      <th>Paid</th>
      <th class="right">Subtotal</th>
      <th class="right">VAT</th>
      <th class="right">Total</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($invoices as $invoice): ?>
    <tr>
      <td class="invoice">
        <div class="btn-group">
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <?php echo $invoice->dirname() ?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <?php foreach($invoice->files() as $file): ?>
            <li><a href="<?php echo $file->url() ?>"><?php echo $file->filename() ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
      </td>      
      <td><?php echo date(c::get('tax.format.date'), $invoice->date()) ?></td>
      <td><?php echo ($invoice->paid() != '') ? date(c::get('tax.format.date'), strtotime($invoice->paid())) : '-' ?></td>
      <td class="right"><?php echo tax::price($invoice->subtotal()) ?> <?php echo c::get('tax.currency.html') ?></td>
      <td class="right"><?php echo tax::price($invoice->vat()) ?> <?php echo c::get('tax.currency.html') ?></td>
      <td class="right"><?php echo tax::price($invoice->total()) ?> <?php echo c::get('tax.currency.html') ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
  <tfoot>
    <tr> 
      <td class="invoice">&nbsp;</td> 
      <td>&nbsp;</td> 
      <td>&nbsp;</td> 
      <td class="right"><strong><?php echo tax::price($stats->subtotal) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
      <td class="right"><strong><?php echo tax::price($stats->vat) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
      <td class="right"><strong><?php echo tax::price($stats->total) ?> <?php echo c::get('tax.currency.html') ?></strong></td>
    </tr>
  </tfoot>
</table>
<?php else: ?>
<p>No invoices</p>
<?php endif ?>
