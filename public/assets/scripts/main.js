const toggleCollapse = document.querySelector('.feature-card-collapse');
function collapseFeatureCards(_) {
  const expanded = this.getAttribute('aria-expanded');

  if (expanded === 'true') {
    this.innerHTML = `Lihat Lebih Sedikit &nbsp; <i class="fa fa-arrow-up" aria-hidden="true"></i>`;
  } else {
    this.innerHTML = `Lihat Lebih Banyak &nbsp; <i class="fa fa-arrow-down" aria-hidden="true"></i>`;
  }
};
toggleCollapse.addEventListener('click', collapseFeatureCards, false);