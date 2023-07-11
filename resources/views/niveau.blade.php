
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    <title>Document</title>
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container w-50 fs-4 ">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="d-flex justify-content-center align-items-center fs-1"><strong>Listes des Niveaux</strong></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const accordion = document.querySelector("#accordionFlushExample");

        fetch("http://127.0.0.1:8000/breukh-api/voirniveau", {
                method: 'GET',
                mode: 'cors',
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                createNivau(data, accordion);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function createNivau(tab, classe) {
            classe.innerHTML = '';
            classe.innerHTML = `<div class="d-flex justify-content-center align-items-center fs-1"> <strong>Listes des Niveaux</strong></div>`;
            let i = 0;
            tab.forEach(d => {

                let div = document.createElement("div");
                div.classList.add("accordion-item");
                div.innerHTML += `
        <h2 class="accordion-header" id="flush-heading${i}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${i}" aria-expanded="false" aria-controls="flush-collapseOne">
                ${d.nom}
            </button>
        </h2>`
                classe.appendChild(div);
                createClasse(d.classes, classe, i);
                i++;

            });
        }

        function createClasse(tab, classe, i) {
    let div = document.createElement("div");
    div.classList.add("accordion-collapse", "collapse");
    div.setAttribute("id", "flush-collapse" + i);
    div.setAttribute("aria-labelledby", "flush-heading" + i);
    div.setAttribute("data-bs-parent", "#accordionFlushExample");
    
    tab.forEach(d => {
        let a = document.createElement("a");
        a.setAttribute("href", "#");
        a.classList.add("class-link"); // Ajout de la classe "class-link" au lien
        a.innerHTML = `<h1>${d.nom}</h1>`;
        
        let accordionBody = document.createElement("div");
        accordionBody.classList.add("accordion-body");
        accordionBody.appendChild(a);
        
        div.appendChild(accordionBody);
    });
    
    classe.appendChild(div);

    // Sélectionner tous les liens de classe
    const classLinks = document.querySelectorAll('.class-link');

    // Parcourir chaque lien de classe
    classLinks.forEach(link => {
        // Ajouter un événement de survol pour changer la couleur
        link.addEventListener('mouseover', () => {
            link.style.color = 'blue';
        });

        // Ajouter un événement de sortie pour réinitialiser la couleur
        link.addEventListener('mouseout', () => {
            link.style.color = 'black';
        });
    });
}

    </script>
</body>

</html>
