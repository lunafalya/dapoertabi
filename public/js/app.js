console.log("JS connect!");

// ================= INIT =================
document.addEventListener('DOMContentLoaded', function () {

  // ================= QTY =================
  document.querySelectorAll('.qty-box').forEach(box => {
    const minus = box.querySelector('.minus');
    const plus = box.querySelector('.plus');
    const value = box.querySelector('.qty-value');

    minus?.addEventListener('click', () => {
      let count = parseInt(value.textContent);
      if (count > 1) {
        value.textContent = count - 1;
        updateTotal();
      }
    });

    plus?.addEventListener('click', () => {
      let count = parseInt(value.textContent);
      value.textContent = count + 1;
      updateTotal();
    });
  });

  // ================= PROFILE DROPDOWN =================
  const profileBtn = document.getElementById('profileBtn');
  const dropdownMenu = document.getElementById('dropdownMenu');

  profileBtn?.addEventListener('click', function (event) {
    event.stopPropagation();
    dropdownMenu?.classList.toggle('show');
  });

  window.addEventListener('click', function (event) {
    if (dropdownMenu && !dropdownMenu.contains(event.target) && event.target !== profileBtn) {
      dropdownMenu.classList.remove('show');
    }
  });

  // ================= CAROUSEL =================
  const carousel = document.querySelector('.carousel');
  const nextBtn = document.querySelector('.carousel-btn.next');
  const prevBtn = document.querySelector('.carousel-btn.prev');

  const scrollStep = 350;

  nextBtn?.addEventListener('click', () => {
    carousel?.scrollBy({ left: scrollStep, behavior: 'smooth' });
  });

  prevBtn?.addEventListener('click', () => {
    carousel?.scrollBy({ left: -scrollStep, behavior: 'smooth' });
  });

  // ================= NAV SCROLL =================
  const waveNav = document.querySelector('.wave-nav');

  window.addEventListener('scroll', () => {
    if (waveNav) {
      waveNav.classList.toggle('visible', window.scrollY > 20);
    }
  });

  // ================= SERVICE FILTER =================
  const filterTabs = document.querySelectorAll('.service-filter li');
  const serviceItems = document.querySelectorAll('.service-item');

  filterTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      filterTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      const filter = tab.getAttribute('data-filter');

      serviceItems.forEach(item => {
        const itemType = item.getAttribute('data-category');
        const isMatch = filter === 'all' || (itemType && itemType.includes(filter));

        item.style.display = isMatch ? 'block' : 'none';
      });
    });
  });

  // ================= MENU FILTER =================
  const menuItems = document.querySelectorAll('.menu-item');
  const grid = document.querySelector('.menu-grid');
  const cards = Array.from(document.querySelectorAll('.menu-card'));

  menuItems.forEach(item => {
    item.addEventListener('click', () => {

      menuItems.forEach(i => i.classList.remove('active'));
      item.classList.add('active');

      const category = item.getAttribute('data-category');

      grid.innerHTML = "";

      cards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');

        if (category === 'all' || category === cardCategory) {
          grid.appendChild(card);
          card.style.display = 'block';
        }
      });

    });
  });

  // ================= SEARCH OVERLAY =================
  const overlay = document.getElementById('searchOverlay');
  const openBtn = document.getElementById('openSearch');
  const closeBtn = document.querySelector('.close-search');
  const input = document.querySelector('.search-box input');

  openBtn?.addEventListener('click', () => {
    overlay?.classList.add('active');

    setTimeout(() => {
      input?.focus();
    }, 200);
  });

  closeBtn?.addEventListener('click', () => {
    overlay?.classList.remove('active');
  });

  overlay?.addEventListener('click', (e) => {
    if (e.target === overlay) {
      overlay.classList.remove('active');
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      overlay?.classList.remove('active');
    }
  });

  // ================= CHECKBOX =================
  document.addEventListener('click', function (e) {
    if (e.target.closest('.check-wrapper')) {
      const wrapper = e.target.closest('.check-wrapper');
      const checkbox = wrapper.querySelector('.item-check');

      checkbox.checked = !checkbox.checked;
      updateTotal();
    }
  });

  // init total
  updateTotal();

});


// ================= TOTAL =================
function formatRupiah(number) {
  return "Rp. " + number.toLocaleString("id-ID");
}

function updateTotal() {
  let grandTotal = 0;

  document.querySelectorAll('.cart-item').forEach(item => {
    const checkbox = item.querySelector('.item-check');
    const priceEl = item.querySelector('.cart-price');
    const qtyEl = item.querySelector('.qty-value');
    const totalEl = item.querySelector('.cart-total');

    if (!checkbox || !priceEl || !qtyEl || !totalEl) return;

    const price = parseInt(priceEl.dataset.price);
    const qty = parseInt(qtyEl.textContent);
    const total = price * qty;

    totalEl.textContent = formatRupiah(total);

    if (checkbox.checked) {
      grandTotal += total;
    }
  });

  const grand = document.querySelector('.cart-summary-total');
  if (grand) {
    grand.textContent = formatRupiah(grandTotal);
  }
}

// ================= LOAD SELECTED PRODUCTS =================
function loadSelectedProducts() {
  let result = [];

  document.querySelectorAll('.cart-item').forEach(item => {
    const checkbox = item.querySelector('.item-check');

    if (checkbox && checkbox.checked) {
      const name = item.querySelector('.cart-name')?.textContent;
      const qty = item.querySelector('.qty-value')?.textContent;

      result.push(`${name} (${qty})`);
    }
  });

  const input = document.getElementById('selectedProducts');
  if (input) {
    input.value = result.join(', ');
  }
}

document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".rating-stars .star");
    const ratingInput = document.getElementById("ratingValue");

    stars.forEach((star, index) => {
        star.addEventListener("click", function () {
            // Set rating berdasarkan index (index mulai dari 0 → jadi +1)
            const rating = index + 1;
            ratingInput.value = rating; // update input hidden

            // Update tampilan bintang
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add("active");
                } else {
                    s.classList.remove("active");
                }
            });
        });
    });
});

// jalanin pas load
loadSelectedProducts();

    document.addEventListener('DOMContentLoaded', function() {
        const tabItems = document.querySelectorAll('.tab-item');
        const tabContents = document.querySelectorAll('.tab-content');

        tabItems.forEach(item => {
            item.addEventListener('click', function() {
                tabItems.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const targetTab = this.getAttribute('data-tab');
                tabContents.forEach(content => content.classList.remove('active'));
                document.getElementById(targetTab + '-content').classList.add('active');
            });
        });
    });

   

  document.addEventListener("DOMContentLoaded", function () {

  const button = document.getElementById("addtocartButton");
  const popup = document.getElementById("cart-popup");

  if (!button || !popup) return;

  button.addEventListener("click", function () {

    popup.classList.add("show");

    setTimeout(() => {
      popup.classList.remove("show");
    }, 2000);

  });

});

 // ================= QTY IN DETAIL =================
  document.querySelectorAll('.qty-box1').forEach(box => {
    const minus = box.querySelector('.minus');
    const plus = box.querySelector('.plus');
    const value = box.querySelector('.qty-value1');

    minus?.addEventListener('click', () => {
      let count = parseInt(value.textContent);
      if (count > 1) {
        value.textContent = count - 1;
        updateTotal();
      }
    });

    plus?.addEventListener('click', () => {
      let count = parseInt(value.textContent);
      value.textContent = count + 1;
      updateTotal();
    });
  });