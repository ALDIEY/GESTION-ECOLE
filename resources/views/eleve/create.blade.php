<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    

<!-- Votre code HTML, en-tête, etc. -->

<form action="" method="POST">
    @csrf

    

    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" class="form-control">
    </div>

    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" class="form-control">
    </div>
    <div class="form-group">
    <label for="datenaissance">Date de naissance :</label>
    <input type="date" name="datenaissance" id="datenaissance" class="form-control">
</div>
<div class="form-group">
    <label for="lieunaissance">Lieu de naissance :</label>
    <input type="text" name="lieu" id="lieu" class="form-control">
</div>
<div class="form-group">
    <label for="sexe">Sexe :</label>
    <select name="sexe" id="sexe" class="form-control">
        <option value="">Sélectionner le sexe</option>
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
    </select>
</div>
<div class="form-group">
    <label for="profil">Profil :</label>
    <select name="profil" id="profil" class="form-control">
        <option value="">Sélectionner le profil</option>
        <option value="0">Internat</option>
        <option value="1">Externat</option>
    </select>
</div>
<div class="form-group">
        <label for="niveau">Niveau :</label>
        <select name="niveau_id" id="niveau" class="form-control">
            <option value="">Sélectionner un niveau</option>
            @foreach ($niveaux as $niveau)
                <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="classe">Classe :</label>
        <select name="classe_id" id="classe" class="form-control">
            <option value="">Sélectionner une classe</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    const niveauSelect = document.getElementById('niveau');
    const classeSelect = document.getElementById('classe');

    niveauSelect.addEventListener('change', () => {
        const selectedNiveauId = niveauSelect.value;

        
        classeSelect.innerHTML = '<option value="">Sélectionner une classe</option>';

        
        if (selectedNiveauId) {
            fetch(`http://127.0.0.1:8000/breukh-api/classes/${selectedNiveauId}`)
                .then(response => response.json())
                .then(data => {
                    // Ajouter les options de classe correspondantes
                    data.forEach(classe => {
                        const option = document.createElement('option');
                        option.value = classe.id;
                        option.textContent = classe.nom;
                        classeSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des classes:', error);
                });
        }
    });
</script>
<!-- Votre code HTML, pied de page, etc. -->
</body>
</html>