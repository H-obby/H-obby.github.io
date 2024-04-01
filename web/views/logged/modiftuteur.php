<main class="modif-tuteur-main">
    <div class="modif-tuteur-container1">
        <img alt="image" src="../public/image-1400h.png" class="modif-tuteur-image" />
        <button type="button" class="modif-tuteur-button button">Modifier l'image</button>
        <button type="button" class="modif-tuteur-button1 button">POSTER</button>
    </div>
    <div class="modif-tuteur-main-text-content">
        <div class="modif-tuteur-container2">
            <input type="text" placeholder="Nom" autocomplete="new-password" class="modif-tuteur-nom-etudiant input" />
            <input type="text" placeholder="Prénom" autocomplete="new-password" class="modif-tuteur-prenom-etudiant input" />
        </div>
        <form class="modif-tuteur-form">
            <input type="text" placeholder="Centre" autocomplete="new-password" class="modif-tuteur-centre input" />
        </form>
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