document.addEventListener('DOMContentLoaded', () => {
  // obtém os elementos DOM necessários
  const paymentMethod = document.querySelector('#payment_method');
  const changeAmountLabel = document.querySelector('label[for="change_amount_input"]');
  const changeAmountInput = document.querySelector('#change_amount_input');

  // adiciona um evento de escuta para o campo "Forma de pagamento"
  paymentMethod.addEventListener('change', () => {
    if (paymentMethod.value === 'cash') {
      // se a forma de pagamento selecionada for "Dinheiro", mostra o campo "Total em dinheiro"
      changeAmountLabel.style.display = 'block';
      changeAmountInput.style.display = 'block';
    } else {
      // se a forma de pagamento selecionada não for "Dinheiro", esconde o campo "Total em dinheiro"
      changeAmountLabel.style.display = 'none';
      changeAmountInput.style.display = 'none';
    }
  });

  // adiciona um evento de escuta para o formulário
  const checkoutForm = document.querySelector('#checkout-form');
  checkoutForm.addEventListener('submit', (event) => {
    if (paymentMethod.value === 'cash') {
      // se a forma de pagamento selecionada for "Dinheiro", valida o campo de troco
      const totalPrice = parseFloat(changeAmountInput.getAttribute('data-total-price'));
      const changeAmount = parseFloat(changeAmountInput.value);
      if (changeAmount < totalPrice) {
        event.preventDefault();
        alert('O troco deve ser igual ou superior ao valor total da compra.');
      }
    }
  });
});

  