const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

const prevButton = document.getElementById('prevMonth');
const nextButton = document.getElementById('nextMonth');

prevButton.addEventListener('click', () => changeMonth(-1));
nextButton.addEventListener('click', () => changeMonth(1));

renderCalendar(currentMonth, currentYear);

function renderCalendar(month, year) {
    const monthYear = document.getElementById('monthYear');
    monthYear.textContent = `${monthNames[month]} ${year}`;

    const calendarBody = document.getElementById('calendarBody');
    calendarBody.innerHTML = '';  // Clear previous content

    const firstDay = new Date(year, month).getDay();
    const totalDays = new Date(year, month + 1, 0).getDate();

    let date = 1;
    for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');

        for (let j = 0; j < 7; j++) {
            const cell = document.createElement('td');
            if (i === 0 && j < firstDay) {
                cell.textContent = '';
            } else if (date > totalDays) {
                break;
            } else {
                cell.textContent = date;
                date++;
            }
            row.appendChild(cell);
        }
        calendarBody.appendChild(row);
    }
}

function changeMonth(step) {
    currentMonth += step;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar(currentMonth, currentYear);
}
