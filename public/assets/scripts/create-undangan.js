const createUndanganForm = '#createUndanganForm';
const submitEvent = 'submit';

document.querySelector(createUndanganForm).addEventListener(submitEvent, function (e) {
  e.preventDefault();

  window.location.href = '/dashboard/after-create.html';
});