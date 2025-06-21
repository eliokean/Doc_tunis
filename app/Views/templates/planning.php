<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des Films</title>
    <link rel="stylesheet" href="/assets/css/planning.css">
</head>
    <!-- En-tête -->
<header class="navbar">
    <div class="logo">
        <img src="/assets/images/logo_doc_Tunis-removebg-preview.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="/dashboard">Accueil</a></li>
            <li><a href="/film">Films</a></li>
            <li><a href="/planning" class="active">Planning</a></li>
            <li><a href="/resultats">Résultats</a></li>
        </ul>
    </nav>
    <div class="nav-right">
        <input type="text" placeholder="Rechercher un film">
        <button>Rechercher</button>
    </div>
    <div class="user-menu">
            <div class="user-info">
                <img src="/assets/images/user.png" alt="User Icon" class="user-avatar">
                <span class="user-name">
                    <?= session()->get('email') ? session()->get('email') : 'Utilisateur'; ?>
                </span>
                <i class="dropdown-icon">▼</i>
            </div>
            <ul class="dropdown-menu">
                <li><i class="profile-icon">👤</i> Profil</li>
                <li><a href="/logout"><i class="logout-icon">⏻</i> Déconnexion</a></li>
            </ul>
    </div>
</header>


    <!-- Conteneur principal -->
    <div class="planning-container">
        <h1>Planning des Films</h1>
        <div class="view-switcher">
            <button class="active" data-view="calendar">Mensuel</button>
            <button data-view="weekly">Hebdomadaire</button>
            <button data-view="daily">Journalier</button>
        </div>

        <!-- Vue mensuelle -->
        <div class="calendar active">
            <div class="calendar-header">
                <button class="prev-month">◀</button>
                <h2 id="calendar-month-year"></h2>
                <button class="next-month">▶</button>
            </div>
            <div class="calendar-grid"></div>
        </div>

        <!-- Popup pour voir les films programmés -->
        

        <!-- Vue hebdomadaire -->
        <div class="weekly-view">
            <div class="movie">
                <img src="/images/b.jpeg" alt="Mortal Engines">
                <div class="movie-details">
                    <h3>Mortal Engines 16+</h3>
                    <p>120 min | Adventure</p>
                    <div class="days">
                        <span>Monday 17 Feb</span>
                        <span>Tuesday 18 Feb</span>
                        <span>Wednesday 19 Feb</span>
                        <span>Thursday 20 Feb</span>
                        <span>Friday 21 Feb</span>
                        <span>Saturday 22 Feb</span>
                        <span>Sunday 23 Feb</span>
                    </div>
                    <div class="times">
                        <button>11:30 am</button>
                        <button>5:00 pm</button>
                        <button>7:45 pm</button>
                        <button>9:45 pm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vue journalière -->
        <div class="daily-view">
            <h2 id="daily-title">Films du 3 Novembre</h2>
            <div class="movie" id="daily-movie-list">
                <!-- Les films seront insérés ici dynamiquement -->
            </div>
        </div>
    </div>

    <!-- Popup pour voir les films programmés -->
    <div class="popup" id="popup">
        <button class="close-btn" onclick="closePopup()">×</button>
        <h3 id="popup-title">Films programmés</h3>
        <div id="popup-content"></div>
    </div>


    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const viewButtons = document.querySelectorAll(".view-switcher button");
    const views = {
        calendar: document.querySelector(".calendar"),
        weekly: document.querySelector(".weekly-view"),
        daily: document.querySelector(".daily-view")
    };

    // Changer de vue
    viewButtons.forEach(button => {
        button.addEventListener("click", () => {
            viewButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            Object.keys(views).forEach(view => {
                views[view].classList.remove("active");
            });
            views[button.dataset.view].classList.add("active");
        });
    });

    let filmData = {};

    // Générer la vue mensuelle
    const calendarGrid = document.querySelector(".calendar-grid");
    const monthYearDisplay = document.getElementById("calendar-month-year");
    const prevMonthButton = document.querySelector(".prev-month");
    const nextMonthButton = document.querySelector(".next-month");

    fetch('/api/getPlanningWithFilms') // URL qui pointe vers le contrôleur
        .then(response => response.json())
        .then(data => {
            filmData = data;
            generateCalendar(new Date()); // Passer le mois actuel
        });

    let currentMonth = new Date();

    function generateCalendar(date) {
        calendarGrid.innerHTML = ""; // Réinitialisation
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

    prevMonthButton.addEventListener("click", () => {
        currentMonth.setMonth(currentMonth.getMonth() - 1);
        generateCalendar(currentMonth);
    });

    nextMonthButton.addEventListener("click", () => {
        currentMonth.setMonth(currentMonth.getMonth() + 1);
        generateCalendar(currentMonth);
    });

    calendarGrid.addEventListener("click", (e) => {
        if (e.target.classList.contains("day")) {
            const dateKey = e.target.dataset.date;
            openPopup(dateKey); // Ouvre le modal avec les films
        }
    });

    function openPopup(dateKey) {
        const films = filmData[dateKey] || [];
        const popupContent = document.getElementById("popup-content");
        const popupTitle = document.getElementById("popup-title");

        if (films.length > 0) {
            popupTitle.textContent = `Films programmés pour le ${new Date(dateKey).toLocaleDateString("fr-FR", { weekday: "long", day: "numeric", month: "long", year: "numeric" })}`;
            popupContent.innerHTML = films.map(film => `
                <div class="movie">
                    <img src="${film.image}" alt="${film.title}">
                    <div>
                        <h3>${film.title}</h3>
                        <p>${film.heure} - ${film.lieu}</p>
                    </div>
                </div>
            `).join('');
        } else {
            popupTitle.textContent = `Aucun film pour le ${new Date(dateKey).toLocaleDateString("fr-FR", { weekday: "long", day: "numeric", month: "long", year: "numeric" })}`;
            popupContent.innerHTML = "<p>Aucun film programmé pour cette date.</p>";
        }

        document.getElementById("popup").style.display = "block";
    }

    generateCalendar(currentMonth);
});

// Déclaration globale de la fonction closePopup
function closePopup() {
    const popup = document.getElementById("popup");
    console.log("Fermeture du popup");
    if (popup) {
        popup.style.display = "none";
    } else {
        console.error("Élément popup introuvable !");
    }
}

    </script>
</body>
</html>
