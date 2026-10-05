<!-- Care request modal -->
<div class="modal fade" id="supplies" tabindex="-1" aria-labelledby="supplies" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Create a care request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div style="display: flex">
          <div><img src="../Assets/wipes.png" alt="category icon" style="width: 70px" id="modalImg"></div>
          <div class="marginLeftSmall"> 
            <h6 id="modalTitle">Wet Wipes</h6>    
            <p class="pLight">Choose the details and quantity</p>
          </div>
        </div>

        <form method="post">
          <!-- Dynamically populates (size for nappies, age for toys and stage for formula) -->
          <div id="extraSection"></div>

          <!-- Type section (hidden when empty) -->
          <div id="typeSection">
            <h5 class="paddingTopMedium paddingBottomSmall">Type</h5>
            <div id="modalOptions">
              <!-- populated dynamically -->
            </div>
          </div>

          <h5 class="paddingTopMedium">Quantity</h5>

          <button type="button" class="qty-btn" onclick="changeQty(-1)"> <h3>&minus;</h3> </button>
          <input type="number" id="qty" name="quantity" value="1" min="1" max="10" class="smallInput">
          <button type="button" class="qty-btn" onclick="changeQty(1)"> <h3>&plus;</h3></button>

          <h5 class="imagePaddingTop paddingBottomSmall">Urgency</h5>

          <input type="radio" class="btn-check" name="urgency" id="today" value="Today" autocomplete="off" checked>
          <label class="btn" for="today">&#128992; Today</label>

          <input type="radio" class="btn-check" name="urgency" id="thisWeek" value="This Week" autocomplete="off">
          <label class="btn" for="thisWeek">&#128993; This week</label>

          <input type="radio" class="btn-check" name="urgency" id="stockUp" value="Stock Up" autocomplete="off">
          <label class="btn" for="stockUp">&#128994; Stock up</label>

          <!-- Hidden category field -->
          <input type="hidden" name="category" id="modalCategoryInput">

          <!-- Submit form -->
          <button class="primaryButton buttonText buttonFullWidth col-12 paddingTopMedium" type="submit">Create Request</button>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const suppliesModal = document.getElementById('supplies');

  const categoryData = {
    'Nappies': {
      img: '../Assets/diaper.png',
      extraTitle: 'Size',
      extraName: 'size',
      extraOptions: ['1', '2', '3', '4', '5', '6+']
      // no options, so type section stays hidden
    },
    'Wipes': {
      img: '../Assets/wipes.png',
      options: ['Sensitive', 'Fragrance Free', 'Regular']
    },
    'Toys': {
      img: '../Assets/toys.png',
      extraTitle: 'Age',
      extraName: 'age',
      extraOptions: ['0-3m', '3-6m', '12-24m'],
      options: ['Soft toys', 'Blocks', 'Books']
    },
    'Formula': {
      img: '../Assets/formula.png',
      extraTitle: 'Stage',
      extraName: 'stage',
      extraOptions: ['1', '2', '3'],
      options: ['Standard', 'Lactose free', 'Anti-reflux']
    }
  };

  suppliesModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    if (!button) return;

    const category = button.getAttribute('data-category');

    const modalTitle = suppliesModal.querySelector('#modalTitle');
    const modalImg = suppliesModal.querySelector('#modalImg');
    const modalOptions = suppliesModal.querySelector('#modalOptions');
    const typeSection = suppliesModal.querySelector('#typeSection');
    const extraSection = suppliesModal.querySelector('#extraSection');
    const categoryInput = suppliesModal.querySelector('#modalCategoryInput');

    if (modalTitle) modalTitle.textContent = category;
    if (categoryInput) categoryInput.value = category;

    const data = categoryData[category];
    if (data) {
      if (modalImg) {
        modalImg.src = data.img;
        modalImg.alt = category;
      }

      // render extra section (size / age / stage)
      if (extraSection) {
        if (data.extraOptions && Array.isArray(data.extraOptions)) {
          let extraHtml = `<h5 class="paddingTopMedium paddingBottomSmall">${data.extraTitle}</h5><div>`;
          data.extraOptions.forEach((opt, index) => {
            const id = `extra_${data.extraName}_${index}`;
            const isChecked = index === 0 ? 'checked' : '';
            extraHtml += `
              <input type="radio" class="btn-check" name="${data.extraName}" id="${id}" value="${opt}" autocomplete="off" ${isChecked}>
              <label class="btn" for="${id}">${opt}</label>
            `;
          });
          extraHtml += '</div>';
          extraSection.innerHTML = extraHtml;
        } else {
          extraSection.innerHTML = ''; // Don't show for categories like wipes
        }
      }

      // render type section or hide it completely if empty
      if (modalOptions && typeSection) {
        if (data.options && Array.isArray(data.options) && data.options.length > 0) {
          let optionsHtml = '';
          data.options.forEach((opt, index) => {
            const id = `opt_${category.replace(/\s+/g, '')}_${index}`;
            const isChecked = index === 0 ? 'checked' : '';
            optionsHtml += `
              <input type="radio" class="btn-check" name="type" id="${id}" value="${opt}" autocomplete="off" ${isChecked}>
              <label class="btn" for="${id}">${opt}</label>
            `;
          });
          modalOptions.innerHTML = optionsHtml;
          typeSection.style.display = 'block'; // Ensure visible
        } else {
          modalOptions.innerHTML = '';
          typeSection.style.display = 'none'; // Hide whole section (heading included)
        }
      }
    }
  });
});
</script>

<!-- Quantity selector -->
 <script>
function changeQty(delta) {
    let qty = document.getElementById('qty');
    let newVal = parseInt(qty.value) + delta;
    if (newVal >= parseInt(qty.min) && newVal <= parseInt(qty.max)) {
        qty.value = newVal;
    }
}
</script>