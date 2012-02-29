<?php if($months): ?>
<h2>Months</h2>
<div class="subnav">
  <ul class="nav nav-pills">
    <?php foreach($months as $m): ?>
    <li<?php if($m == $month) echo ' class="active"' ?>><a href="<?php echo url('invoices/year:' . $year->uid() . '/month:' . $m) ?>"><?php echo tax::monthNameShort($m) ?></a></li>
    <?php endforeach ?>
  </ul>
</div>
<?php endif ?>