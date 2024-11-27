(function(){

	'use strict'


	var siteMenuClone = function() {
		var jsCloneNavs = document.querySelectorAll('.js-clone-nav');
		var siteMobileMenuBody = document.querySelector('.site-mobile-menu-body');
		


		jsCloneNavs.forEach(nav => {
			var navCloned = nav.cloneNode(true);
			navCloned.setAttribute('class', 'site-nav-wrap');
			siteMobileMenuBody.appendChild(navCloned);
		});

		setTimeout(function(){

			var hasChildrens = document.querySelector('.site-mobile-menu').querySelectorAll(' .has-children');

			var counter = 0;
			hasChildrens.forEach( hasChild => {
				
				var refEl = hasChild.querySelector('a');

				var newElSpan = document.createElement('span');
				newElSpan.setAttribute('class', 'arrow-collapse collapsed');

				// prepend equivalent to jquery
				hasChild.insertBefore(newElSpan, refEl);

				var arrowCollapse = hasChild.querySelector('.arrow-collapse');
				arrowCollapse.setAttribute('data-bs-toggle', 'collapse');
				arrowCollapse.setAttribute('data-bs-target', '#collapseItem' + counter);

				var dropdown = hasChild.querySelector('.dropdown');
				dropdown.setAttribute('class', 'collapse');
				dropdown.setAttribute('id', 'collapseItem' + counter);

				counter++;
			});

		}, 1000);


		// Click js-menu-toggle

		var menuToggle = document.querySelectorAll(".js-menu-toggle");
		var mTog;
		menuToggle.forEach(mtoggle => {
			mTog = mtoggle;
			mtoggle.addEventListener("click", (e) => {
				if ( document.body.classList.contains('offcanvas-menu') ) {
					document.body.classList.remove('offcanvas-menu');
					mtoggle.classList.remove('active');
					mTog.classList.remove('active');
				} else {
					document.body.classList.add('offcanvas-menu');
					mtoggle.classList.add('active');
					mTog.classList.add('active');
				}
			});
		})



		var specifiedElement = document.querySelector(".site-mobile-menu");
		var mt, mtoggleTemp;
		document.addEventListener('click', function(event) {
			var isClickInside = specifiedElement.contains(event.target);
			menuToggle.forEach(mtoggle => {
				mtoggleTemp = mtoggle
				mt = mtoggle.contains(event.target);
			})

			if (!isClickInside && !mt) {
				if ( document.body.classList.contains('offcanvas-menu') ) {
					document.body.classList.remove('offcanvas-menu');
					mtoggleTemp.classList.remove('active');
				}
			}

		});

	}; 
	siteMenuClone();


	// User Dropdown functionality
	document.addEventListener('DOMContentLoaded', function() {
		const userDropdownToggle = document.getElementById('userDropdownToggle');
		const userDropdownMenu = document.getElementById('userDropdownMenu');
		
		if (userDropdownToggle && userDropdownMenu) {
			// Toggle dropdown saat icon user diklik
			userDropdownToggle.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				userDropdownMenu.classList.toggle('show');
			});
			
			// Tutup dropdown ketika mengklik di luar
			document.addEventListener('click', function(e) {
				if (!userDropdownToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
					userDropdownMenu.classList.remove('show');
				}
			});
		}
		
		// Handle logout
		const logoutForm = document.getElementById('logoutForm');
		if (logoutForm) {
			logoutForm.addEventListener('submit', function(e) {
				e.preventDefault();
				
				fetch('/logout', {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
						'Accept': 'application/json'
					},
					credentials: 'same-origin'
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						window.location.href = '/';
					}
				})
				.catch(error => {
					console.error('Error:', error);
				});
			});
		}

		// Fungsi untuk dropdown kategori
		const categoryTrigger = document.querySelector('.category__trigger');
		const dropdownContent = document.querySelector('.dropdown-content');
		
		function toggleDropdown() {
			if (dropdownContent.classList.contains('show')) {
				dropdownContent.classList.remove('show');
				setTimeout(() => {
					dropdownContent.style.display = 'none';
				}, 300); // Sesuaikan dengan durasi animasi
			} else {
				dropdownContent.style.display = 'block';
				// Trigger reflow
				dropdownContent.offsetHeight;
				dropdownContent.classList.add('show');
			}
		}

		// Event listener untuk click di kategori
		if (categoryTrigger) {
			categoryTrigger.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				toggleDropdown();
			});
		}

		// Menutup dropdown ketika mengklik di luar
		document.addEventListener('click', function(e) {
			if (!categoryTrigger.contains(e.target) && !dropdownContent.contains(e.target)) {
				dropdownContent.style.display = 'none';
			}
		});
	});

})()