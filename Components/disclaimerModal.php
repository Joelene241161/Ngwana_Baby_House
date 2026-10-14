<!-- Student project, disclaimer modal -->
<div class="modal fade" id="studentDisclaimerModal" tabindex="-1" aria-labelledby="studentDisclaimerLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="studentDisclaimerLabel">Disclaimer</h2>
      </div>
      <div class="modal-body">
        <p class="mb-0">Please note that this website is created strictly as a <strong>student project</strong> for educational purposes. All content and features are for demonstration only.</p>
      </div>
      <div class="modal-footer">
        <button id="acceptDisclaimerBtn" class="primaryButton buttonText">I understand</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const modalElement = document.getElementById("studentDisclaimerModal");
  
  // Check if the disclaimer has already been acknowledged
  if (!localStorage.getItem("studentProjectDisclaimerShown")) {
    const disclaimerModal = new bootstrap.Modal(modalElement);
    disclaimerModal.show();
  }

  // close button
  document.getElementById("acceptDisclaimerBtn").addEventListener("click", function () {
    localStorage.setItem("studentProjectDisclaimerShown", "true");
    
    // Hide modal
    const disclaimerModal = bootstrap.Modal.getInstance(modalElement);
    disclaimerModal.hide();
  });
});
</script>