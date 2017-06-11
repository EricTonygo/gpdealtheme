function gpdeal_translate(string){
    var languageCode = $('html').attr('lang');
    if(languageCode === 'en'){
        return string;
    }
    return lang[languageCode][string];
}


var lang = {
    fr : {
        "Please enter your email address" : 'Veuillez saisir votre adresse email',
        "Please enter a valid email address" : 'Veuillez saisir une adresse email valide',
        "Please enter the subject of your message": "Veuillez saisir l'objet de votre message",
        "Please enter your message": "Veuillez saisir votre message",
        "Failed to send message": "Echec d'envoi du message",
        "Please enter your username or email" : "Veuillez saisir votre pseudo ou votre email",
        "Please enter your password": "Veuillez saisir votre mot de passe",
        "Please enter the departure date" : "Veuillez renseigner la date de départ",
        "Please enter the departure city" : "Veuillez renseigner la ville de départ",
        "Please enter the arrival date" : "Veuillez renseigner la date d'arrivée",
        "Please enter the destination city" : "Veuillez renseigner la ville de destination",
        "Please enter the deadline of the offer": "Veuillez renseigner la date limite de l'offre",
        "Error" : "Erreur",
        "The departure date can not be less than the current date": "La date de départ ne peut pas être inférieure à la date du jour",
        "The arrival date can not be less than the current date": "La date d'arrivée ne peut pas être inférieure à la date du jour",
        "The arrival date can not be less than the departure date": "La date d'arrivée ne peut pas être inférieure à la date de depart",
        "The deadline of the offer can not be less than the current date": "La date limite de l'offre ne peut pas être inférieure à la date du jour",
        "The departure date can not be less than the deadline of the offer": "La date d'arrivée ne peut pas être inférieure à la date de depart",
        "Internal server error" : "Erreur s'est produite au niveau du serveur",
        "Failed to validate" : "Echec de validation",
        "Please specify the item type of your shipment" : "Veuillez préciser le type d'objet de votre expédition",
        "Please specify the contents of your shipment" : "Veuillez preciser le contenu de votre expédition",
        "Please specify width" : "Veuillez préciser la largeur",
        "Please specify length" : "Veuillez préciser la longueur",
        "Please specify height" : "Veuillez préciser la hauteur",
        "Please specify weight" : "Veuiller préciser le poids",
        "Please specify the currency" : "Veuillez préciser la dévise",
        "Please enter a valid number" : "Veuiller saisir un nombre valide",
        "Please enter the cost of transport" : "Veuillez saisir le coût du transport",
        "Please specify the mode of transport" : "Veuillez préciser le mode de transport",
        "Please specify the type of shipments": "Veuillez préciser le type des expéditions",
        "Please specify a type of transport cost": "Veuillez préciser le type de coût du tranport",
        "You must agree to these Terms of Use": "Vous devez accepter ces conditions d'utilisation",
        "Please enter your comment" : "Veuillez saisir votre commentaire",
        "Please enter your reply" : "Veuillez saisir votre réponse",
        "Please enter your civility" : "Veuillez préciser votre civilité",
        "Please enter your last name" : "Veuillez saisir votre nom",
        "Please enter your username": "Veuillez saisir votre pseudo",
        "Please enter your birth date": "Veuillez renseigner votre date de naissance",
        "Please enter the street and number of your address" : "Veuillez saisir la rue et le numéro de votre adresse",
        "Please enter your locality": "Veuillez saisir votre localité",
        "Please enter your mobile phone number": "Veuillez saisir votre numéro de téléphone mobile",
        "Please enter a valid phone number": "Veuillez saisir un numéro de téléphone valide",
        "Phone numbers entered do not match": "Les numéros de téléphone saisis ne correspondent pas",
        "Please enter a valid email adresse" : "Veuillez saisir une adresse email valide",
        "The entered email addresses do not match" : "Les adresses email saisis ne correspondent pas",
        "The entered passwords do not match" : "Les mots de passe saisis ne correspondent pas",
        "Please select a test question" : "Veuillez selectionner une question test",
        "Please enter an answer to the test question" : "Veuillez saisir une reponse à la question test",
        "You must accept the terms of use" : "Vous devez accepter les conditions d'utilisation",
        "The age of a user must be greater than or equal to 18 years": "L'âge d'un utilisateur doit être supérieur ou égal à 18 ans",
        "Please select the account type" : "Veuillez choisir le type de compte", 
        "Please specify your representative's civility" : "Veuillez préciser votre la civilité du représentant",
        "Please enter the name of the representative": "Veuillez saisir le nom du représentant",
        "Please enter your company name" : "Veuillez saisir le nom de votre entreprise",
        "Please enter the legal form of your company" : "Veuillez saisir la forme légale de votre entreprise",
        "Please enter your identification number" : "Veuillez saisir votre numéro d'identification",
        "Please enter your position in the company" : "Veuillez saisir votre fonction dans l'entreprise",
        "Please enter your postal code": "Veuillez saisir votre code postal",
        "Please enter representative's mobile phone number": "Veuillez saisir le numéro de téléphone du représentant",
        "Please enter company's phone number": "Veuillez saisir le numéro de téléphone de l'entreprise",
        "Please enter representative's email address" : "Veuillez saisir l'email du représentant",
        "Please enter company's email address" : "Veuillez saisir l'email de l'entreprise",
        "Please select your test question" : "Veuillez saisire vote question test",
        "Please enter your answer to the test question": "Veuillez saisir votre réposnse test à la qustion",
        "Please enter a current password" : "Veuillez saisir le mot de passe actuel",
        "Please enter the new password" : "Veuillez saisir le nouveau mot de passe",
        "Invalid email address": "Adresse email invalide",
        "Please select your account type": "Veuillez selectionner votre type de compte"
    }
    
};


