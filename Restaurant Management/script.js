document.addEventListener('DOMContentLoaded', function () {
  const reservationForm = document.getElementById('reservation-form');
  const confirmationSection = document.getElementById('confirmation');

  reservationForm.addEventListener('submit', function (event) {
      event.preventDefault();

      // Simulate booking process (replace this with your actual booking logic)
      const isTableBooked = bookTable();

      if (isTableBooked) {
          // Show a confirmation message using an alert (you can replace this with a modal)
          alert('Table booked successfully!');
          // Optionally, you can clear the form or perform other actions
          reservationForm.reset();
      } else {
          alert('Sorry, the table is not available at the selected time. Please choose another time.');
      }
  });

  document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
          e.preventDefault();

          const targetId = this.getAttribute('href').substring(1);

          if (targetId === 'reservations') {
              const targetSection = document.getElementById(targetId);
              if (targetSection) {
                  targetSection.scrollIntoView({ behavior: 'smooth' });
              }
          } else {
              const targetSection = document.getElementById(targetId);
              if (targetSection) {
                  targetSection.scrollIntoView({ behavior: 'smooth' });
              }
          }
      });
  });

  // Simulate booking function (replace this with your actual booking logic)
  function bookTable() {
      // Implement your booking logic here
      // For demonstration purposes, let's assume the table is booked successfully
      return true;
  }
});
