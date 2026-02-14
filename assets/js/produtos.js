function toast(msg, type) {
  const t = $("#toast");
  t.removeClass("ok err").addClass(type).text(msg).fadeIn(120);
  setTimeout(() => t.fadeOut(180), 2200);
}

$("#buscaProduto").on("keyup", function(){
  const q = $(this).val().toLowerCase();
  $("#tabelaProdutos tbody tr").each(function(){
    const txt = $(this).text().toLowerCase();
    $(this).toggle(txt.indexOf(q) > -1);
  });
});

$("#formProduto").on("submit", function(e){
  e.preventDefault();
  toast("No próximo passo vamos ligar o salvamento via AJAX 🙂", "ok");
});
