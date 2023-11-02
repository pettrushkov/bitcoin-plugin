(function () {
	document.addEventListener("DOMContentLoaded", () => {

		bitcoin(); // run on page load
		setInterval(bitcoin, 60000); // set interval (1 min)
		fetchRates(); // on button click

	});
})();

/**
 * Manual call API bitcoin rate by button click
 */
const fetchRates = () => {
	const btns = document.querySelectorAll('.bitcoin-rate-fetch');

	btns.forEach(btn => {
		btn.addEventListener('click', () => {
			bitcoin();

			// Disable btn to prevent multiple pending quieries.
			btn.disabled = true;
		});
	});
}

const bitcoin = async () => {
	const url = "https://api.coindesk.com/v1/bpi/currentprice.json";

	try {
		const response = await fetch(url);
		const json = await response.json();
		const currencyRates = json.bpi;

		pasteBitcoinRate(currencyRates);
	} catch (error) {
		console.warn("Bitcoin Price API error:", error);
	}
}

const pasteBitcoinRate = (currencyRates) => {
	const section = document.querySelectorAll('.bitcoin-rate');

	// If section with rate not exist - exit from function.
	if (!section) { return false; }

	section.forEach(async section => {
		for (const [key, value] of Object.entries(currencyRates)) {
			// Get field of section for key
			const currencyField = section.querySelector('.bitcoin-rate-item--' + key.toLowerCase() + ' .bitcoin-rate-item-value');

			// If section hasn't field for key - go to next 
			if (!currencyField) {
				continue;
			}

			// New value 
			const rateFloat = roundNumber(value.rate_float);

			// Do nothing if field has '...' value before.
			if (currencyField.innerText != '...') {
				// If new value less than old - add 'down' class or if it more than old - add class 'up'.
				if (currencyField.innerText > rateFloat) {
					currencyField.classList.add('down');
				} else if (currencyField.innerText < rateFloat) {
					currencyField.classList.add('up');
				}
			}

			// Paste new value.
			currencyField.innerText = rateFloat;

			// Remove added 'up' or 'down' classes, which added before after 1 sec.
			setTimeout(() => {
				currencyField.classList.remove('down', 'up');
			}, 1000);

			const btn = section.querySelector('.bitcoin-rate-fetch');

			// Enable btn - it could be disabled to prevent multiple pending quieries.
			btn.disabled = false;
		}
	});
}

const roundNumber = (number) => {
	// Remove the comma and parse the number
	const parsedNumber = parseFloat(number.toString().replace(/,/g, ''));

	// Round to two decimal places
	const roundedNumber = parsedNumber.toFixed(2);

	// Add back the comma for formatting
	return new Intl.NumberFormat('en-US').format(roundedNumber);
}