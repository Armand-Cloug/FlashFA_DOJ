function showSection(section) {
    // Sélectionne toutes les sections
    const penalSection = document.getElementById("penal-section");
    const travailSection = document.getElementById("travail-section");
    const proceduresSection = document.getElementById("procedures-section");
    const peineSection = document.getElementById("peine-section");
    const civilSection = document.getElementById("civil-section");

    // Sélectionne tous les boutons
    const buttons = document.querySelectorAll(".toggle-btn");

    // Cache toutes les sections
    penalSection.classList.add("hidden");
    travailSection.classList.add("hidden");
    proceduresSection.classList.add("hidden");
    peineSection.classList.add("hidden");
    civilSection.classList.add("hidden");

    // Affiche la bonne section
    if (section === "penal") {
        penalSection.classList.remove("hidden");
    } else if (section === "travail") {
        travailSection.classList.remove("hidden");
    } else if (section === "procedures") {
        proceduresSection.classList.remove("hidden");
    } else if (section === "peine") {
        peineSection.classList.remove("hidden");
    } else {
        civilSection.classList.remove("hidden");
    }

    // Met à jour les boutons actifs
    buttons.forEach(btn => btn.classList.remove("active"));
    document.querySelector(`[onclick="showSection('${section}')"]`).classList.add("active");
}