<main class="modif-etudiant-main">
    <div class="modif-etudiant-container1">
        <img alt="image" src="../public/img\_20240204\_164524032\~2-200w.jpg" class="modif-etudiant-image" />
        <div>
            <button type="button" class="modif-etudiant-button button">Modifier l'image</button>
        </div>
        <div>
            <button type="button" class="modif-etudiant-button1 button">POSTER</button>
        </div>
    </div>
    <div class="modif-etudiant-main-text-content">
        <div class="modif-etudiant-container2">
            <input type="text" placeholder="Nom de l'étudiant" autocomplete="new-password"
                class="modif-etudiant-nom-etudiant input" />
            <input type="text" placeholder="Prénom de l'étudiant" autocomplete="new-password"
                class="modif-etudiant-prenom-etudiant input" />
        </div>
        <form class="modif-etudiant-form">
            <input type="text" placeholder="Promotion" autocomplete="new-password" class="modif-etudiant-promo input" />
            <input type="text" placeholder="Centre" autocomplete="new-password" class="modif-etudiant-centre input" />
        </form>
        <h1 class="modif-etudiant-text">Historique des Stages</h1>
        <div class="modif-etudiant-container3">
            <label class="modif-etudiant-text1">Date de début de stage</label>
            <label class="modif-etudiant-text2">Date de fin de stage</label>
        </div>
    </div>
    <script>
    let field = {
        nom: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,40}$/,
        prenom: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,40}$/,
        promotion: /^[A-Z0-9\s]/,
        centre: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,30}$/,

    };

    function regex(input, field) {
        return fields[field].test(input);
    }

    let fields = ['nom', 'prenom','promotion', 'centre'];

    fields.forEach(function(field) {
        let inputElement = document.querySelector('input[name="' + field + '"]');
        let errorMessageElement = inputElement.nextElementSibling;

        inputElement.addEventListener('blur', function() {
            let input = this.value;
            if (!regex(input, field)) {
                errorMessageElement.textContent = "Veuillez suivre les règles pour ce champ";
                errorMessageElement.style.color = "red";
                inputElement.style.borderColor = "red";
            } else {
                errorMessageElement.textContent = "";
                errorMessageElement.style.color = "";
                inputElement.style.borderColor = "";
            }
        });
    });

</script>    
</main>

