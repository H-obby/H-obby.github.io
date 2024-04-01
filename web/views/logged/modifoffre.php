<main class="modif-offre-entre-main">
    <div class="modif-offre-entre-container1">
        <form autocomplete="new-password" class="modif-offre-entre-form">
            <input type="text" placeholder="Site de l'entreprise" autocomplete="new-password" class="modif-offre-entre-site-entreprise input" />
            <input type="text" placeholder="Adresse du siège" autocomplete="new-password" class="modif-offre-entre-adresse input" />
            <input type="text" placeholder="N° de téléphone" autocomplete="new-password"
        class="modif-offre-entre-tel input" />
            <input type="text" placeholder="Nom du contact" autocomplete="new-password"
        class="modif-offre-entre-nom-contact input" />
            <input type="text" placeholder="E-Mail du contact" autocomplete="new-password"
        class="modif-offre-entre-mail-contact input" />
            <select class="modif-offre-entre-select">
                <option value="Option 1" disabled="true" selected="true" class="modif-offre-entre-option"> Secteur d'activité
                </option>
                <option value="Option 2">Informatique</option>
                <option value="Option 3">BTP</option>
            </select>
        </form>
        <div class="modif-offre-entre-container2">
            <button type="button" class="modif-offre-entre-button button">
        POSTER
            </button>
        </div>
    </div>
    <div class="modif-offre-entre-main-text-content">
        <input type="text" placeholder="Nom de l'entreprise" autocomplete="new-password"
      class="modif-offre-entre-intitul-stage input" />
        <textarea placeholder="Description de l'entreprise" autocomplete="off"
      class="modif-offre-entre-textarea textarea"></textarea>
    </div>
    
    <script>
        let field = {
            siteEntreprise: /^[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/,
            adresseSiege: /^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,100}$/,
            numTel: /^(\+\d{1,3}[-\s]?)?\d{10}$/,
            nomContact: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,40}$/,
            emailContact: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
            nomEntreprise: /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,40}$/,
            descriptionEntreprise: /^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{1,255}$/,
        };

        function regex(input, field) {
            return field[field].test(input);
        }

        let fields = ['siteEntreprise', 'adresseSiege', 'numTel', 'nomContact', 'emailContact', 'nomEntreprise', 'descriptionEntreprise'];
        fields.forEach(function(field) {
            let inputElement = document.querySelector('input[placeholder="' + field + '"]');
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