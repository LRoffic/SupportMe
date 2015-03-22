$(function () {
	$("#inscription").submit(function () {
            $.post("./templates/default/requete.php?action=inscription",$("#inscription").serialize(),function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
				$(".alrt").delay(5000).hide("slow");
            });
            return false; // ne change pas de page
    });
    $("#connexion").submit(function () {
            $.post("./templates/default/requete.php?action=connexion",$("#connexion").serialize(),function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
				$(".alrt").delay(5000).hide("slow");
            });
            return false; // ne change pas de page
    });
    $("#new").submit(function () {
            tinyMCE.triggerSave();
            $.post("./templates/default/requete.php?action=new",$("#new").serialize(),function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
                $(".alrt").delay(5000).hide("slow");
            });
            return false; // ne change pas de page
    });
    $("#emailauth").submit(function () {
            tinyMCE.triggerSave();
            $.post("./templates/default/requete.php?action=emailauth",$("#emailauth").serialize(),function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
                $(".alrt").delay(5000).hide("slow");
            });
            return false; // ne change pas de page
    });
});
function deconnexion(token) 
    {
        $.post("./templates/default/requete.php?action=deconnexion&token="+token,function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
				$(".alrt").delay(5000).hide("slow");
        });
        return false; // ne change pas de page
    }
function resolve(id, page)
    {
        $.post("./templates/default/requete.php?action=resolve&id="+id,function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
                $(".alrt").delay(5000).hide("slow");
        });
        if(page == '1'){
            $("#formcom").slideUp("slow");
            setTimeout(function () { window.location.reload(); }, 4000);
        }
    }
function reopen(id, page)
    {
        $.post("./templates/default/requete.php?action=reopen&id="+id,function(texte){
                $("div#result").append(texte).slideDown("slow");
                $("div#result").delay(4000).slideUp("slow");
                $(".alrt").delay(5000).hide("slow");
        });
        if(page == '1'){
            setTimeout(function () { window.location.reload(); }, 4000);
        }
    }

tinymce.init({selector:'textarea.tiny'});
