document.addEventListener("DOMContentLoaded", function() {
    const calendarContainer = document.getElementById("calendar");
    const calendarMonth = document.getElementById("calendar-month");
    const prevMonthButton = document.getElementById("prev-month");
    const nextMonthButton = document.getElementById("next-month");
    // const selectedDateContainer = document.getElementById("selected-date");
    const currentDateElement = document.getElementById("current-date");
    const currentTimeElement = document.getElementById("current-time");
  
    let currentDate = new Date();
    let selectedDate = null;
  
    // Function to generate the calendar for the current month
    function generateCalendar() {
      const month = currentDate.getMonth();
      const year = currentDate.getFullYear();
      const firstDayOfMonth = new Date(year, month, 1);
      const lastDayOfMonth = new Date(year, month + 1, 0);
      const numDaysInMonth = lastDayOfMonth.getDate();
      const startDay = firstDayOfMonth.getDay(); // Day of the week the month starts on
      
      // Clear the existing calendar
      calendarContainer.innerHTML = '';
      
      // Set the month name in the header
      calendarMonth.textContent = firstDayOfMonth.toLocaleString('default', { month: 'long' }) + " " + year;
      
      // Add empty divs for the days before the 1st day of the month
      for (let i = 0; i < startDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("empty");
        calendarContainer.appendChild(emptyCell);
      }
  
      // Create the day cells for the current month
      for (let day = 1; day <= numDaysInMonth; day++) {
        const dayCell = document.createElement("div");
        dayCell.textContent = day;
        dayCell.classList.add("calendar-day");
        dayCell.addEventListener("click", () => selectDate(day));
        
        // Highlight selected date
        if (selectedDate && selectedDate.getDate() === day && selectedDate.getMonth() === month && selectedDate.getFullYear() === year) {
          dayCell.classList.add("selected");
        }
  
        // Highlight current date
        const today = new Date();
        if (today.getDate() === day && today.getMonth() === month && today.getFullYear() === year) {
          dayCell.classList.add("current-day"); // Add class for current day
        }
  
        calendarContainer.appendChild(dayCell);
      }
    }




  
    function selectDate(day) {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
    
        // Adjust the day to ensure it doesn't overflow into the next month
        const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
    
        if (day > lastDayOfMonth) {
            console.error("Invalid day selection for this month.");
            return;  // Exit if the day is out of range
        }
        // Set the selectedDate to midnight to avoid time zone issues
        selectedDate = new Date(year, month, day, 0, 0, 0, 0);  // Set time to 00:00:00.000 (midnight)
    
        // If the date falls on the next month due to overflow, reset it to the last valid day of the current month
        if (selectedDate.getDate() !== day) {
            selectedDate = new Date(year, month, lastDayOfMonth, 0, 0, 0, 0);  // Set to midnight
        }
    
        // selectedDateContainer.textContent = `${selectedDate.toDateString()}`;
    
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/new-booking';
    
        // Create the date input field
        const dateInput = document.createElement('input');
        dateInput.type = 'text';
        dateInput.name = 'selected_date';
        dateInput.value = `${selectedDate.toDateString()}`;  // Send the selected date as ISO string
        form.appendChild(dateInput);
        console.log(dateInput.value);
    
        const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
        if (csrfMetaTag) {
            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = csrfMetaTag.getAttribute('content');
            form.appendChild(csrfTokenInput);
        } else {
            console.error("CSRF token meta tag is missing.");
            return;  // Abort form submission if CSRF token is missing
        }
    
        document.body.appendChild(form);
        form.submit();
    
        document.body.removeChild(form);
        generateCalendar();
    }
    
    
    
    









    
    
    
  
    // Event listeners for next and previous month buttons
    prevMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      generateCalendar();
    });
  
    nextMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      generateCalendar();
    });
  
    // Function to update the current date and time
    function updateCurrentDateTime() {
      const now = new Date();
      
      // Update current date
      const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      currentDateElement.textContent = now.toLocaleDateString('en-US', dateOptions);
  
      // Update current time
      const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
      currentTimeElement.textContent = now.toLocaleTimeString('en-US', timeOptions);
    }
  
    // Initialize the calendar
    generateCalendar();
  
    // Update current date and time every second
    setInterval(updateCurrentDateTime, 1000);
  
    // Initial date and time update
    updateCurrentDateTime();
  });
  