document.addEventListener("DOMContentLoaded", () => {
    const calendarGrid = document.querySelector(".calendar-grid");
    const monthYearDisplay = document.getElementById("calendar-month-year");
    const programmingPopup = document.getElementById("programming-popup");
    const programmingForm = document.getElementById("programming-form");
    const filmSelect = document.getElementById("film");
    let currentMonth = new Date();
    let filmData = {}; // Stockage des films programmés

    // Fonction pour récupérer les films programmés
    async function fetchFilms() {
        try {
            const response = await fetch('/api/getFilms');
            filmData = await response.json();
            generateCalendar(currentMonth);
        } catch (error) {
            console.error("Erreur lors de la récupération des films :", error);
        }
    }

    // Générer le calendrier
    function generateCalendar(date) {
        calendarGrid.innerHTML = "";
        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            calendarGrid.innerHTML += "<div class='day'></div>";
        }

        for (let day = 1; day <= lastDate; day++) {
            const dateKey = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const dayCell = `<div class='day ${filmData[dateKey] ? "event" : ""}' data-date="${dateKey}">${day}</div>`;
            calendarGrid.innerHTML += dayCell;
        }

        monthYearDisplay.textContent = date.toLocaleString("fr-FR", { month: "long", year: "numeric" });
    }

    // Navigation dans le calendrier
    document.querySelector(".prev-month").addEventListener("click", () => {
        currentMonth.setMonth(currentMonth.getMonth() - 1);
        generateCalendar(currentMonth);
    });

    document.querySelector(".next-month").addEventListener("click", () => {
        currentMonth.setMonth(currentMonth.getMonth() + 1);
        generateCalendar(currentMonth);
    });

    // Gestion de la popup de programmation
    document.querySelector(".bouton").addEventListener("click", () => {
        programmingPopup.style.display = "block";
    });

    function closeProgrammingPopup() {
        programmingPopup.style.display = "none";
    }

    // Soumission du formulaire
    programmingForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(programmingForm);
        try {
            const response = await fetch('/planning/store', {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();
            alert(`Film "${data.film}" programmé avec succès.`);
            closeProgrammingPopup();
            fetchFilms();
        } catch (error) {
            console.error("Erreur lors de la programmation :", error);
            alert("Une erreur est survenue.");
        }
    });

    // Initialisation
    fetchFilms();
});
