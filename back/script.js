document.addEventListener("DOMContentLoaded", function () {
    const voyagesContainer = document.getElementById("voyages");
    const panierContainer = document.getElementById("panier");
    const formAjout = document.getElementById("ajoutVoyageForm");
    let panier = [];

    // Fonction pour ajouter un voyage
    formAjout.addEventListener("submit", function (event) {
        event.preventDefault();
        const nom = document.getElementById("nomVoyage").value;
        const prix = document.getElementById("prixVoyage").value;
        
        if (nom && prix) {
            const voyage = { nom, prix };
            ajouterVoyage(voyage);
            document.getElementById("nomVoyage").value = "";
            document.getElementById("prixVoyage").value = "";
        }
    });

    function ajouterVoyage(voyage) {
        const card = document.createElement("div");
        card.classList.add("card", "p-3", "mb-2");
        card.innerHTML = `<strong>${voyage.nom}</strong> - ${voyage.prix}€
            <button class="btn btn-success btn-sm float-end" onclick="ajouterAuPanier('${voyage.nom}', ${voyage.prix})">Ajouter au panier</button>`;
        voyagesContainer.appendChild(card);
    }

    window.ajouterAuPanier = function (nom, prix) {
        panier.push({ nom, prix });
        afficherPanier();
    };

    function afficherPanier() {
        panierContainer.innerHTML = "";
        panier.forEach((item, index) => {
            const li = document.createElement("li");
            li.classList.add("list-group-item");
            li.innerHTML = `${item.nom} - ${item.prix}€ 
                <button class="btn btn-danger btn-sm float-end" onclick="supprimerDuPanier(${index})">Supprimer</button>`;
            panierContainer.appendChild(li);
        });
    }

    window.supprimerDuPanier = function (index) {
        panier.splice(index, 1);
        afficherPanier();
    };

    document.getElementById("viderPanier").addEventListener("click", function () {
        panier = [];
        afficherPanier();
    });
});