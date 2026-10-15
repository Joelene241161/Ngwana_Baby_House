<!-- supply needs listed for volunteer -->
<div class="modal fade" id="supplyNeedsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Active care requests</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <?php if (!empty($supplyRequests)): ?>
                <?php foreach ($supplyRequests as $row): ?>
                    <?php
                        $category = strtolower($row['category']);
                        $imgPath = '../Assets/wipes.png';
                        $displayName = ucfirst($category);
                        
                        if ($category === 'nappies') {
                            $imgPath = '../Assets/diaper.png';
                            $displayName = "Nappies (Size " . htmlspecialchars($row['size']) . ")";
                        } elseif ($category === 'wipes') {
                            $imgPath = '../Assets/wipes.png';
                            $displayName = "Wipes (" . htmlspecialchars($row['wipe']) . ")";
                        } elseif ($category === 'toys') {
                            $imgPath = '../Assets/toys.png';
                            $displayName = "Toys (" . htmlspecialchars($row['toy']) . ", Age " . htmlspecialchars($row['age']) . ")";
                        } elseif ($category === 'formula') {
                            $imgPath = '../Assets/formula.png';
                            $displayName = "Formula (Stage " . htmlspecialchars($row['stage']) . ", " . htmlspecialchars($row['formula']) . ")";
                        }
                    ?>

                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px">
                        <div>
                            <img src="<?php echo $imgPath; ?>" alt="<?php echo $category; ?>" style="width: 44px" class="imagePaddingTop">
                        </div>
                        <div> 
                            <p class="pLight careSuppliesText"><?php echo $displayName; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="pLight" style="color: #6b7280; margin-top: 10px;">No active care requests found.</p>
            <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button class="primaryButton buttonText" data-bs-dismiss="modal">close</button>
      </div>
    </div>
  </div>
</div>