const toastEl = document.querySelector('.toast');
const myToast = new bootstrap.Toast(toastEl, { delay: 10000 });

if (successMessage) {
  const toastBodyEl = toastEl.querySelector('.toast-body');
  toastBodyEl.textContent = successMessage;

  myToast.show();
}
