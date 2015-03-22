function clore(id, token){
	$.post("./requete.php?action=clore&tid="+id+"&token="+token,function(texte){
        $("div#result").append(texte).slideDown("slow");
        $("div#result").delay(4000).slideUp("slow");
        $(".alrt").delay(5000).hide("slow");
    });
    return false;
}

function deleteTicket(id, token){
	$.post("./requete.php?action=deleteTicket&tid="+id+"&token="+token,function(texte){
        $("div#result").append(texte).slideDown("slow");
        $("div#result").delay(4000).slideUp("slow");
        $(".alrt").delay(5000).hide("slow");
    });
    return false;
}

function Nyan () {
    var audio = document.getElementsByTagName("audio")[0];
    audio.play();
    audio.loop = true;
}

tinymce.init({selector:'textarea.tiny'});