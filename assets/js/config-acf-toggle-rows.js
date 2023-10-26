(() => {
	document.addEventListener("DOMContentLoaded", () => {
		const acfPostBox = document.querySelectorAll('.acf-postbox');
		if (!acfPostBox.length) return null;
		
		acfPostBox.forEach(postBox => {
			const noConfig = postBox.querySelector('.httfox_no_toggle_all');
			const rows = postBox.querySelectorAll('.acf-row');
			
			if (rows.length && !noConfig) {
				const header = postBox.querySelector('.postbox-header');
				const h2 = header.querySelector('h2');
				
				const contentButton = `
					<button class="httfox_acf_close_all" style="margin-right: 20px; cursor: pointer;">Recolher tudo</button>
					<button class="httfox_acf_open_all" style="margin-right: 20px; cursor: pointer;">Abrir tudo</button>
				`;
				
				h2.insertAdjacentHTML('afterend', contentButton);
				
				const btnClose = postBox.querySelector('.httfox_acf_close_all');
				const btnOpen = postBox.querySelector('.httfox_acf_open_all');
				if (!btnClose || !btnOpen) return null;
				
				btnClose.addEventListener('click', (e) => toggleAll(e, rows));
				btnOpen.addEventListener('click', (e) => toggleAll(e, rows, true));
			}
		});
		
		function toggleAll(e, rows, open = false) {
			e.preventDefault();
			
			rows.forEach(row => {
				if (!open) row.classList.add('-collapsed');
				else row.classList.remove('-collapsed');
			});
		}
  });
})();