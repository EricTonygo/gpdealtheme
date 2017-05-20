function gpdeal_translate(string){
    var languageCode = $('html').attr('lang');
    if(languageCode === 'en_GB'){
        return string;
    }
    return lang[languageCode][string];
}


var lang = {
    fr_FR : {
        "Please enter your email address" : 'Veuillez saisir votre adresse email',
        "Please enter a valid email address" : 'Veuillez saisir une adresse email valide',
        "Please enter the subject of your message": "Veuillez saisir l'objet de votre message",
        "Please enter your message": "Veuillez saisir votre message",
        "Failed to send message": "Echec d'envoi du message",
        "Please enter your username or email" : "Veuillez saisir votre pseudo ou votre email",
        "Please enter your password": "Veuillez saisir votre mot de passe",
        "" : ""
    }
    
};


